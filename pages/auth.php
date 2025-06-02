<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />
</head>

<body class="registration-body">
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/php/modules/header.php";
        ?>
    </header>

    <main class="main">
        <section class="registration">
            <form class="registration-form" action="/php/auth.php" method="post">
                <h1>Вход</h1>
                <label>Логин</label>
                <input type="text" name="user_login" pattern="^.{3,}$" title="Логин должен содержать от 3-х симоволов" placeholder="от 3 символов" required>
                <label>Пароль</label>
                <input type="password" name="user_password" pattern="^.{8,}$" title="Пароль должен содержать от 8-и симоволов" placeholder="от 8 символов" required>
                <?php
                if (isset($_GET['error'])) {
                    $error_message = urldecode($_GET['error']);
                    echo "<div style='color: red;'>$error_message</div>";
                }
                ?>
                <button type="submit">Войти</button>
            </form>
        </section>
    </main>

    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        ?>
    </footer>
    <script src="/script/script.js"></script>
</body>

</html>