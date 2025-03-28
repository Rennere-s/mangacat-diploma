<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/catalog.css">
</head>

<body>

    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/php/modules/header.php";
        ?>
    </header>

    <main class="catalog">
        <div class="catalog-header">КАТАЛОГ</div>

        <div class="catalog-content">
            <aside class="filter">
                <form>
                    <label>Сортировать по:</label>
                    <input type="text" placeholder="Поиск">
                    <button type="submit">Найти</button>

                    <label>Цена:</label>
                    <input type="number" placeholder="От">
                    <input type="number" placeholder="До">

                    <label>Категории:</label>
                    <select>
                        <option>Все</option>
                        <?php

                        $genres_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                        $genres_sql = "SELECT * FROM `genres`";
                        $genres_result = mysqli_query($genres_link, $genres_sql);
                        while ($row = mysqli_fetch_array($genres_result)):
                            ?>
                            <option value="<?= $row['genre_id'] ?>"><?= $row['genre_name'] ?></option>
                        <?php endwhile; ?>
                    </select>

                    <label>
                        <input type="checkbox" checked> В наличии
                    </label>

                    <button type="submit">Показать</button>
                    <button type="reset">Сбросить</button>
                </form>
            </aside>
            <section class="products">
                <?php

                $good_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                $good_sql = "SELECT * FROM `goods`";
                $good_result = mysqli_query($good_link, $good_sql);
                while ($row = mysqli_fetch_array($good_result)):
                    ?>
                    <div class="product">
                        <a href="/pages/good_card.php?id=<?= $row['good_id'] ?>">
                            <img src="<?= $row['good_img'] ?>" alt="<?= $row['good_name'] ?>">
                        </a>
                        <div class="product-no-image">
                            <a href="/pages/good_card.php?id=<?= $row['good_id'] ?>">
                                <div class="product-title"><?= $row['good_name'] ?></div>
                            </a>
                            <div class="product-desc truncate"><?= $row['good_description'] ?></div>
                            <div class="product-footer">
                                <div class="product-price"><?= $row['good_price'] ?></div>
                                <div class="product-actions">
                                    <button><i class="fas fa-heart"></i></button>
                                    <button><i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
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