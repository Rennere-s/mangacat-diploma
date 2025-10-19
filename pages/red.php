<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/red.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />
</head>

<body class="redacture">
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
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($type == 'goods'):
            ?>
            <section class="red">
                <?php
                $goods_sql = "SELECT good_id, good_name, good_img, good_description, good_price, availability_name, good_availability FROM goods JOIN availability ON availability_id = good_availability WHERE good_id = '$id'";
                $goods_result = mysqli_query($sql, $goods_sql);
                $card = mysqli_fetch_array($goods_result);

                $selected_genres_sql = "SELECT m_genre_id FROM manga_genre WHERE g_manga_id = '" . $card['good_id'] . "'";
                $selected_genres_result = mysqli_query($sql, $selected_genres_sql);

                $selected_genres = [];
                while ($row = mysqli_fetch_array($selected_genres_result)) {
                    $selected_genres[] = $row['m_genre_id'];
                }
                ?>
                <form class="red-form" action="/php/red.php?type=goods" method="post">
                    <h2>Изменить <?= $card['good_name'] ?></h2>
                    <input type="hidden" name="good_id" value="<?= $card['good_id'] ?>">
                    <label>Название</label>
                    <input type="text" name="good_name" value="<?= $card['good_name'] ?>" required>
                    <label>Жанры</label>
                    <div class="genres">
                        <?php
                        $genres_sql = "SELECT * FROM `genres`";
                        $genres_result = mysqli_query($sql, $genres_sql);
                        while ($row = mysqli_fetch_array($genres_result)):
                            ?>
                            <div class="genres-element">
                                <input type="checkbox" name="genres[]" value="<?= $row['genre_id'] ?>" <?php if (in_array($row['genre_id'], $selected_genres))
                                      echo 'checked'; ?>> <?= $row['genre_name'] ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <label>Номер изображения</label>
                    <input type="text" name="good_img" value="<?= $card['good_img'] ?>">
                    <label>Описание товара</label>
                    <textarea name="good_description" rows="10" cols="50"><?= $card['good_description'] ?></textarea>
                    <label>Цена</label>
                    <input type="text" name="good_price" value="<?= $card['good_price'] ?>">
                    <label>Наличие</label>
                    <select name="availability">
                        <?php
                        $availability_sql = "SELECT * FROM `availability`";
                        $availability_result = mysqli_query($sql, $availability_sql);
                        while ($row = mysqli_fetch_array($availability_result)):
                            ?>
                            <option value="<?= $row['availability_id'] ?>" <?php if ($card['good_availability'] == $row['availability_id']): ?> selected <?php endif; ?>>
                                <?= $row['availability_name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <button type="submit">Изменить</button>
                </form>
            </section>
        <?php elseif ($type == "genres"): ?>
            <section class="red">
                <?php
                $genres_sql = "SELECT * FROM genres WHERE genre_id = '$id'";
                $genres_result = mysqli_query($sql, $genres_sql);
                $card = mysqli_fetch_array($genres_result);
                ?>
                <form class="red-form" action="/php/red.php?type=genres" method="post">
                    <h2>Изменить <?= $card['genre_name'] ?></h2>
                    <input type="hidden" name="genre_id" value="<?= $card['genre_id'] ?>">
                    <label>Название</label>
                    <input type="text" name="genre_name" value="<?= $card['genre_name'] ?>" required>
                    <button type="submit">Изменить</button>
                </form>
            </section>
        <?php elseif ($type == "users"): ?>
            <section class="red">
                <?php
                $users_sql = "SELECT * FROM users WHERE user_id = '$id'";
                $users_result = mysqli_query($sql, $users_sql);
                $card = mysqli_fetch_array($users_result);
                if ($_COOKIE['user_role'] != 2 && $_COOKIE['user_id'] != $id) {
                    echo "<h2>Доступ запрещен!</h2>";
                    exit();
                }
                ?>
                <form class="red-form" action="/php/red.php?type=users" method="post">
                    <h2>Изменить данные <?= $card['user_login'] ?></h2>
                    <input type="hidden" name="user_id" value="<?= $card['user_id'] ?>">
                    <label>Логин</label>
                    <input type="text" name="user_login" value="<?= $card['user_login'] ?>" required>
                    <label>Телефон</label>
                    <input type="tel" name="user_tel" value="<?= $card['user_tel'] ?>" required>
                    <label>Е-майл</label>
                    <input type="email" name="user_email" value="<?= $card['user_email'] ?>" required>
                    <label>Дата рождения</label>
                    <input type="date" name="user_date" value="<?= $card['user_date'] ?>" required>

                    <?php if ($_COOKIE['user_id'] == $id): ?>
                        <hr>
                        <p>Оставьте поля ниже пустыми, если не хотите менять пароль.</p>
                        <label>Новый пароль</label>
                        <input type="password" name="user_password_new" placeholder="Введите новый пароль">
                        <label>Подтвердите новый пароль</label>
                        <input type="password" name="user_password_confirm" placeholder="Подтвердите новый пароль">
                    <?php endif; ?>

                    <?php if ($_COOKIE['user_role'] == 2):  ?>
                        <hr>
                        <label>Роль пользователя</label>
                        <select name="user_role">
                            <?php
                            $role_sql = "SELECT * FROM `roles`";
                            $role_result = mysqli_query($sql, $role_sql);
                            while ($row = mysqli_fetch_array($role_result)):
                                ?>
                                <option value="<?= $row['role_id'] ?>" <?php if ($card['user_role'] == $row['role_id'])
                                      echo 'selected'; ?>>
                                    <?= $row['role_name'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    <?php endif; ?>
                    <button type="submit">Сохранить изменения</button>
                </form>
            </section>
        <?php elseif ($type == "adresess"): ?>
            <section class="red">
                <?php
                $adresess_sql = "SELECT * FROM adresess WHERE adreses_id = '$id' AND adreses_user = '{$_COOKIE['user_id']}'";
                $adresess_result = mysqli_query($sql, $adresess_sql);
                $card = mysqli_fetch_array($adresess_result);
                if (!$card) {
                    echo "<h2>Адрес не найден или у вас нет прав на его редактирование.</h2>";
                    exit();
                }
                ?>
                <form class="red-form" action="/php/red.php?type=adresess" method="post">
                    <h2>Изменить адрес</h2>
                    <input type="hidden" name="adreses_id" value="<?= $card['adreses_id'] ?>">
                    <label>Полный адрес</label>
                    <input type="text" name="adreses_name" value="<?= $card['adreses_name'] ?>" required>
                    <button type="submit">Сохранить</button>
                </form>
            </section>
        <?php elseif ($type == "orders"): ?>
            <section class="red">
                <?php
                $order_sql = "SELECT 
                        o.order_id, o.total_price, o.order_date, o.status_id,
                        u.user_login,
                        a.adreses_name
                      FROM orders o
                      JOIN users u ON o.user_id = u.user_id
                      JOIN adresess a ON o.address_id = a.adreses_id
                      WHERE o.order_id = '$id'";

                $order_result = mysqli_query($sql, $order_sql);

                if ($order_result && mysqli_num_rows($order_result) > 0) {
                    $card = mysqli_fetch_array($order_result);
                    ?>
                    <form class="red-form" action="/php/red.php?type=orders" method="post">
                        <h2>Изменить заказ №<?= $card['order_id'] ?></h2>
                        <input type="hidden" name="order_id" value="<?= $card['order_id'] ?>">
                        <div class="order-details">
                            <p><strong>Пользователь:</strong> <?= htmlspecialchars($card['user_login']) ?></p>
                            <p><strong>Адрес доставки:</strong> <?= htmlspecialchars($card['adreses_name']) ?></p>
                            <p><strong>Дата оформления:</strong> <?= date('d.m.Y H:i', strtotime($card['order_date'])) ?></p>
                            <p><strong>Итоговая сумма:</strong> <?= $card['total_price'] ?> ₽</p>
                            <hr>
                            <h4>Состав заказа:</h4>
                            <div class="order-items-list-red">
                                <?php
                                $items_sql = "SELECT oi.quantity, oi.price_per_item, g.good_name
                                      FROM order_items oi
                                      JOIN goods g ON oi.good_id = g.good_id
                                      WHERE oi.order_id = '{$card['order_id']}'";
                                $items_result = mysqli_query($sql, $items_sql);
                                while ($item = mysqli_fetch_array($items_result)):
                                    ?>
                                    <div class="item-in-order-red">
                                        <strong><?= htmlspecialchars($item['good_name']) ?></strong>
                                        <span>- <?= $item['quantity'] ?> шт. по <?= $item['price_per_item'] ?> ₽</span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                            <hr>
                        </div>
                        <label for="status_id">Статус заказа</label>
                        <select name="status_id" id="status_id">
                            <?php
                            $status_sql = "SELECT * FROM `order_status`";
                            $status_result = mysqli_query($sql, $status_sql);
                            while ($row = mysqli_fetch_array($status_result)):
                                ?>
                                <option value="<?= $row['order_status_id'] ?>" <?php if ($card['status_id'] == $row['order_status_id'])
                                      echo 'selected'; ?>>
                                    <?= htmlspecialchars($row['order_status_name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <button type="submit">Изменить статус</button>
                    </form>
                    <?php
                } else {
                    echo "<h2>Заказ не найден.</h2>";
                }
                ?>
            </section>
        <?php elseif ($type == "reviews"): ?>
            <section class="red">
                <?php
                $review_sql = "SELECT r.review_id, r.review_text, r.review_rating, r.review_status, u.user_login, g.good_name
                               FROM reviews r
                               JOIN users u ON r.review_user = u.user_id
                               JOIN goods g ON r.review_manga = g.good_id
                               WHERE r.review_id = '$id'";
                $review_result = mysqli_query($sql, $review_sql);

                if ($review_result && mysqli_num_rows($review_result) > 0) {
                    $card = mysqli_fetch_array($review_result);
                    ?>
                    <form class="red-form" action="/php/red.php?type=reviews" method="post">
                        <h2>Редактирование отзыва</h2>
                        <input type="hidden" name="review_id" value="<?= $card['review_id'] ?>">
                        <div class="review-info">
                            <p><strong>Пользователь:</strong> <?= htmlspecialchars($card['user_login']) ?></p>
                            <p><strong>Манга:</strong> <?= htmlspecialchars($card['good_name']) ?></p>
                            <p><strong>Рейтинг:</strong>
                                <?php for ($i = 1; $i <= 5; $i++) {
                                    echo ($i <= $card['review_rating']) ? '<i class="fas fa-star" style="color: #ffc107;"></i>' : '<i class="far fa-star"></i>';
                                } ?>
                            </p>
                        </div>
                        <label for="review_text">Текст отзыва:</label>
                        <textarea id="review_text" name="review_text"
                            rows="8"><?= htmlspecialchars($card['review_text']) ?></textarea>
                        <label for="review_status">Статус отзыва:</label>
                        <select name="review_status" id="review_status">
                            <?php
                            $status_sql = "SELECT * FROM `review_status`";
                            $status_result = mysqli_query($sql, $status_sql);
                            while ($row = mysqli_fetch_array($status_result)):
                                ?>
                                <option value="<?= $row['review_status_id'] ?>" <?php if ($card['review_status'] == $row['review_status_id'])
                                      echo 'selected'; ?>>
                                    <?= htmlspecialchars($row['review_status_name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <button type="submit">Сохранить изменения</button>
                    </form>
                    <?php
                } else {
                    echo "<h2>Отзыв не найден.</h2>";
                }
                ?>
            </section>
        <?php elseif ($type == "promocodes"): ?>
            <section class="red">
                <?php
                $promo_sql = "SELECT * FROM promocodes WHERE promocod_id = '$id'";
                $promo_result = mysqli_query($sql, $promo_sql);
                $card = mysqli_fetch_array($promo_result);
                ?>
                <form class="red-form" action="/php/red.php?type=promocodes" method="post">
                    <h2>Редактировать промокод</h2>
                    <input type="hidden" name="promocod_id" value="<?= $card['promocod_id'] ?>">
                    <label>Название</label>
                    <input type="text" name="promocod_name" value="<?= $card['promocod_name'] ?>" required>
                    <label>Процент скидки</label>
                    <input type="number" name="promocod_percent" value="<?= $card['promocod_percent'] ?>" min="1" max="100"
                        required>
                    <label>Действует до</label>
                    <input type="datetime-local" name="percent_livetime"
                        value="<?= date('Y-m-d\TH:i', strtotime($card['percent_livetime'])) ?>" required>
                    <button type="submit">Сохранить</button>
                </form>
            </section>
        <?php elseif ($type == 'banner_hits' || $type == 'banner_news' || $type == 'banner_season'): ?>
            <section class="red">
                <?php
                if ($type == 'banner_hits') {
                    $title = 'в баннере "Хиты"';
                    $table = 'banner_hits';
                    $id_col = 'hits_manga_id';
                    $img_col = 'hits_manga_img';
                    $desc_col = 'hits_manga_desc';
                } elseif ($type == 'banner_news') {
                    $title = 'в баннере "Новинки"';
                    $table = 'banner_news';
                    $id_col = 'new_manga_id';
                    $img_col = 'new_manga_img';
                    $desc_col = 'new_manga_desc';
                } else {
                    $title = 'в баннере "Сезонное"';
                    $table = 'banner_season';
                    $id_col = 'season_manga_id';
                    $img_col = 'season_manga_img';
                    $desc_col = 'season_manga_desc';
                }
                $banner_sql = "SELECT b.*, g.good_name FROM `$table` b JOIN goods g ON b.`$id_col` = g.good_id WHERE b.`$id_col` = '$id'";
                $banner_result = mysqli_query($sql, $banner_sql);
                $card = mysqli_fetch_array($banner_result);
                ?>
                <form class="red-form" action="/php/red.php?type=<?= $type ?>" method="post">
                    <h2>Редактировать запись <?= $title ?></h2>
                    <input type="hidden" name="manga_id" value="<?= $card[$id_col] ?>">
                    <p><strong>Манга:</strong> <?= $card['good_name'] ?></p>
                    <label>Номер изображения для баннера</label>
                    <input type="text" name="manga_img" value="<?= $card[$img_col] ?>" required>
                    <label>Краткое описание для баннера</label>
                    <textarea name="manga_desc" rows="5" cols="50" required><?= $card[$desc_col] ?></textarea>
                    <button type="submit">Сохранить</button>
                </form>
            </section>
        <?php else: ?>
            <div class="content">
                <h2>Ошибка: неизвестный тип для редактирования.</h2>
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