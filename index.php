<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaCat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />
</head>

<body>
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once "$root/php/db.php"; 
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

        <h1 class="slider-title">Хиты</h1>
        <section class="book-slider">
            <div class="book-description">
                <h2 class="book-title">Название книги</h2>
                <p class="book-description-text">Описание активной книги. Здесь будет текст, который меняется при
                    переключении книг.</p>
                <a class="learn-more"><button>Узнать больше</button></a>
            </div>
            <div class="slider-component-wrapper">
                <div class="slider-viewport">
                    <div class="slider">
                        <?php
                        $result_banner_hits = $sql->query("SELECT * FROM `banner_hits`");
                        while ($row = $result_banner_hits->fetch_assoc()):
                            ?>
                            <div class="book" data-title="<?= htmlspecialchars($row['hits_manga_name']) ?>"
                                data-description="<?= htmlspecialchars($row['hits_manga_desc']) ?>"
                                data-link="/pages/good_card.php?id=<?= $row['hits_manga_id'] ?>">
                                <img src="/img/bannerhits<?= htmlspecialchars($row['hits_manga_img']) ?>.png" loading="lazy"
                                    alt="<?= htmlspecialchars($row['hits_manga_name']) ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <button class="slider-control prev">❮</button>
                <button class="slider-control next">❯</button>
                <div class="shelf"></div>
            </div>
        </section>

        <section class="block-catalog">
            <h2>Популярные категории</h2>
            <?php
            

            $required_genres = ['Романтика', 'Экшн', 'Спорт', 'Фентези', 'Исекай', 'Сёнен', 'Сёдзё', 'Комедия'];
            

            $in_clause = "'" . implode("','", $required_genres) . "'";
            

            $genres_query = "SELECT genre_id, genre_name FROM `genres` WHERE `genre_name` IN ($in_clause)";
            $genres_result = $sql->query($genres_query);
            

            $genres_data = [];
            while ($genre = $genres_result->fetch_assoc()) {
                $genres_data[$genre['genre_name']] = $genre;
            }

            ?>
            <div class="categories">
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Романтика']['genre_id'] ?? '' ?>"><img
                            src="/img/category1.jpg" alt="Романтика" loading="lazy"><span
                            class="text">Романтика</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Экшн']['genre_id'] ?? '' ?>"><img
                            src="/img/category2.jpg" alt="Экшн" loading="lazy"><span class="text">Экшн</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Спорт']['genre_id'] ?? '' ?>"><img
                            src="/img/category3.jpg" alt="Спорт" loading="lazy"><span class="text">Спорт</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Фентези']['genre_id'] ?? '' ?>"><img
                            src="/img/category4.jpg" alt="Фентези" loading="lazy"><span class="text">Фентези</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Исекай']['genre_id'] ?? '' ?>"><img
                            src="/img/category5.jpg" alt="Исекай" loading="lazy"><span class="text">Исекай</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Сёнен']['genre_id'] ?? '' ?>"><img
                            src="/img/category6.jpg" alt="Сёнен" loading="lazy"><span class="text">Сёнен</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Сёдзё']['genre_id'] ?? '' ?>"><img
                            src="/img/category7.jpg" alt="Сёдзё" loading="lazy"><span class="text">Сёдзё</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $genres_data['Комедия']['genre_id'] ?? '' ?>"><img
                            src="/img/category8.jpg" alt="Комедия" loading="lazy"><span class="text">Комедия</span></a>
                </div>
            </div>
        </section>

        <section class="block-3">
            <div class="about-us">
                <div class="about-us-image-of-girl-with-cat"></div>
                <div class="about-us-information">
                    <h3>Мы - mangaCat</h3>
                    <p class="about-us-information-text">Наш магазин основан истинными энтузиастами, которые с любовью и
                        трепетом относятся к японской поп-культуре. Мы восхищаемся удивительными мирами, созданными
                        мангаками, и стремимся делиться этой страстью с вами.</p>
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


        <h1 class="slider-title">Новинки</h1>
        <section class="book-slider">
            <div class="book-description">
                <h2 class="book-title">Название книги</h2>
                <p class="book-description-text">Описание активной книги. Здесь будет текст, который меняется при
                    переключении книг.</p>
                <a class="learn-more"><button>Узнать больше</button></a>
            </div>
            <div class="slider-component-wrapper">
                <div class="slider-viewport">
                    <div class="slider">
                        <?php
                        $result_banner_news = $sql->query("SELECT * FROM `banner_news`");
                        while ($row = $result_banner_news->fetch_assoc()):
                            ?>
                            <div class="book" data-title="<?= htmlspecialchars($row['new_manga_name']) ?>"
                                data-description="<?= htmlspecialchars($row['new_manga_desc']) ?>"
                                data-link="/pages/good_card.php?id=<?= $row['new_manga_id'] ?>">
                                <img src="/img/bannernews<?= htmlspecialchars($row['new_manga_img']) ?>.png" loading="lazy"
                                    alt="<?= htmlspecialchars($row['new_manga_name']) ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <button class="slider-control prev">❮</button>
                <button class="slider-control next">❯</button>
                <div class="shelf"></div>
            </div>
        </section>

        <!-- СЛАЙДЕР 3: СЕЗОННОЕ ПРЕДЛОЖЕНИЕ (код не изменился, но теперь использует $sql из db.php) -->
        <h1 class="slider-title">Сезонное предложение</h1>
        <section class="book-slider">
            <div class="book-description">
                <h2 class="book-title">Название книги</h2>
                <p class="book-description-text">Описание активной книги. Здесь будет текст, который меняется при
                    переключении книг.</p>
                <a class="learn-more"><button>Узнать больше</button></a>
            </div>
            <div class="slider-component-wrapper">
                <div class="slider-viewport">
                    <div class="slider">
                        <?php
                        $result_banner_season = $sql->query("SELECT * FROM `banner_season`");
                        while ($row = $result_banner_season->fetch_assoc()):
                            ?>
                            <div class="book" data-title="<?= htmlspecialchars($row['season_manga_name']) ?>"
                                data-description="<?= htmlspecialchars($row['season_manga_desc']) ?>"
                                data-link="/pages/good_card.php?id=<?= $row['season_manga_id'] ?>">
                                <img src="/img/bannerseasonal<?= htmlspecialchars($row['season_manga_img']) ?>.png"
                                    loading="lazy" alt="<?= htmlspecialchars($row['season_manga_name']) ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <button class="slider-control prev">❮</button>
                <button class="slider-control next">❯</button>
                <div class="shelf"></div>
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
                        <div class="contact-item"><i class="fa-brands fa-tiktok"></i><span>@mangaCat</span></div>
                        <div class="contact-item"><i class="fa-brands fa-telegram"></i><span>@mangaCat</span></div>
                        <div class="contact-item"><i class="fa-brands fa-pinterest"></i><span>@mangaCat</span></div>
                        <div class="contact-item"><i class="fa-brands fa-vk"></i><span>vk.ru/mangacat</span></div>
                        <div class="contact-item"><i class="fa-brands fa-whatsapp"></i><span>@mangaCat</span></div>
                    </div>
                    <div class="contact-image">
                        <img src="/img/contact-image.png" alt="Аниме девушка с котом" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        // Закрывать соединение в конце скрипта - хорошая практика, хотя PHP обычно делает это сам
        $sql->close();
        ?>
    </footer>
    <script src="/script/script.js"></script>
</body>

</html>