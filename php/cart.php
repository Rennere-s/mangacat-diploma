<?php

include 'db.php';
session_start();
$back = $_SERVER['HTTP_REFERER'];

//если корзины нет она создается
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    $good_id = intval($_POST['id']); // Защита от SQL-инъекций и некорректных данных

    $result = $sql->query("SELECT * FROM `goods` WHERE good_id = $good_id");
    
    if ($row = mysqli_fetch_array($result)) {
        $good = array(
            'id' => $row['good_id'],
            'name' => $row['good_name'],
            'desc' => $row['good_description'],
            'price' => $row['good_price'],
            'image' => $row['good_img'],
        );

        if (isset($_SESSION['cart'][$good_id])) {
            $_SESSION['cart'][$good_id]['count']++;
        } else {
            $_SESSION['cart'][$good_id] = $good;
            $_SESSION['cart'][$good_id]['count'] = 1;
        }
    } else {
        echo "Товар не найден";
    }
    $_SESSION['success_message'] = 'Товар добавлен в корзину!';
}

if (isset($_GET['remove'])) {
    $good_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$good_id]);
    $_SESSION['success_message'] = 'Товар удален из корзины!';

}


header("Location: $back");

?>