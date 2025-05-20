<?php
session_start();
include "db.php";

// Проверка подключения к базе данных
if ($sql->connect_error) {
    die("Ошибка подключения: " . $sql->connect_error);
}

// Проверка авторизации пользователя
if (!isset($_COOKIE['user_id'])) {
    die("Пользователь не авторизован");
}
$user = $sql->real_escape_string($_COOKIE['user_id']);

// Проверка наличия товаров в корзине
if (empty($_SESSION['cart'])) {
    die("Корзина пуста");
}

$date = date('Y-m-d'); // Исправленный формат даты
$errors = [];

// Подготовленное выражение для вставки данных
$stmt = $sql->prepare("
    INSERT INTO `orders` 
    (`order_user_id`, `order_good_id`, `order_good_amount`, `order_price`, `order_date`) 
    VALUES (?, ?, ?, ?, ?)
");

if (!$stmt) {
    die("Ошибка подготовки запроса: " . $sql->error);
}

foreach ($_SESSION['cart'] as $good) {
    $good_id = $good['id'];
    $good_count = $good['count'];
    
    // Получение информации о товаре
    $goodQuery = $sql->query("SELECT * FROM `goods` WHERE `good_id` = '$good_id'");
    if (!$goodQuery) {
        $errors[] = "Ошибка при запросе товара ID $good_id: " . $sql->error;
        continue;
    }
    
    $goodData = $goodQuery->fetch_assoc();
    if (!$goodData) {
        $errors[] = "Товар ID $good_id не найден";
        continue;
    }
    
    $good_price = $goodData['good_price'];
    
    // Привязка параметров
    $stmt->bind_param("iiids", $user, $good_id, $good_count, $good_price, $date);
    
    if (!$stmt->execute()) {
        $errors[] = "Ошибка при добавлении заказа (ID товара $good_id): " . $stmt->error;
    }
}

$stmt->close();

// Очистка корзины после обработки
unset($_SESSION['cart']);

// Редирект после завершения всех операций
if (empty($errors)) {
    $_SESSION['success_message'] = 'Заказ успешко оформлен!';
    header('Location: /pages/cart.php?order=yes');
} else {
    // Можно записать ошибки в лог или вывести их
    header('Location: /pages/cart.php?order=error');
}
exit();
?>