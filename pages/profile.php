<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($_COOKIE['user_role'] == 1): ?>
            Профиль
        <?php else: ?>
            Админ-панель
        <?php endif; ?>
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/profile.css">
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
        <div class="hamburger" onclick="toggleSidebar()">☰</div>
        <?php if ($_COOKIE['user_role'] == 2): ?>
            <div class="sidebar">
                <h2>Админ-панель</h2>
                <a href="/pages/profile.php?type=goods"><i class="fas fa-book"></i> Тома</a>
                <a href="/pages/profile.php?type=users"><i class="fas fa-users"></i> Пользователи</a>
                <a href="/pages/profile.php?type=genres"><i class="fas fa-chart-bar"></i> Жанры</a>
                <a href="/pages/profile.php?type=reviews"><i class="fas fa-pen-to-square"></i> Отзывы</a>
                <a href="/pages/profile.php?type=orders"><i class="fas fa-shopping-cart"></i> Заказы</a>
                <a href="/pages/profile.php?type=promocodes"><i class="fas fa-percent"></i> Промокоды</a>
                <a href="/pages/profile.php?type=feedback"><i class="fas fa-envelope"></i> Сообщения</a>
                <hr>
                <p class="sidebar-subtitle">Баннеры</p>
                <a href="/pages/profile.php?type=banner_hits"><i class="fas fa-fire"></i> Хиты</a>
                <a href="/pages/profile.php?type=banner_news"><i class="fas fa-newspaper"></i> Новинки</a>
                <a href="/pages/profile.php?type=banner_season"><i class="fas fa-star"></i> Сезонное</a>
                <hr>
                <a onclick="openModal()"><i class="fas fa-sign-out-alt"></i> Выход</a>
            </div>
            <?php
            $type = isset($_GET["type"]) ? filter_var(trim($_GET["type"])) : '';
            if (empty($type)):

                ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Добро пожаловать, <?= $_COOKIE['user_login'] ?></h1>
                    </div>
                    <div class="main">
                        <p>Пожалуйста, выберите одну из категорий редактирования слева</p>
                    </div>
                </div>
            <?php elseif ($type == 'goods'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Редактирование манги</h1>
                        <div class="user-info">
                            <i class="fas fa-user"></i>
                            <span><?= $_COOKIE['user_login'] ?></span>
                        </div>
                    </div>

                    <div class="main">
                        <a href="/pages/add.php?type=goods"><button class="button">Добавить новую книгу</button></a>
                        <table class="table">
                            <tr>
                                <th>Айди</th>
                                <th>Название</th>
                                <th>Жанры</th>
                                <th>Фото спереди</th>
                                <th>Фото сзади</th>
                                <th>Фото страниц</th>
                                <th>Описание</th>
                                <th>Цена</th>
                                <th>В наличии</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
                            $goods_sql = "SELECT good_id, good_name, GROUP_CONCAT(genres.genre_name SEPARATOR ', ') AS genres, good_img, good_description, good_price, availability_name FROM goods LEFT JOIN manga_genre ON g_manga_id = good_id LEFT JOIN genres ON genres.genre_id = manga_genre.m_genre_id JOIN availability ON availability_id = good_availability GROUP BY good_id";
                            $goods_result = mysqli_query($sql, $goods_sql);
                            while ($row = mysqli_fetch_array($goods_result)):

                                ?>
                                <tr>
                                    <td><?= $row['good_id'] ?></td>
                                    <td><?= $row['good_name'] ?></td>
                                    <td><?= $row['genres'] ?></td>
                                    <td><img src="/img/product_<?= $row['good_img'] ?>.jpg" alt="<?= $row['good_name'] ?>"
                                            width="100%"></td>
                                    <td><img src="/img/product_back<?= $row['good_img'] ?>.jpg"
                                            alt="<?= $row['good_name'] ?> задняя обложка" width="80%">
                                    </td>
                                    <td><img src="/img/product_pages<?= $row['good_img'] ?>.jpg"
                                            alt="<?= $row['good_name'] ?> страницы" width="80%">
                                    </td>
                                    <td><?= $row['good_description'] ?></td>
                                    <td><?= $row['good_price'] ?></td>
                                    <td><?= $row['availability_name'] ?></td>
                                    <td><a href="/pages/red.php?type=goods&id=<?= $row['good_id'] ?>"><button
                                                class="button">Изменить</button></a></td>
                                    <td><a href="/php/del.php?type=goods&id=<?= $row['good_id'] ?>&type_id=good_id"><button
                                                class="button">Удалить</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'feedback'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Сообщения обратной связи</h1>
                    </div>
                    <div class="main">
                        <table class="table feedback-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Отправитель</th>
                                    <th>Email</th>
                                    <th width="40%">Сообщение</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $feedback_sql = "SELECT * FROM `feedback_messages`";
                                $feedback_result = mysqli_query($sql, $feedback_sql);
                                while ($row = mysqli_fetch_array($feedback_result)):
                                    ?>
                                    <tr>
                                        <td><?= $row['message_id'] ?></td>
                                        <td><?= htmlspecialchars($row['sender_name']) ?></td>
                                        <td><a
                                                href="mailto:<?= htmlspecialchars($row['sender_email']) ?>"><?= htmlspecialchars($row['sender_email']) ?></a>
                                        </td>
                                        <td><?= nl2br(htmlspecialchars($row['message_text'])) ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'users'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Редактирование пользователей</h1>
                        <div class="user-info">
                            <i class="fas fa-user"></i>
                            <span><?= $_COOKIE['user_login'] ?></span>
                        </div>
                    </div>

                    <div class="main">
                        <table class="table">
                            <tr>
                                <th>Айди пользователя</th>
                                <th>Логин пользователя</th>
                                <th>Телефон пользователя</th>
                                <th>Почта пользователя</th>
                                <th>Дата рождения пользователя</th>
                                <th>Роль пользователя</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
                            $users_sql = "SELECT `user_id`, `user_login`, `user_tel`, `user_email`, `user_date`, `role_name` FROM `users` JOIN `roles` on `user_role` = `role_id` ";
                            $users_result = mysqli_query($sql, $users_sql);
                            while ($row = mysqli_fetch_array($users_result)):

                                ?>
                                <tr>
                                    <td><?= $row['user_id'] ?></td>
                                    <td><?= $row['user_login'] ?></td>
                                    <td><?= $row['user_tel'] ?></td>
                                    <td><?= $row['user_email'] ?></td>
                                    <td><?= $row['user_date'] ?></td>
                                    <td><?= $row['role_name'] ?></td>
                                    <td><a href="/pages/red.php?type=users&id=<?= $row['user_id'] ?>"><button
                                                class="button">Изменить</button></a></td>
                                    <td><a href="/php/del.php?type=users&id=<?= $row['user_id'] ?>&type_id=user_id"><button
                                                class="button">Удалить</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'genres'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Редактирование жанров</h1>
                        <div class="user-info">
                            <i class="fas fa-user"></i>
                            <span><?= $_COOKIE['user_login'] ?></span>
                        </div>
                    </div>

                    <div class="main">
                        <a href="/pages/add.php?type=genres"><button class="button">Добавить новый жанр</button></a>
                        <table class="table">
                            <tr>
                                <th width="1%">Id жанра</th>
                                <th>Название жанра</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                            <?php
                            $genres_sql = "SELECT * FROM `genres`";
                            $genres_result = mysqli_query($sql, $genres_sql);
                            while ($row = mysqli_fetch_array($genres_result)):

                                ?>
                                <tr>
                                    <td><?= $row['genre_id'] ?></td>
                                    <td><?= $row['genre_name'] ?></td>
                                    <td><a href="/pages/red.php?type=genres&id=<?= $row['genre_id'] ?>"><button
                                                class="button">Изменить</button></a></td>
                                    <td><a href="/php/del.php?type=genres&id=<?= $row['genre_id'] ?>&type_id=genre_id"><button
                                                class="button">Удалить</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'reviews'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Редактирование отзывов</h1>
                    </div>
                    <div class="main">
                        <table class="table">
                            <tr>
                                <th>Айди</th>
                                <th>Имя пользователя</th>
                                <th>Название манги</th>
                                <th>Текст отзыва</th>
                                <th>Рейтинг отзыва</th>
                                <th>Дата отзыва</th>
                                <th>Статус</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
                            $review_sql = "SELECT `review_id`, `user_login`, `good_name`, `review_text`, `review_rating`, `review_date`, `review_status_name` FROM `reviews` 
                            JOIN `users` on `review_user` = `user_id` 
                            JOIN `goods` on `good_id` = `review_manga`
                            JOIN `review_status` on `review_status` = `review_status_id`";
                            $review_result = mysqli_query($sql, $review_sql);
                            while ($row = mysqli_fetch_array($review_result)):

                                ?>
                                <tr>
                                    <td><?= $row['review_id'] ?></td>
                                    <td><?= $row['user_login'] ?></td>
                                    <td><?= $row['good_name'] ?></td>
                                    <td><?= $row['review_text'] ?></td>
                                    <td><?= $row['review_rating'] ?></td>
                                    <td><?= $row['review_date'] ?></td>
                                    <td><?= $row['review_status_name'] ?></td>
                                    <td><a href="/pages/red.php?type=reviews&id=<?= $row['review_id'] ?>"><button
                                                class="button">Изменить</button></a></td>
                                    <td><a href="/php/del.php?type=reviews&id=<?= $row['review_id'] ?>&type_id=review_id"><button
                                                class="button">Удалить</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'promocodes'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Управление промокодами</h1>
                    </div>
                    <div class="main">
                        <a href="/pages/add.php?type=promocodes"><button class="button">Добавить промокод</button></a>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Скидка (%)</th>
                                <th>Действует до</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
                            $promo_sql = "SELECT * FROM `promocodes`";
                            $promo_result = mysqli_query($sql, $promo_sql);
                            while ($row = mysqli_fetch_array($promo_result)):
                                ?>
                                <tr>
                                    <td><?= $row['promocod_id'] ?></td>
                                    <td><?= $row['promocod_name'] ?></td>
                                    <td><?= $row['promocod_percent'] ?></td>
                                    <td><?= date('d.m.Y H:i', strtotime($row['percent_livetime'])) ?></td>
                                    <td><a href="/pages/red.php?type=promocodes&id=<?= $row['promocod_id'] ?>"><button
                                                class="button">Изменить</button></a></td>
                                    <td><a href="/php/del.php?type=promocodes&id=<?= $row['promocod_id'] ?>&type_id=promocod_id"><button
                                                class="button">Удалить</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'banner_hits' || $type == 'banner_news' || $type == 'banner_season'): ?>
                <div class="content">
                    <?php
                    if ($type == 'banner_hits') {
                        $title = 'баннером "Хиты"';
                        $table = 'banner_hits';
                        $id_col = 'hits_manga_id';
                    } elseif ($type == 'banner_news') {
                        $title = 'баннером "Новинки"';
                        $table = 'banner_news';
                        $id_col = 'new_manga_id';
                    } else {
                        $title = 'баннером "Сезонное"';
                        $table = 'banner_season';
                        $id_col = 'season_manga_id';
                    }
                    ?>
                    <div class="top-bar">
                        <h1>Управление <?= $title ?></h1>
                    </div>
                    <div class="main">
                        <a href="/pages/add.php?type=<?= $type ?>"><button class="button">Добавить мангу в баннер</button></a>
                        <table class="table">
                            <tr>
                                <th>ID Манги</th>
                                <th>Название</th>
                                <th>Описание в баннере</th>
                                <th>Изображение (путь)</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
                            $banner_sql = "SELECT b.*, g.good_name FROM `$table` b JOIN `goods` g ON b.`{$id_col}` = g.good_id";
                            $banner_result = mysqli_query($sql, $banner_sql);
                            while ($row = mysqli_fetch_array($banner_result)):
                                ?>
                                <tr>
                                    <td><?= $row[$id_col] ?></td>
                                    <td><?= $row['good_name'] ?></td>
                                    <td><?= $row[str_replace('_manga_id', '_manga_desc', $id_col)] ?></td>
                                    <td><?= $row[str_replace('_manga_id', '_manga_img', $id_col)] ?></td>
                                    <td><a href="/pages/red.php?type=<?= $type ?>&id=<?= $row[$id_col] ?>"><button
                                                class="button">Изменить</button></a></td>
                                    <td><a href="/php/del.php?type=<?= $table ?>&id=<?= $row[$id_col] ?>&type_id=<?= $id_col ?>"><button
                                                class="button">Удалить</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'orders'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Управление заказами</h1>
                    </div>
                    <div class="main">
                        <table class="table orders-table">
                            <thead>
                                <tr>
                                    <th>ID Заказа</th>
                                    <th>Пользователь</th>
                                    <th>Дата</th>
                                    <th>Адрес доставки</th>
                                    <th width="30%">Состав заказа</th>
                                    <th>Итоговая сумма</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $orders_sql = "SELECT 
                                    o.order_id, o.total_price, o.order_date, o.status_id,
                                    u.user_login,
                                    os.order_status_name,
                                    a.adreses_name
                               FROM orders o
                               JOIN users u ON o.user_id = u.user_id
                               JOIN order_status os ON o.status_id = os.order_status_id
                               JOIN adresess a ON o.address_id = a.adreses_id
                               ORDER BY o.order_id DESC";

                                $orders_result = mysqli_query($sql, $orders_sql);
                                while ($order = mysqli_fetch_array($orders_result)):
                                    ?>
                                    <tr>
                                        <td>#<?= $order['order_id'] ?></td>
                                        <td><?= htmlspecialchars($order['user_login']) ?></td>
                                        <td><?= date('d.m.Y H:i', strtotime($order['order_date'])) ?></td>
                                        <td><?= htmlspecialchars($order['adreses_name']) ?></td>
                                        <td>
                                            <div class="order-items-list">
                                                <?php
                                                $order_id = $order['order_id'];
                                                $items_sql = "SELECT oi.quantity, oi.price_per_item, g.good_name
                                          FROM order_items oi
                                          JOIN goods g ON oi.good_id = g.good_id
                                          WHERE oi.order_id = '$order_id'";
                                                $items_result = mysqli_query($sql, $items_sql);
                                                while ($item = mysqli_fetch_array($items_result)):
                                                    ?>
                                                    <p class="item-in-order">
                                                        <?= htmlspecialchars($item['good_name']) ?>
                                                        <span>(<?= $item['quantity'] ?> шт. x <?= $item['price_per_item'] ?> ₽)</span>
                                                    </p>
                                                <?php endwhile; ?>
                                            </div>
                                        </td>
                                        <td><strong><?= $order['total_price'] ?> ₽</strong></td>
                                        <td><?= htmlspecialchars($order['order_status_name']) ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="/pages/red.php?type=orders&id=<?= $order['order_id'] ?>"><button
                                                        class="button">Изменить</button></a>
                                                <a href="/php/del.php?type=orders&id=<?= $order['order_id'] ?>&type_id=order_id"><button
                                                        class="button">Удалить</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        <?php else:
            ?>
            <div class="sidebar">
                <h2><?= $_COOKIE['user_login'] ?></h2>
                <a href="/pages/profile.php?type=orders"><i class="fas fa-book"></i> Ваши заказы</a>
                <a href="/pages/profile.php?type=profile"><i class="fas fa-users"></i> Ваш профиль</a>
                <a href="/pages/profile.php?type=adress"><i class="fas fa-gear"></i>Ваши адреса</a>
                <a onclick="openModal()"><i class="fas fa-sign-out-alt"></i> Выход</a>
            </div>
            <?php
            $user_id = $_COOKIE['user_id'];
            $type = isset($_GET['type']) ? $_GET['type'] : '';
            if (empty($type)):
                ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Добро пожаловать, <?= $_COOKIE['user_login'] ?></h1>
                    </div>
                    <div class="main">
                        <p>Пожалуйста, выберите одну из категорий слева</p>
                    </div>
                </div>
            <?php elseif ($type == 'orders'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Ваши заказы</h1>
                    </div>
                    <div class="main">
                        <table class="table orders-table">
                            <thead>
                                <tr>
                                    <th>№ Заказа / Дата</th>
                                    <th width="40%">Состав заказа</th>
                                    <th>Сумма</th>
                                    <th>Статус</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_COOKIE['user_id'];
                                $orders_user_sql = "SELECT
                                        o.order_id, o.total_price, o.order_date, o.status_id,
                                        os.order_status_name
                                    FROM orders o
                                    JOIN order_status os ON o.status_id = os.order_status_id
                                    WHERE o.user_id = '$user_id'
                                    ORDER BY o.order_id DESC";
                                $orders_user_result = mysqli_query($sql, $orders_user_sql);
                                while ($order = mysqli_fetch_array($orders_user_result)):
                                    ?>
                                    <tr>
                                        <td>
                                            <strong>#<?= $order['order_id'] ?></strong>
                                            <br>
                                            <small><?= date('d.m.Y H:i', strtotime($order['order_date'])) ?></small>
                                        </td>
                                        <td>
                                            <div class="order-items-list">
                                                <?php
                                                $order_id = $order['order_id'];
                                                $items_sql = "SELECT oi.quantity, g.good_name, g.good_img
                                          FROM order_items oi
                                          JOIN goods g ON oi.good_id = g.good_id
                                          WHERE oi.order_id = '$order_id'";
                                                $items_result = mysqli_query($sql, $items_sql);
                                                while ($item = mysqli_fetch_array($items_result)):
                                                    ?>
                                                    <div class="user-order-item">
                                                        <img src="/img/product_<?= htmlspecialchars($item['good_img']) ?>.jpg" alt="">
                                                        <p>
                                                            <?= htmlspecialchars($item['good_name']) ?>
                                                            <span>(<?= $item['quantity'] ?> шт.)</span>
                                                        </p>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        </td>
                                        <td><strong><?= $order['total_price'] ?> ₽</strong></td>
                                        <td><?= htmlspecialchars($order['order_status_name']) ?></td>
                                        <td>
                                            <?php if ($order['status_id'] == 1): ?>
                                                <a href="/php/del.php?type=orders&id=<?= $order['order_id'] ?>&type_id=order_id">
                                                    <button class="button cancel-button">Отменить заказ</button>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'profile'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Ваши данные, <?= $_COOKIE['user_login'] ?></h1>
                    </div>
                    <?php
                    $users_sql = "SELECT `user_id`, `user_login`, `user_tel`, `user_email`, `user_date` FROM `users` WHERE `user_id` = '$user_id'";
                    $users_result = mysqli_query($sql, $users_sql);
                    $user = mysqli_fetch_array($users_result);
                    ?>
                    <div class="main profile-info">
                        <p><strong>Логин:</strong> <?= $user['user_login'] ?></p>
                        <p><strong>Телефон:</strong> <?= $user['user_tel'] ?></p>
                        <p><strong>Емейл:</strong> <?= $user['user_email'] ?></p>
                        <p><strong>Дата рождения:</strong> <?= date('d.m.Y', strtotime($user['user_date'])) ?></p>
                        <br>
                        <a href="/pages/red.php?type=users&id=<?= $user['user_id'] ?>"><button class="button">Настроить
                                данные</button></a>
                    </div>
                </div>
            <?php elseif ($type == 'adress'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Ваши адреса доставки</h1>
                    </div>
                    <div class="main">
                        <a href="/pages/add.php?type=adresess"><button class="button">Добавить новый адрес</button></a>
                        <table class="table">
                            <tr>
                                <th>Адрес</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
                            $adresess_sql = "SELECT * FROM `adresess` WHERE `adreses_user` = '$user_id'";
                            $adresess_result = mysqli_query($sql, $adresess_sql);
                            while ($row = mysqli_fetch_array($adresess_result)):
                                ?>
                                <tr>
                                    <td><?= $row['adreses_name'] ?></td>
                                    <td width="5%"><a href="/pages/red.php?type=adresess&id=<?= $row['adreses_id'] ?>"><button
                                                class="button">Изменить</button></a></td>
                                    <td width="5%"><a
                                            href="/php/del.php?type=adresess&id=<?= $row['adreses_id'] ?>&type_id=adreses_id"><button
                                                class="button">Удалить</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        $sql->close();
        ?>
    </footer>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
    <script src="/script/script.js"></script>
</body>

</html>