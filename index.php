<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaCat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
</head>

<body>
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/php/modules/header.php";
        ?>
    </header>
    <main>
        <div class="banner-container">
            <div class="banner-text">
                <h1>Добро пожаловать в MANGACAT</h1>
                <p>Ваш идеальный источник манги</p>
            </div>
        </div>
        <section class="block-slider">
            <div class="slider">
                <div class="slider-track">
                    <div class="slide active">
                        <img src="/img/баннер 1 (1).jpg" alt="Slider Image 1">
                    </div>
                    <div class="slide">
                        <img src="/img/баннер 1 (2).jpg" alt="Slider Image 2">
                    </div>
                    <div class="slide">
                        <img src="/img/баннер 1 (3).jpg" alt="Slider Image 3">
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="prev-slide">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="next-slide">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="slider-dots">
                    <button class="dot active"></button>
                    <button class="dot"></button>
                    <button class="dot"></button>
                </div>
            </div>
        </section>
        <section class="block-catalog">
            <h2>Популярные категории</h2>
            <div class="categories">
                <div class="category"><a href="/pages/catalog.php?id=11"><img src="/img/category1.jpg" alt="Романтика"><span class="text">Романтика</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=7"><img src="/img/category2.jpg" alt="Экшн"><span class="text">Экшн</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=13"><img src="/img/category3.jpg" alt="Спорт"><span class="text">Спорт</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=5"><img src="/img/category4.jpg" alt="Фентези"><span class="text">Фентези</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=28"><img src="/img/category5.jpg" alt="Исекай"><span class="text">Исекай</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=1"><img src="/img/category6.jpg" alt="Сёнкн"><span class="text">Сёнен</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=2"><img src="/img/category7.jpg" alt="Сёдзё"><span class="text">Сёдзё</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=8"><img src="/img/category8.jpg" alt="Комедия"><span class="text">Комедия</span></a></div>
            </div>
        </section>
        <section class="block-3">
            <div class="about-us">
                <div class="about-us-image-of-girl-with-cat"></div>
                <div class="about-us-information">
                    <h3>Мы - mangaCat</h3>
                    <p class="about-us-information-text">Наш магазин основан истинными энтузиастами, которые с любовью и
                        трепетом относятся к японской поп-культуре. Мы восхищаемся удивительными мирами, созданными
                        мангаками, и стремимся делиться этой страстью с вами.
                    </p>
                    <div class="about-us-working-time">
                        <h4>Время работы</h4>
                        <div class="about-us-working-time-information">
                            <p>пн-пт: <span>8:00 - 22:00</span></p>
                            <p>сб-вс: <span>9:00 - 20:00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="block-slider">
            <div class="slider">
                <div class="slider-track">
                    <div class="slide active">
                        <img src="/img/баннер 1 (1).jpg" alt="Slider Image 1">
                    </div>
                    <div class="slide">
                        <img src="/img/баннер 1 (2).jpg" alt="Slider Image 2">
                    </div>
                    <div class="slide">
                        <img src="/img/баннер 1 (3).jpg" alt="Slider Image 3">
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="prev-slide">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="next-slide">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="slider-dots">
                    <button class="dot active"></button>
                    <button class="dot"></button>
                    <button class="dot"></button>
                </div>
            </div>
        </section>
        <section class="block-slider">
            <div class="slider">
                <div class="slider-track">
                    <div class="slide active">
                        <img src="/img/баннер 1 (1).jpg" alt="Slider Image 1">
                    </div>
                    <div class="slide">
                        <img src="/img/баннер 1 (2).jpg" alt="Slider Image 2">
                    </div>
                    <div class="slide">
                        <img src="/img/баннер 1 (3).jpg" alt="Slider Image 3">
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="prev-slide">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="next-slide">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="slider-dots">
                    <button class="dot active"></button>
                    <button class="dot"></button>
                    <button class="dot"></button>
                </div>
            </div>
        </section>
        <section class="block-4">
            <div class="contact-container">
                <div class="contact-header">
                    <h2>СВЯЖИТЕСЬ С НАМИ ^^</h2>
                    <div class="divider"></div>
                </div>
                <div class="contact-content">
                    <div class="contact-list">
                        <div class="contact-item">
                            <i class="fa-brands fa-tiktok"></i>
                            <span>@mangaCat</span>
                        </div>
                        <div class="contact-item">
                            <i class="fa-brands fa-telegram"></i>
                            <span>@mangaCat</span>
                        </div>
                        <div class="contact-item">
                            <i class="fa-brands fa-pinterest"></i>
                            <span>@mangaCat</span>
                        </div>
                        <div class="contact-item">
                            <i class="fa-brands fa-vk"></i>
                            <span>vk.ru/mangacat</span>
                        </div>
                        <div class="contact-item">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>@mangaCat</span>
                        </div>
                    </div>
                    <div class="contact-image">
                        <img src="/img/contact-image.png" alt="Аниме девушка с котом">
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        ?>
    </footer>
    <script src="/script/script.js"></script>
</body>

</html>