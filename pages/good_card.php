<?php
session_start();
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Очищаем сообщение
    echo "<script>alert('$message');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mangaCat - Атака Титанов, Том 1</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/card.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />
</head>

<body>
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/php/modules/header.php";
        ?>
    </header>
    <?php

    $id = $_GET['id'];
    $goods_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
    $goods_sql = "SELECT good_id, good_name, GROUP_CONCAT(genres.genre_name SEPARATOR ', ') AS genres, good_img, good_back_img, good_description, good_price, good_availability FROM goods LEFT JOIN manga_genre ON g_manga_id = good_id LEFT JOIN genres ON genres.genre_id = manga_genre.m_genre_id WHERE good_id = '$id' GROUP BY good_id";

    $goods_result = mysqli_query($goods_link, $goods_sql);
    $card = mysqli_fetch_array($goods_result);

    ?>
    <nav class="breadcrumb">
        <a href="/">Главная</a> / <a href="/pages/catalog.php">Каталог</a> / <a
            href="/pages/good_card.php?id=<?= $card['good_id'] ?>"><?= $card['good_name'] ?></a>
    </nav>

    <div class="container">
        <div class="product-images">
            <img src="<?= $card['good_img'] ?>" alt="Обложка манги" loading="lazy">
            <img src="<?= $card['good_back_img'] ?>" alt="Задняя обложка манги" loading="lazy">
        </div>

        <div class="product-info">
            <h1 class="product-title"><?= $card['good_name'] ?></h1>
            <p class="price"><?= $card['good_price'] ?></p>

            <div class="description">
                <h2>Описание:</h2>
                <p><?= $card['good_description'] ?></p>
            </div>

            <div class="features">
                <h2>Жанры:</h2>
                <p><?= $card['genres'] ?></p>
            </div>
            <form action="/php/cart.php" method="post">
                <input type="hidden" name="id" value="<?=$id?>">
                <button class="button" name="add_to_cart" type="submit">Добавить в корзину</button>
            </form>
        </div>
    </div>

    <footer>
        <?php
        include "$root/php/modules/footer.php";
        ?>
    </footer>
    <script src="/script/script.js"></script>
</body>

</html>