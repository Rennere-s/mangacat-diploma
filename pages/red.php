<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/red.css">
</head>

<body class="redacture">
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/php/modules/header.php";
        ?>
    </header>
    <main class="main">
        <?php
        $type = $_GET['type'];
        $id = $_GET['id'];
        if ($type == 'goods'):
            ?>
            <section class="red">
                <?php
                $goods_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');

                $goods_sql = "SELECT good_id, good_name, good_img, good_back_img, good_description, good_price, availability_name, good_availability FROM goods JOIN availability ON availability_id = good_availability WHERE good_id = '$id'";

                $goods_result = mysqli_query($goods_link, $goods_sql);
                $card = mysqli_fetch_array($goods_result);
                // echo $card['good_id'].' '.$card['good_name'].' '.$card['good_img'];
            
                $selected_genres_sql = "SELECT m_genre_id FROM manga_genre WHERE g_manga_id = '" . $card['good_id'] . "'";
                $selected_genres_result = mysqli_query($goods_link, $selected_genres_sql);

                $selected_genres = [];
                while ($row = mysqli_fetch_array($selected_genres_result)) {
                    $selected_genres[] = $row['m_genre_id'];
                }
                ?>
                <form class="red-form" action="/php/red.php?type=goods" method="post">
                    <h2>Изменить <?= $card['good_name'] ?></h2>
                    <label>Айди</label>
                    <input type="text" name="good_id" value="<?= $card['good_id'] ?>" readonly>
                    <label>Название</label>
                    <input type="text" name="good_name" value="<?= $card['good_name'] ?>" required>
                    <label>Жанры</label>
                    <div class="genres">
                        <?php
                        $genres_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                        $genres_sql = "SELECT * FROM `genres`";
                        $genres_result = mysqli_query($genres_link, $genres_sql);
                        while ($row = mysqli_fetch_array($genres_result)):
                            ?>
                            <div class="genres-element">
                                <input type="checkbox" name="genres[]" value="<?= $row['genre_id'] ?>" <?php if (in_array($row['genre_id'], $selected_genres))
                                    echo 'checked'; ?>><?= $row['genre_name'] ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <label>Ссылка на фото</label>
                    <input type="text" name="good_img" value="<?= $card['good_img'] ?>">
                    <label>Ссылка на фото форзаца</label>
                    <input type="text" name="good_back_img" value="<?= $card['good_back_img'] ?>">
                    <label>Описание товара</label>
                    <textarea name="good_description" rows="10" cols="50"><?= $card['good_description'] ?></textarea>
                    <input type="text" name="good_price" value="<?= $card['good_price'] ?>">
                    <select name="availability">
                        <?php
                        $availability_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                        // ЗАМЕНА ПАРОЛЯ
                        $availability_sql = "SELECT * FROM `availability`";
                        $availability_result = mysqli_query($availability_link, $availability_sql);
                        while ($row = mysqli_fetch_array($availability_result)):
                            ?>
                            <option value="<?= $row['availability_id'] ?>" <?php if ($card['good_availability'] == $row['availability_id']): ?> selected <?php endif; ?>>
                                <?= $row['availability_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button type="submit">Изменить</button>
                </form>
            </section>
        <?php elseif ($type == "genres"): ?>
            <section class="red">
                <?php
                $genres_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');           
                $genres_sql = "SELECT * FROM genres WHERE genre_id = '$id'";
                $genres_result = mysqli_query($genres_link, $genres_sql);
                $card = mysqli_fetch_array($genres_result);
                ?>
                <form class="red-form" action="/php/red.php?type=genres" method="post">
                    <h2>Изменить <?= $card['genre_name'] ?></h2>
                    <label>Айди</label>
                    <input type="text" name="genre_id" value="<?= $card['genre_id'] ?>" readonly>
                    <label>Название</label>
                    <input type="text" name="genre_name" value="<?= $card['genre_name'] ?>" required>
                    <button type="submit">Изменить</button>
                </form>
            </section>
        <?php elseif ($type == "users"): ?>
            <section class="red">
                <?php
                $users_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                $users_sql = "SELECT * FROM users WHERE user_id = '$id'";
                $users_result = mysqli_query($users_link, $users_sql);
                $card = mysqli_fetch_array($users_result);
                ?>
                <form class="red-form" action="/php/red.php?type=users" method="post">
                    <h2>Изменить <?= $card['user_name'] ?></h2>
                    <label>Айди</label>
                    <input type="text" name="user_id" value="<?= $card['user_id'] ?>" readonly>
                    <label>Логин</label>
                    <input type="text" name="user_login" value="<?= $card['user_login'] ?>" readonly>
                    <label>Телефон</label>
                    <input type="text" name="user_tel" value="<?= $card['user_tel'] ?>" readonly>
                    <label>Емайл</label>
                    <input type="text" name="user_email" value="<?= $card['user_email'] ?>" readonly>
                    <label>Дата</label>
                    <input type="text" name="user_date" value="<?= $card['user_date'] ?>" readonly>
                    <select name="user_role">
                        <?php
                        $role_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                        $role_sql = "SELECT * FROM `roles`";
                        $role_result = mysqli_query($role_link, $role_sql);
                        while ($row = mysqli_fetch_array($role_result)):
                            ?>
                            <option value="<?= $row['role_id'] ?>" <?php if ($card['user_role'] == $row['role_id']): ?> selected <?php endif; ?>><?= $row['role_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button type="submit">Изменить</button>
                </form>
            </section>
        <?php endif; ?>
    </main>
    <footer>
        <?php
        include "$root/php/modules/footer.php";
        ?>
    </footer>
    <script src="/script/script.js"></script>
</body>

</html>