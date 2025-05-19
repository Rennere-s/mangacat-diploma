<?php
session_start();
$id = $_GET['id'];

$cart_data=$_SESSION['cart'];

foreach ($_SESSION['cart'] as $key => $item) {
    if($item['id'] == $id){
        if($_SESSION['cart'][$key]['count']<2){
            unset($_SESSION['cart'][$good_id]);
        }else{
            $_SESSION['cart'][$key]['count']--;
            foreach($_SESSION['cart'] as $key2 => $item2){
                if($item2 == $id){
                    unset($_SESSION['cart'][$key2]);
                    break;
                }
            }
        }
    }
}
header('location: ../pages/cart.php');
?>