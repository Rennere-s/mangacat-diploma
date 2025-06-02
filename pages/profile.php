<?php

$link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');

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
                <a onclick="openModal()"><i class="fas fa-sign-out-alt"></i> Выход</a>
            </div>
            <?php
            $type = filter_var(trim($_GET["type"]));
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
                                <th>Описание</th>
                                <th>Цена</th>
                                <th>В наличии</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php
                            $goods_sql = "SELECT good_id, good_name, GROUP_CONCAT(genres.genre_name SEPARATOR ', ') AS genres, good_img, good_back_img, good_description, good_price, availability_name FROM goods LEFT JOIN manga_genre ON g_manga_id = good_id LEFT JOIN genres ON genres.genre_id = manga_genre.m_genre_id JOIN availability ON availability_id = good_availability GROUP BY good_id";
                            $goods_result = mysqli_query($link, $goods_sql);
                            while ($row = mysqli_fetch_array($goods_result)):

                                ?>
                                <tr>
                                    <td><?= $row['good_id'] ?></td>
                                    <td><?= $row['good_name'] ?></td>
                                    <td><?= $row['genres'] ?></td>
                                    <td><img src="<?= $row['good_img'] ?>" alt="<?= $row['good_name'] ?>" width="100%"></td>
                                    <td><img src="<?= $row['good_back_img'] ?>" alt="<?= $row['good_name'] ?> задняя обложка" width="80%">
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
                            $users_result = mysqli_query($link, $users_sql);
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
                            $genres_result = mysqli_query($link, $genres_sql);
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
            $type = $_GET['type'];
            if (!isset($type)):
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
                        <h1>Добро пожаловать, <?= $_COOKIE['user_login'] ?></h1>
                    </div>
                    <div class="main">
                        <h2>Ваши заказы</h2>
                        <table class="table">
                            <tr>
                                <th>Дата заказа</th>
                                <th>Название заказанного тома</th>
                                <th width="10%">фото заказанного тома</th>
                                <th>Количество</th>
                                <th>Стоимость</th>
                                <th>Статус заказа</th>
                            </tr>
                            <?php
                            $orders_user_sql = "SELECT `order_date`, `good_name`, `good_img`, `order_good_amount`, `order_price`, `order_status_name`, `order_id` FROM `orders` JOIN goods ON `order_good_id` = `good_id` JOIN `order_status` ON `order_status_id` = `order_status` WHERE `order_user_id` = '$user_id'";
                            $orders_user_result = mysqli_query($link, $orders_user_sql);
                            while ($row = mysqli_fetch_array($orders_user_result)):

                                ?>
                                <tr>
                                    <td><?=$row['order_date']?></td>
                                    <td><?=$row['good_name']?></td>
                                    <td><img src="<?= $row['good_img'] ?>" alt="<?= $row['good_name'] ?>" width="100%"></td>
                                    <td><?=$row['order_good_amount']?></td>
                                    <td><?=$row['order_price']?></td>
                                    <td><?=$row['order_status_name']?></td>
                                    <td><a href="/php/del.php?type=orders&id=<?= $row['order_id'] ?>&type_id=order_id"><button
                                                class="button">Отменить заказ</button></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php elseif ($type == 'profile'): ?>
                <div class="content">
                    <div class="top-bar">
                        <h1>Добро пожаловать, <?= $_COOKIE['user_login'] ?></h1>
                    </div>
                    <?php


                    $users_sql = "SELECT `user_id`, `user_login`, `user_tel`, `user_email`, `user_date` FROM `users` WHERE `user_id` = '$user_id'";
                    $users_result = mysqli_query($link, $users_sql);
                    $user = mysqli_fetch_array($users_result);

                    ?>
                    <div class="main">
                        <p>Логин: <?= $user['user_login'] ?></p>
                        <p>Телефон: <?= $user['user_tel'] ?></p>
                        <p>Емейл: <?= $user['user_email'] ?></p>
                        <p>Дата рождения: <?= $user['user_date'] ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
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