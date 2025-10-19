<?php

session_start();
include "db.php"; 

if (isset($_GET['remove']) && $_GET['remove'] == 1) {
    unset($_SESSION['promo']);
    $_SESSION['success_message'] = "Промокод был удален.";
    header('Location: /pages/cart.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['promo_code'])) {
        $_SESSION['error_message'] = "Пожалуйста, введите промокод.";
        header('Location: /pages/cart.php');
        exit();
    }

    $promo_code = trim($_POST['promo_code']);

    $stmt = $sql->prepare("SELECT * FROM `promocodes` WHERE `promocod_name` = ? AND `percent_livetime` > NOW()");
    $stmt->bind_param("s", $promo_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $promo_data = $result->fetch_assoc();
        
        $_SESSION['promo'] = [
            'id'      => $promo_data['promocod_id'],
            'name'    => $promo_data['promocod_name'],
            'percent' => $promo_data['promocod_percent']
        ];

        $_SESSION['success_message'] = "Промокод '{$promo_data['promocod_name']}' успешно применен!";

    } else {
        unset($_SESSION['promo']); 
        $_SESSION['error_message'] = "Промокод недействителен или срок его действия истек.";
    }

    $stmt->close();
    $sql->close();

    header('Location: /pages/cart.php');
    exit();
}

header('Location: /pages/cart.php');
exit();