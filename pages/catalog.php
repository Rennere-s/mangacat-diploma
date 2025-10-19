<?php
session_start();
$root_for_db = $_SERVER['DOCUMENT_ROOT'];
require_once "$root_for_db/php/db.php";
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
        <?php
        $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
        $min_price = isset($_GET['min-price']) ? htmlspecialchars($_GET['min-price']) : '';
        $max_price = isset($_GET['max-price']) ? htmlspecialchars($_GET['max-price']) : '';
        $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
        $availability = isset($_GET['availability']) ? $_GET['availability'] : '';
        ?>
        <div class="catalog-content">
            <aside class="filter">
                <form action="/pages/catalog.php" method="get">
                    <label>Сортировать по:</label>
                    <input name="search" type="text" value="<?= $search ?>" placeholder="Поиск">

                    <label>Цена:</label>
                    <div class="price-inputs">
                        <input type="number" name="min-price" value="<?= $min_price ?>" placeholder="От">
                        <input type="number" name="max-price" value="<?= $max_price ?>" placeholder="До">
                    </div>

                    <label>Категории:</label>
                    <select name="id">
                        <option value="">Все</option>
                        <?php
                        $genres_sql = "SELECT * FROM `genres` ORDER BY genre_name ASC";
                        $genres_result = mysqli_query($sql, $genres_sql);
                        while ($row = mysqli_fetch_array($genres_result)):
                            ?>
                            <option value="<?= $row['genre_id'] ?>" <?php if ($row['genre_id'] == $id): ?> selected <?php endif; ?>>
                                <?= $row['genre_name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <label class="checkbox-label">
                        <input name="availability" type="checkbox" <?php if (!empty($availability))
                            echo 'checked'; ?>>
                        В наличии
                    </label>
                    <div class="filter-buttons">
                        <button type="submit">Показать</button>
                        <a href="/pages/catalog.php" class="reset-button">Сбросить</a>
                    </div>
                </form>
            </aside>
            <section class="products">
                <?php
                
                $whereClauses = [];
                $params = [];
                $types = "";

                if (!empty($search)) {
                    $whereClauses[] = "good_name LIKE ?";
                    $params[] = "%" . trim($search) . "%"; 
                    $types .= "s";
                }

                if (!empty($min_price) && is_numeric($min_price)) {
                    $whereClauses[] = "good_price >= ?";
                    $params[] = $min_price;
                    $types .= "d";
                }

                if (!empty($max_price) && is_numeric($max_price)) {
                    $whereClauses[] = "good_price <= ?";
                    $params[] = $max_price;
                    $types .= "d";
                }

                if (!empty($availability)) {
                    $whereClauses[] = "good_availability = 1"; 
                }

                $whereSql = count($whereClauses) > 0 ? "WHERE " . implode(" AND ", $whereClauses) : "";

                $good_sql = "
                    SELECT good_id, good_name, good_img, good_description, good_price, good_availability, genres
                    FROM (
                        SELECT 
                            g.good_id, g.good_name, g.good_img, g.good_description, g.good_price, g.good_availability,
                            GROUP_CONCAT(mg.m_genre_id SEPARATOR ',') AS genres 
                        FROM goods g
                        LEFT JOIN manga_genre mg ON mg.g_manga_id = g.good_id
                        {$whereSql}
                        GROUP BY g.good_id
                    ) AS filtered_goods
                ";

                if (!empty($id) && is_numeric($id)) {
                    $good_sql .= " WHERE FIND_IN_SET(?, genres)";
                    $params[] = $id;
                    $types .= "i";
                }

                $stmt = mysqli_prepare($sql, $good_sql);
                if ($stmt === false) {
                    die("Ошибка подготовки запроса: " . mysqli_error($sql));
                }

                if (!empty($params)) {
                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                }

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)):
                        ?>
                        <div class="product">
                            <a href="/pages/good_card.php?id=<?= $row['good_id'] ?>">
                                <img src="/img/product_<?= htmlspecialchars($row['good_img']) ?>.jpg"
                                    alt="<?= htmlspecialchars($row['good_name']) ?>" loading="lazy">
                            </a>
                            <div class="product-no-image">
                                <a href="/pages/good_card.php?id=<?= $row['good_id'] ?>">
                                    <div class="product-title"><?= htmlspecialchars($row['good_name']) ?></div>
                                </a>
                                <div class="product-desc truncate"><?= htmlspecialchars($row['good_description']) ?></div>
                                <div class="product-footer">
                                    <div class="product-price"><?= $row['good_price'] ?> ₽</div>
                                    <form class="product-actions" action="/php/cart.php" method="post">
                                        <input type='hidden' name='id' value='<?= $row['good_id'] ?>'>
                                        <button name="add_to_cart" type="submit" title="Добавить в корзину"><i
                                                class="fas fa-shopping-cart"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                } else {
                    echo "<p class='not-found-message'>Товары по вашему запросу не найдены. Попробуйте изменить фильтры.</p>";
                }
                ?>
            </section>
        </div>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        $sql->close();
        ?>
    </footer>
    <?php
    if (isset($_SESSION['success_message'])) {
        $message = $_SESSION['success_message'];
        unset($_SESSION['success_message']); 
        echo "<script>alert('" . addslashes($message) . "');</script>";
    }
    ?>
    <script src="/script/script.js"></script>
</body>

</html>