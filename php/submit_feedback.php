<?php

session_start();
include "db.php"; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /'); 
    exit();
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

$sql->query("INSERT INTO `feedback_messages` (sender_name, sender_email, message_text) VALUES ('$name','$email','$message')");
$sql->close();

header("Location: /pages/contact.php");
