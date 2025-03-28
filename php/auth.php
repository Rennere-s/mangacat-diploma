<?php
// Максимальное количество попыток входа
$max_attempts = 5;
// Время блокировки в секундах (например, 5 минут)
$lockout_time = 300;
// Имя куки для хранения количества попыток
$attempts_cookie_name = 'login_attempts';
// Имя куки для хранения времени последней попытки
$last_attempt_cookie_name = 'last_attempt_time';

// Получаем данные из кук
$login_attempts = isset($_COOKIE[$attempts_cookie_name]) ? (int)$_COOKIE[$attempts_cookie_name] : 0;
$last_attempt_time = isset($_COOKIE[$last_attempt_cookie_name]) ? (int)$_COOKIE[$last_attempt_cookie_name] : 0;

// Проверяем, не превышено ли количество попыток
if ($login_attempts >= $max_attempts) {
    // Проверяем, прошло ли время блокировки
    if (time() - $last_attempt_time < $lockout_time) {
        // Пользователь заблокирован: показываем сообщение и завершаем выполнение скрипта
        $error_message = urlencode("Слишком много попыток входа. Попробуйте снова через " . ($lockout_time - (time() - $last_attempt_time)) . " секунд.");
        header("Location: /pages/auth.php?error=" . $error_message);
        exit; // Прекращаем выполнение скрипта
    } else {
        // Сбрасываем счетчик попыток, если время блокировки истекло
        $login_attempts = 0;
        setcookie($attempts_cookie_name, $login_attempts, time() + $lockout_time, '/');
        setcookie($last_attempt_cookie_name, '', time() - 3600, '/'); // Удаляем время последней попытки
    }
}

// Если мы здесь, значит пользователь может попытаться войти

// Обработка данных авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_login = filter_var(trim($_POST['user_login']), FILTER_SANITIZE_STRING);
    $user_password = filter_var(trim($_POST['user_password']), FILTER_SANITIZE_STRING);
    $user_password = md5($user_password . 'mc');

    include "db.php";

    $stmt = $sql->prepare("SELECT * FROM `users` WHERE `user_login` = ? AND `user_password` = ?");
    $stmt->bind_param("ss", $user_login, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_array();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Успешный вход: сбрасываем счетчик попыток и устанавливаем куки пользователя
        setcookie($attempts_cookie_name, 0, time() + $lockout_time, '/');
        setcookie($last_attempt_cookie_name, '', time() - 3600, '/'); // Удаляем время последней попытки

        setcookie('user_id', $user['user_id'], time() + 3600, '/');
        setcookie('user_login', $user['user_login'], time() + 3600, '/');
        setcookie('user_role', $user['user_role'], time() + 3600, '/');

        header('location: /');
        exit;
    } else {
        // Неудачная попытка входа: увеличиваем счетчик попыток
        $login_attempts++;
        setcookie($attempts_cookie_name, $login_attempts, time() + $lockout_time, '/');
        setcookie($last_attempt_cookie_name, time(), time() + $lockout_time, '/');

        echo "<script>alert('Пароль или логин неверные!');window.location.replace('/pages/auth.php');</script>";
        exit;
    }
}
?>