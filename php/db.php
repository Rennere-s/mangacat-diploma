<?php
// Данные для подключения к базе данных
$db_host = 'localhost';
$db_user = 'test';
$db_pass = 'root';
$db_name = 'test';

// Создаем соединение с помощью mysqli
$sql = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Проверяем, удалось ли соединение
if ($sql->connect_error) {
    // Если есть ошибка, прерываем выполнение скрипта и выводим сообщение
    die("Ошибка подключения к базе данных: " . $sql->connect_error);
}

// Устанавливаем кодировку для корректного отображения кириллицы
$sql->set_charset("utf8mb4");
?>