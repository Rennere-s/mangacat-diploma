<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
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
            <form class="registration-form" action="/php/reg.php" method="post">
                <h1>Регистрация</h1>
                <input type="text" name="user_login" placeholder="Логин" required>
                <input type="password" name="user_password" placeholder="Пароль" required>
                <input type="tel" autocomplete="tel" name="user_tel" placeholder="Телефон">
                <input type="email" name="user_email" placeholder="Емейл">
                <label>Дата рождения</label>
                <input type="date" name="user_birthdate" placeholder="Дата рождения">
                <button type="submit">Зарегистрироваться</button>
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