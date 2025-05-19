<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/about.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />
</head>

<body>
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/php/modules/header.php";
        ?>
    </header>
    <main>
        <div class="container">
            <section class="about-section">
                <img src="/img/aboutus.jpg" alt="Магазин манги" loading="lazy">
                <div class="about-text">
                    <h2>О нас</h2>
                    <p>В <strong>mangaCat</strong> мы стремимся сделать мир манги доступным для всех любителей жанра.
                        Будь
                        вы опытным коллекционером или новичком, мы предлагаем широкий ассортимент для удовлетворения
                        ваших
                        потребностей.</p>
                    <p>Основанный энтузиастами манги, наш магазин предлагает как классические, так и самые новые
                        издания. Мы
                        верим, что каждая история заслуживает быть рассказанной!</p>
                    <p>Присоединяйтесь к семье mangaCat уже сегодня и откройте для себя мир увлекательных приключений и
                        незабываемых героев.</p>
                </div>
            </section>

            <section class="extra-section">
                <h2>Наш адрес</h2>
                <p>Мы находимся по адресу: г. Москва, ул. Авиамоторная улица, д. 12к2</p>
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3Aacbdc6225eb9edeaa936f862064bc6616afab03b21005064b708a6ec6e9edc2d&amp;source=constructor"
                    width="500" height="400" frameborder="0"></iframe>
            </section>

            <section class="extra-section work-schedule">
                <h2>График работы</h2>
                <p>Понедельник - Пятница: 10:00 - 20:00</p>
                <p>Суббота: 11:00 - 18:00</p>
                <p>Воскресенье: Выходной</p>
            </section>
        </div>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        ?>
    </footer>
    <script src="/script/script.js"></script>
</body>

</html>