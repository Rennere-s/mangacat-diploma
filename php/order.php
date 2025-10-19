<?php
session_start();
include "db.php"; 


if (!isset($_COOKIE['user_id'])) {
    header('Location: /pages/login.php');
    exit();
}
$user_id = (int) $_COOKIE['user_id'];

if (empty($_SESSION['cart'])) {
    header('Location: /pages/cart.php?order=empty');
    exit();
}

if (!isset($_POST['address_id']) || empty($_POST['address_id'])) {
    $_SESSION['error_message'] = 'Пожалуйста, выберите адрес доставки.';
    header('Location: /pages/cart.php?order=error');
    exit();
}
$address_id = (int) $_POST['address_id'];


$subtotal_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $item_price_cleaned = (float) preg_replace('/[^0-9.]/', '', $item['price']);
    $subtotal_price += $item_price_cleaned * $item['count'];
}

$final_price = $subtotal_price;
$promocode_id = null; 

if (isset($_SESSION['promo'])) {
    $discount_percent = $_SESSION['promo']['percent'];
    $discount_amount = ($subtotal_price * $discount_percent) / 100;
    $final_price = $subtotal_price - $discount_amount;
    $promocode_id = (int) $_SESSION['promo']['id'];
}


$sql->begin_transaction(); 

try {
    $columns = ['user_id', 'address_id', 'total_price', 'status_id'];
    $params = [$user_id, $address_id, $final_price, 1]; 
    $types = "iidi"; 

    if ($promocode_id !== null) {
        $columns[] = 'promocode_id'; 
        $params[] = $promocode_id;   
        $types .= "i";               
    }

    $columns_sql = implode(', ', $columns);
    $placeholders_sql = implode(', ', array_fill(0, count($columns), '?'));

    $query = "INSERT INTO `orders` ($columns_sql) VALUES ($placeholders_sql)";

    $stmt_order = $sql->prepare($query);

    $stmt_order->bind_param($types, ...$params);

    if (!$stmt_order->execute()) {
        $error_message = "Ошибка выполнения запроса к `orders`: " . $stmt_order->error . "\n";
        $error_message .= "Query: " . $query . "\n";
        $error_message .= "Params: " . json_encode($params) . "\n";
        $error_message .= "Types: " . $types;
        throw new Exception($error_message);
    }

    $order_id = $sql->insert_id;
    if ($order_id == 0) {
        throw new Exception("Не удалось создать основную запись о заказе (insert_id равен 0).");
    }

    $stmt_items = $sql->prepare(
        "INSERT INTO `order_items` (order_id, good_id, quantity, price_per_item) VALUES (?, ?, ?, ?)"
    );

    foreach ($_SESSION['cart'] as $good_id => $item) {
        if (!isset($item['id'], $item['count'], $item['price'])) {
            error_log("Поврежденный товар в корзине: " . print_r($item, true));
            continue; 
        }

        $item_id = (int) $item['id'];
        $quantity = (int) $item['count'];
        $price_per_item = (float) preg_replace('/[^0-9.]/', '', $item['price']);

        $stmt_items->bind_param("iiid", $order_id, $item_id, $quantity, $price_per_item);
        if (!$stmt_items->execute()) {
            throw new Exception("Ошибка выполнения запроса к `order_items`: " . $stmt_items->error);
        }
    }

    $sql->commit();

    unset($_SESSION['cart']);
    unset($_SESSION['promo']);

    $_SESSION['success_message'] = 'Ваш заказ №' . $order_id . ' успешно оформлен!';
    header('Location: /pages/my_orders.php');
    exit();

} catch (Exception $e) {
    $sql->rollback();
    error_log("Ошибка оформления заказа: " . $e->getMessage());
    $_SESSION['error_message'] = 'Произошла ошибка при оформлении заказа. Пожалуйста, попробуйте снова.';
    header('Location: /pages/cart.php?order=error');
    exit();
}