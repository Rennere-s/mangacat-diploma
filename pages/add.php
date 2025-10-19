<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/add.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />
</head>

<body class="">
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once "$root/php/db.php";
        
        include "$root/php/modules/header.php";
        ?>
    </header>
    <main class="main">
        <?php
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        if ($type == 'goods'):
            ?>
            <section class="red">
                <form class="red-form" action="/php/add.php?type=goods" method="post">
                    <h2>Добавить мангу</h2>
                    <label>Название</label>
                    <input type="text" name="good_name" required>
                    <label>Жанры</label>
                    <div class="genres">
                        <?php
                        $genres_sql = "SELECT * FROM `genres` ORDER BY genre_name ASC";
                        $genres_result = mysqli_query($sql, $genres_sql);
                        while ($row = mysqli_fetch_array($genres_result)):
                            ?>
                            <div class="genres-element">
                                <input type="checkbox" name="genres[]" value="<?= $row['genre_id'] ?>">
                                <?= htmlspecialchars($row['genre_name']) ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <label>Номер изображения (например, 1, 2, 3)</label>
                    <input type="text" name="good_img" required>
                    <label>Описание товара</label>
                    <textarea name="good_description" rows="10" cols="50" required></textarea>
                    <label>Цена</label>
                    <input type="number" step="0.01" name="good_price" required>
                    <label>Наличие</label>
                    <select name="availability">
                        <?php
                        $availability_sql = "SELECT * FROM `availability`";
                        $availability_result = mysqli_query($sql, $availability_sql);
                        while ($row = mysqli_fetch_array($availability_result)):
                            ?>
                            <option value="<?= $row['availability_id'] ?>"><?= htmlspecialchars($row['availability_name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button type="submit">Добавить</button>
                </form>
            </section>
        <?php elseif ($type == "genres"): ?>
            <section class="red">
                <form class="red-form" action="/php/add.php?type=genres" method="post">
                    <h2>Добавить жанр</h2>
                    <label>Название</label>
                    <input type="text" name="genre_name" required>
                    <button type="submit">Добавить жанр</button>
                </form>
            </section>
        <?php elseif ($type == "adresess"): ?>
            <section class="red">
                <form class="red-form" action="/php/add.php?type=adresess" method="post">
                    <h2>Добавить новый адрес</h2>
                    <label>Полный адрес (Город, улица, дом, квартира)</label>
                    <input type="text" name="adreses_name" placeholder="Например: г. Москва, ул. Ленина, д. 1, кв. 5" required>
                    <button type="submit">Добавить адрес</button>
                </form>
            </section>
        <?php elseif ($type == "promocodes"): ?>
             <section class="red">
                <form class="red-form" action="/php/add.php?type=promocodes" method="post">
                    <h2>Добавить промокод</h2>
                    <label>Название промокода</label>
                    <input type="text" name="promocod_name" required>
                    <label>Процент скидки</label>
                    <input type="number" name="promocod_percent" min="1" max="100" required>
                    <label>Действует до</label>
                    <input type="datetime-local" name="percent_livetime" required>
                    <button type="submit">Добавить промокод</button>
                </form>
            </section>
        <?php elseif ($type == 'banner_hits' || $type == 'banner_news' || $type == 'banner_season'): ?>
            <?php
            if ($type == 'banner_hits') {
                $title = 'в баннер "Хиты"';
            } elseif ($type == 'banner_news') {
                $title = 'в баннер "Новинки"';
            } else {
                $title = 'в баннер "Сезонное"';
            }
            ?>
            <section class="red">
                <form class="red-form" action="/php/add.php?type=<?= $type ?>" method="post">
                    <h2>Добавить мангу <?= $title ?></h2>
                    <label>Выберите мангу</label>
                    <select name="manga_id" required>
                        <option value="" disabled selected>-- Выберите мангу --</option>
                        <?php
                        $goods_sql = "SELECT good_id, good_name FROM `goods` ORDER BY good_name ASC";
                        $goods_result = mysqli_query($sql, $goods_sql);
                        while ($row = mysqli_fetch_array($goods_result)):
                        ?>
                        <option value="<?= $row['good_id'] ?>"><?= htmlspecialchars($row['good_name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                    
                    <label>Номер изображения для баннера (например, 1, 2, 3)</label>
                    <input type="text" name="manga_img" required>
                    
                    <label>Краткое описание для баннера</label>
                    <textarea name="manga_desc" rows="5" cols="50" required></textarea>
                    
                    <button type="submit">Добавить в баннер</button>
                </form>
            </section>
        <?php else: ?>
             <div class="content">
                <h2>Ошибка: неизвестный тип для добавления.</h2>
            </div>
        <?php endif; ?>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        $sql->close();
        ?>
    </footer>
    <script src="/script/script.js"></script>
</body>

</html>