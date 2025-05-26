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
        include "$root/php/modules/header.php";
        $sql = new mysqli('localhost', 'root', 'root', 'mangacat');
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
        <div class="slider-wrapper">
            <section class="book-slider">
                <div class="book-description">
                    <h2 class="book-title">Название книги</h2>
                    <p class="book-description-text">Описание активной книги. Здесь будет текст, который меняется при переключении книг.</p>
                    <a class="learn-more"><button>Узнать больше</button></a>
                </div>
        <div class="slider-container">
            <div class="slider">
                <?php 
                    $result_banner_hits = $sql->query("SELECT * FROM `banner_hits`"); 
                    while($row = $result_banner_hits->fetch_assoc()):
                ?>
                <div class="book" data-title="<?=$row['hits_manga_name']?>" data-description="<?=$row['hits_manga_desc']?>" data-link="/pages/good_card.php?id=<?=$row['hits_manga_id']?>">
                    <img src="/img/bannerhits<?=$row['hits_manga_img']?>.png" alt="<?=$row['hits_manga_name']?>">
                </div>
                <?php endwhile;?>
            </div>
            <button class="slider-control prev">❮</button>
            <button class="slider-control next">❯</button>
        </div>
        <div class="shelf"></div>
    </section>
    </div>
        <section class="block-catalog">
            <h2>Популярные категории</h2>
            <?php
            $genres_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
            $romantic_sql = "SELECT * FROM `genres` where `genre_name` = 'Романтика'";
            $romantic_result = mysqli_query($genres_link, $romantic_sql);
            $romantic = mysqli_fetch_array($romantic_result);
            $action_sql = "SELECT * FROM `genres` where `genre_name` = 'Экшн'";
            $action_result = mysqli_query($genres_link, $action_sql);
            $action = mysqli_fetch_array($action_result);
            $sport_sql = "SELECT * FROM `genres` where `genre_name` = 'Спорт'";
            $sport_result = mysqli_query($genres_link, $sport_sql);
            $sport = mysqli_fetch_array($sport_result);
            $fantasy_sql = "SELECT * FROM `genres` where `genre_name` = 'Фентези'";
            $fantasy_result = mysqli_query($genres_link, $fantasy_sql);
            $fantasy = mysqli_fetch_array($fantasy_result);
            $isecai_sql = "SELECT * FROM `genres` where `genre_name` = 'Исекай'";
            $isecai_result = mysqli_query($genres_link, $isecai_sql);
            $isecai = mysqli_fetch_array($isecai_result);
            $syonen_sql = "SELECT * FROM `genres` where `genre_name` = 'Сёнен'";
            $syonen_result = mysqli_query($genres_link, $syonen_sql);
            $syonen = mysqli_fetch_array($syonen_result);
            $syodjo_sql = "SELECT * FROM `genres` where `genre_name` = 'Сёдзё'";
            $syodjo_result = mysqli_query($genres_link, $syodjo_sql);
            $syodjo = mysqli_fetch_array($syodjo_result);
            $comedy_sql = "SELECT * FROM `genres` where `genre_name` = 'Комедия'";
            $comedy_result = mysqli_query($genres_link, $comedy_sql);
            $comedy = mysqli_fetch_array($comedy_result);
            mysqli_close($genres_link);
            ?>
            <div class="categories">

                <div class="category">
                    <a href="/pages/catalog.php?id=<?= $romantic['genre_id'] ?>">
                        <img src="/img/category1.jpg" alt="Романтика" loading="lazy">
                        <span class="text">
                            Романтика
                        </span>
                    </a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $action['genre_id'] ?>"><img
                            src="/img/category2.jpg" alt="Экшн" loading="lazy"><span class="text">Экшн</span></a></div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $sport['genre_id'] ?>"><img
                            src="/img/category3.jpg" alt="Спорт" loading="lazy"><span class="text">Спорт</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $fantasy['genre_id'] ?>"><img
                            src="/img/category4.jpg" alt="Фентези" loading="lazy"><span class="text">Фентези</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $isecai['genre_id'] ?>"><img
                            src="/img/category5.jpg" alt="Исекай" loading="lazy"><span class="text">Исекай</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $syonen['genre_id'] ?>"><img
                            src="/img/category6.jpg" alt="Сёнен" loading="lazy"><span class="text">Сёнен</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $syodjo['genre_id'] ?>"><img
                            src="/img/category7.jpg" alt="Сёдзё" loading="lazy"><span class="text">Сёдзё</span></a>
                </div>
                <div class="category"><a href="/pages/catalog.php?id=<?= $comedy['genre_id'] ?>"><img
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
          <h1 class="slider-title">Новинки</h1>
        <div class="slider-wrapper">
            <section class="book-slider">
                <div class="book-description">
                    <h2 class="book-title">Название книги</h2>
                    <p class="book-description-text">Описание активной книги. Здесь будет текст, который меняется при переключении книг.</p>
                    <a class="learn-more"><button>Узнать больше</button></a>
                </div>
        <div class="slider-container">
            <div class="slider">
                <?php 
                    $result_banner_news = $sql->query("SELECT * FROM `banner_news`"); 
                    while($row = $result_banner_news->fetch_assoc()):
                ?>
                <div class="book" data-title="<?=$row['new_manga_name']?>" data-description="<?=$row['new_manga_desc']?>" data-link="/pages/good_card.php?id=<?=$row['new_manga_id']?>">
                    <img src="/img/bannernews<?=$row['new_manga_img']?>.png" alt="">
                </div>
                <?php endwhile;?>
            </div>
            <button class="slider-control prev">❮</button>
            <button class="slider-control next">❯</button>
        </div>
        <div class="shelf"></div>
    </section>
    </div>
                <h1 class="slider-title">Сезонное предложение</h1>
        <div class="slider-wrapper">
            <section class="book-slider">
                <div class="book-description">
                    <h2 class="book-title">Название книги</h2>
                    <p class="book-description-text">Описание активной книги. Здесь будет текст, который меняется при переключении книг.</p>
                    <a class="learn-more"><button>Узнать больше</button></a>
                </div>
        <div class="slider-container">
            <div class="slider">
                <?php 
                    $result_banner_season = $sql->query("SELECT * FROM `banner_season`"); 
                    while($row = $result_banner_season->fetch_assoc()):
                ?>
                <div class="book" data-title="<?=$row['season_manga_name']?>" data-description="<?=$row['season_manga_desc']?>" data-link="/pages/good_card.php?id=<?=$row['season_manga_id']?>">
                    <img src="/img/bannerseasonal<?=$row['season_manga_img']?>.png" alt="<?=$row['season_manga_name']?>">
                </div>
                <?php endwhile;?>
            </div>
            <button class="slider-control prev">❮</button>
            <button class="slider-control next">❯</button>
        </div>
        <div class="shelf"></div>
    </section>
    </div>
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
                        <img src="/img/contact-image.png" alt="Аниме девушка с котом" loading="lazy">
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