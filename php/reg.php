<?php

$user_login = filter_var(trim($_POST['user_login']));
$user_password = filter_var(trim($_POST['user_password']));
$user_tel = filter_var(trim($_POST['user_tel']));
$user_email = filter_var(trim($_POST['user_email']));
$user_birthdate = filter_var(trim($_POST['user_birthdate']));
$user_password = md5($user_password . 'mc');

include "db.php";

$sql->query("INSERT INTO `users` (`user_login`, `user_password`, `user_tel`, `user_email`, `user_date`, `user_role`) VALUES ('$user_login', '$user_password', '$user_tel', '$user_email', '$user_birthdate', 1)");
$sql->close();

header("location: /");

?>