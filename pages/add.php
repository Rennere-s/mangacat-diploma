<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/add.css">
</head>

<body class="">
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
                <form class="red-form" action="/php/add.php?type=goods" method="post">
                    <h2>Добавить мангу</h2>
                    <label>Название</label>
                    <input type="text" name="good_name" required>
                    <label>Жанры</label>
                    <div class="genres">
                        <?php
                        $genres_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                        $genres_sql = "SELECT * FROM `genres`";
                        $genres_result = mysqli_query($genres_link, $genres_sql);
                        while ($row = mysqli_fetch_array($genres_result)):
                            ?>
                            <div class="genres-element">
                                <input type="checkbox" name="genres[]" value="<?= $row['genre_id'] ?>"><?= $row['genre_name'] ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <label>Ссылка на фото</label>
                    <input type="text" name="good_img">
                    <label>Ссылка на фото форзаца</label>
                    <input type="text" name="good_back_img" value="<?= $card['good_back_img'] ?>">
                    <label>Описание товара</label>
                    <textarea name="good_description" rows="10" cols="50"></textarea>
                    <input type="text" name="good_price">
                    <select name="availability">
                        <?php
                        $availability_link = mysqli_connect('localhost', 'root', 'root', 'mangaCat');
                        $availability_sql = "SELECT * FROM `availability`";
                        $availability_result = mysqli_query($availability_link, $availability_sql);
                        while ($row = mysqli_fetch_array($availability_result)):
                            ?>
                            <option value="<?= $row['availability_id'] ?>"><?= $row['availability_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button type="submit">Добавить</button>
                </form>
            </section>
        <?php elseif ($type == "genres"): ?>
            <section class="red">
                <form class="red-form" action="/php/add.php?type=genres" method="post">
                    <h2>Добвать жанр</h2>
                    <label>Название</label>
                    <input type="text" name="genre_name" required>
                    <button type="submit">Добавть жанр</button>
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