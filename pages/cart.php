<?php
session_start();
$order_result = $_GET['order'];
// если оно равдно ес
if ($order_result == 'yes') {
    //то очищается весь массив
    unset($_SESSION['cart']);
}
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Очищаем сообщение
    echo "<script>alert('$message');</script>";
}
$final_price = 0;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/cart.css">
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
        <section class="main">
            <?php 
            if (empty($_SESSION['cart'])): ?>
                <div class="empty-cart">
                    <h6 class="text-center">В корзине нет товаров</h6>
                    <div class="girl-with-cat-empty-cart"></div>
                </div>
            <?php else : ?>
            <h1 class="cart-title">Корзина заказов</h1>
            <form action="/php/order.php" method="post">
                            <table class="cart-table">
                <thead>
                    <tr>
                        <th colspan="2" width="60%">Товар</th>
                        <th>Цена</th>
                        <th width="10%">Количество</th>
                        <th>Стоимость</th>
                        <th>Отмена</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            foreach ($_SESSION['cart'] as $good_id => $goods) :
                                $good_price = $goods['price'] * $goods['count'];
                                $total =  $good_price;
                                $final_price += $total;
                                $id = $goods['id'];
                                ?>
                                <tr>
                                    <td>
                                        <?= $goods['name'] ?>
                                    </td>
                                    <td>
                                        <img src="<?= $goods['image'] ?>" alt="img" style='height: 150px;'>
                                    </td>
                                    <td>
                                        <?= $goods['price'] ?>
                                    </td>
                                    <td>
                                        <div class="count-input">
                                            <a href="/php/reduction_from_basket.php?id=<?= $id ?>">
                                                <i class="fa-solid fa-minus text-success"></i>
                                            </a> <?= $goods['count'] ?>
                                            <a href="../php/add_more_in_basket.php?id=<?= $id ?>">
                                                <i class="fa-solid fa-plus text-success"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $total ?>
                                    </td>
                                    <td>
                                        <a href="/php/cart.php?remove=<?= $good_id ?>" class="text-danger">Удалить</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                </tbody>
            </table>
            <div class="cart-actions">
                <div class="summary">
                    <p>Итого: <?=$final_price?> ₽</p>
                </div>
                <button type="submit" class="checkout-btn">Оформить заказ</button>
            </div>
            </form>
            <?php endif; ?>
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