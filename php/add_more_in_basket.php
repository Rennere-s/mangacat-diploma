<?php
session_start();
$id = $_GET['id'];

foreach ($_SESSION['cart'] as $key => $item) {
    if($item['id'] == $id){
        $_SESSION['cart'][$key]['count']++;
        // print_r($_SESSION['cart'][$key]['count']);
    }
}
header('location: ../pages/cart.php');
?>