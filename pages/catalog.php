<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/catalog.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />    
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
                <form action="/pages/catalog.php" method="get">
                    <label>Сортировать по:</label>
                    <input name="search" type="text" placeholder="Поиск">
                    <button type="submit">Найти</button>

                    <label>Цена:</label>
                    <input type="number" name="min-price" placeholder="От">
                    <input type="number" name="max-price" placeholder="До">

                    <label>Категории:</label>
                    <select name="id">
                        <option value="">Все</option>
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
                        <input name="availability" type="checkbox" checked> В наличии
                    </label>

                    <button type="submit">Показать</button>
                    <button type="reset">Сбросить</button>
                </form>
            </aside>
            <section class="products">
                    <?php
                    $search = $_GET['search'] ?? '';
                    $min_price = $_GET['min-price'] ?? '';
                    $max_price = $_GET['max-price'] ?? '';
                    $id = $_GET['id'] ?? '';
                    $availability = $_GET['availability'] ?? '';

                    // Подключение
                    $good_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                    if (!$good_link) {
                        die("Ошибка подключения: " . mysqli_connect_error());
                    }

                    $whereClauses = ["1=1"];
                    $params = [];
                    $types = "";

                    // Формируем условия
                    if (!empty($search)) {
                        $whereClauses[] = "good_name LIKE ?";
                        $params[] = "%$search%";
                        $types .= "s";
                    }

                    if (!empty($min_price)) {
                        $whereClauses[] = "good_price > ?";
                        $params[] = $min_price;
                        $types .= "d";
                    }

                    if (!empty($max_price)) {
                        $whereClauses[] = "good_price < ?";
                        $params[] = $max_price;
                        $types .= "d";
                    }

                    // SQL-запрос
                    $good_sql = "
                        SELECT 
                            good_id, 
                            good_name, 
                            good_img, 
                            good_description, 
                            good_price, 
                            good_availability, 
                            GROUP_CONCAT(m_genre_id SEPARATOR ',') AS genres 
                        FROM goods
                        LEFT JOIN manga_genre ON g_manga_id = good_id
                        WHERE " . implode(" AND ", $whereClauses) . "
                        GROUP BY good_id
                    ";

                    // Добавляем HAVING только если $id задан
                    if (!empty($id)) {
                        $good_sql .= " HAVING genres LIKE ?";
                        $params[] = "%$id%";
                        $types .= "s";
                    }

                    // Подготавливаем запрос
                    $stmt = mysqli_prepare($good_link, $good_sql);
                    if ($stmt === false) {
                        die("Ошибка подготовки запроса: " . mysqli_error($good_link));
                    }

                    // Привязываем параметры, если они есть
                    if (!empty($params)) {
                        mysqli_stmt_bind_param($stmt, $types, ...$params);
                    }

                    // Выполняем запрос
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    // Выводим результат
                    while ($row = mysqli_fetch_array($result)):
                    ?>
                    <div class="product">
                        <a href="/pages/good_card.php?id=<?= $row['good_id'] ?>">
                            <img src="<?= $row['good_img'] ?>" alt="<?= $row['good_name'] ?>"  loading="lazy">
                        </a>
                        <div class="product-no-image">
                            <a href="/pages/good_card.php?id=<?= $row['good_id'] ?>">
                                <div class="product-title"><?= $row['good_name'] ?></div>
                            </a>
                            <div class="product-desc truncate"><?= $row['good_description'] ?></div>
                            <div class="product-footer">
                                <div class="product-price"><?= $row['good_price'] ?></div>
                                    <form class="product-actions" action="/php/cart.php" method="post">
                                        <input type='hidden' name='id' value='<?= $row['good_id']?>'>
                                        <button name="add_to_favorite" type="submit"><i class="fas fa-heart"></i></button>
                                        <button name="add_to_cart" type="submit"><i class="fas fa-shopping-cart"></i></button>
                                    </form>
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
    <?php
    
    if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Очищаем сообщение
    echo "<script>alert('$message');</script>";
    }
    
    ?>
    <script src="/script/script.js"></script>
</body>

</html>