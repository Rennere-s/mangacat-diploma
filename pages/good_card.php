<?php
session_start();
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); 
    echo "<script>alert('$message');</script>";
}
?>
<?php
$root_for_db = $_SERVER['DOCUMENT_ROOT']; 
require_once "$root_for_db/php/db.php";


$id = $_GET['id'];

$goods_sql = "SELECT good_id, good_name, GROUP_CONCAT(genres.genre_name SEPARATOR ', ') AS genres, good_img, good_description, good_price, good_availability FROM goods LEFT JOIN manga_genre ON g_manga_id = good_id LEFT JOIN genres ON genres.genre_id = manga_genre.m_genre_id WHERE good_id = '$id' GROUP BY good_id";
$goods_result = mysqli_query($sql, $goods_sql);
$card = mysqli_fetch_array($goods_result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($card['good_name']) ?></title>
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
    <main class="container">
        <section class="product-page">
            <div class="product-gallery">
                <div class="main-image-container">
                    <img id="main-product-image" src="/img/product_<?= htmlspecialchars($card['good_img']) ?>.jpg"
                        alt="<?= htmlspecialchars($card['good_name']) ?> - обложка">
                </div>
                <div class="thumbnail-container">
                    <img class="thumbnail active" src="/img/product_<?= htmlspecialchars($card['good_img']) ?>.jpg"
                        data-large="/img/product_<?= htmlspecialchars($card['good_img']) ?>.jpg" alt="Миниатюра 1">
                    <img class="thumbnail" src="/img/product_back<?= htmlspecialchars($card['good_img']) ?>.jpg"
                        data-large="/img/product_back<?= htmlspecialchars($card['good_img']) ?>.jpg" alt="Миниатюра 2">
                    <img class="thumbnail" src="/img/product_pages<?= htmlspecialchars($card['good_img']) ?>.jpg"
                        data-large="/img/product_pages<?= htmlspecialchars($card['good_img']) ?>.jpg" alt="Миниатюра 3">
                </div>
            </div>

            <div class="product-info">
                <h1><?= htmlspecialchars($card['good_name']) ?></h1>
                <p class="price"><?= $card['good_price'] ?> ₽</p>

                <div class="description">
                    <h3>Описание:</h3>
                    <p><?= nl2br(htmlspecialchars($card['good_description'])) ?></p>
                </div>

                <div class="genres">
                    <h3>Жанры:</h3>
                    <p><?= htmlspecialchars($card['genres']) ?></p>
                </div>
                <form action="/php/cart.php" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">Добавить в корзину</button>
                </form>

            </div>
        </section>
        <section class="reviews-section">
            <h2>Отзывы покупателей</h2>
            <div class="review-list">
                <?php
                $review_sql = "SELECT `user_login`, `review_text`, `review_rating`, `review_date` FROM `reviews` JOIN `users` on `review_user` = `user_id` WHERE `review_manga` = '$id' AND `review_status` = '3'";
                $review_result = mysqli_query($sql, $review_sql);
                if ($review_result && mysqli_num_rows($review_result) > 0) {
                    while ($row = mysqli_fetch_array($review_result)):
                    ?>
                        <div class="review-item">
                            <div class="review-header">
                                <span class="review-author"><?= htmlspecialchars($row['user_login']) ?></span>
                                <div class="review-rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="fa-star <?= ($i <= $row['review_rating']) ? 'fas' : 'far' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="review-text"><?= nl2br(htmlspecialchars($row['review_text'])) ?></p>
                            <span class="review-date"><?= date('d.m.Y', strtotime($row['review_date'])) ?></span>
                        </div>
                    <?php endwhile;
                } else {
                    echo "<p>Отзывов пока нет. Станьте первым!</p>";
                }
                ?>
            </div>
            
            <div class="review-form">
                <h3>Оставить отзыв</h3>
                <form action="/php/rev.php" method="post">
                    <?php
                    if (empty($_COOKIE['user_id'])):
                        ?>
                        <textarea id="review_text" name="review_text" rows="5" required
                            placeholder="Войдите в аккаунт, чтобы оставить отзыв" readonly></textarea>
                         <a href="/pages/auth.php" class="button-like-link">Войти в аккаунт</a>
                    <?php else: ?>
                        <div class="form-group">
                            <label>Ваша оценка</label>
                            <div class="star-rating">
                                <input type="radio" id="5-stars" name="review_rating" value="5" required/><label for="5-stars" class="star">★</label>
                                <input type="radio" id="4-stars" name="review_rating" value="4" /><label for="4-stars" class="star">★</label>
                                <input type="radio" id="3-stars" name="review_rating" value="3" /><label for="3-stars" class="star">★</label>
                                <input type="radio" id="2-stars" name="review_rating" value="2" /><label for="2-stars" class="star">★</label>
                                <input type="radio" id="1-star" name="review_rating" value="1" /><label for="1-star" class="star">★</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review_text">Текст отзыва</label>
                            <textarea id="review_text" name="review_text" rows="5" required
                                placeholder="Поделитесь вашими впечатлениями о товаре..."></textarea>
                        </div>
                        <input type="hidden" name="review_manga" value="<?= $id ?>">
                        <button type="submit" class="submit-review-btn">Отправить отзыв</button>
                    <?php
                    endif;
                    ?>
                </form>
            </div>
        </section>
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