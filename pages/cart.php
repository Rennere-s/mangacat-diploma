<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/db.php';



if (isset($_GET['order']) && $_GET['order'] == 'yes') {
    unset($_SESSION['cart']);
    unset($_SESSION['promo']); 
    $_SESSION['success_message'] = "Ваш заказ успешно оформлен! Спасибо за покупку.";
    header('Location: /pages/cart.php');
    exit();
}

$subtotal_price = 0;
$final_price = 0;
$discount_amount = 0;
$discount_percent = 0;
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
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="message success"><?= htmlspecialchars($_SESSION['success_message']);
                    unset($_SESSION['success_message']); ?></div>
                <?php endif; ?>

                <div class="empty-cart">
                    <h6 class="text-center">В корзине нет товаров</h6>
                    <div class="girl-with-cat-empty-cart"></div>
                    <a href="/pages/catalog.php" class="button-like-link">Перейти в каталог</a>
                </div>
            <?php else: ?>
                <h1 class="cart-title">Корзина заказов</h1>

                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="message success"><?= htmlspecialchars($_SESSION['success_message']);
                    unset($_SESSION['success_message']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="message error"><?= htmlspecialchars($_SESSION['error_message']);
                    unset($_SESSION['error_message']); ?></div>
                <?php endif; ?>

                <div class="table-wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Цена</th>
                                <th width="10%">Количество</th>
                                <th>Стоимость</th>
                                <th>Отмена</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($_SESSION['cart'] as $good_id => $goods):
                                $total_item_price = $goods['price'] * $goods['count'];
                                $subtotal_price += $total_item_price;
                                $id = $goods['id'];
                                ?>
                                <tr>
                                    <td class="product-col">
                                        <img src="/img/product_<?= htmlspecialchars($goods['image']) ?>.jpg" alt="img"
                                            style='height: 150px;'>
                                        <span><?= htmlspecialchars($goods['name']) ?></span>
                                    </td>
                                    <td>
                                        <?= $goods['price'] ?> ₽
                                    </td>
                                    <td>
                                        <div class="count-input">
                                            <a href="/php/reduction_from_basket.php?id=<?= $id ?>" title="Уменьшить">
                                                <i class="fa-solid fa-minus text-success"></i>
                                            </a>
                                            <span><?= $goods['count'] ?></span>
                                            <a href="/php/add_more_in_basket.php?id=<?= $id ?>" title="Увеличить">
                                                <i class="fa-solid fa-plus text-success"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <strong><?= $total_item_price ?> ₽</strong>
                                    </td>
                                    <td>
                                        <a href="/php/cart.php?remove=<?= $good_id ?>" class="text-danger" title="Удалить товар">Удалить</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <div class="cart-bottom-panel">
                    <div class="promo-block">
                        <h4>Промокод</h4>
                        <?php if (isset($_SESSION['promo'])):
                            $discount_percent = $_SESSION['promo']['percent'];
                            $discount_amount = ($subtotal_price * $discount_percent) / 100;
                            $final_price = $subtotal_price - $discount_amount;
                            ?>
                            <div class="promo-applied">
                                Промокод <strong>"<?= htmlspecialchars($_SESSION['promo']['name']) ?>"</strong> применен!
                                (Скидка <?= $_SESSION['promo']['percent'] ?>%)
                                <a href="/php/apply_promo.php?remove=1" class="remove-promo-btn">Удалить</a>
                            </div>
                        <?php else:
                            $final_price = $subtotal_price;
                            ?>
                            <form action="/php/apply_promo.php" method="post" class="promo-form">
                                <input type="text" name="promo_code" placeholder="Введите промокод">
                                <button type="submit">Применить</button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <form action="/php/order.php" method="post" class="summary-block">
                        <div class="summary-line">
                            <p>Промежуточный итог:</p>
                            <p><?= $subtotal_price ?> ₽</p>
                        </div>

                        <?php if ($discount_amount > 0): ?>
                            <div class="summary-line discount">
                                <p>Скидка по промокоду (<?= $discount_percent ?>%):</p>
                                <p>- <?= round($discount_amount, 2) ?> ₽</p>
                            </div>
                        <?php endif; ?>

                        <hr>
                        <div class="summary-line total">
                            <p>Итого к оплате:</p>
                            <p><strong><?= round($final_price, 2) ?> ₽</strong></p>
                        </div>

                        <div class="checkout-block">
                            <?php if (isset($_COOKIE['user_id'])):
                                $user_id = (int) $_COOKIE['user_id'];
                                $addresses_result = mysqli_query($sql, "SELECT * FROM `adresess` WHERE `adreses_user` = '$user_id'");
                                ?>
                                <?php if ($addresses_result && mysqli_num_rows($addresses_result) > 0): ?>
                                    <div class="address-selector">
                                        <label for="address_id">Выберите адрес доставки:</label>
                                        <select name="address_id" id="address_id" required>
                                            <?php while ($address = mysqli_fetch_assoc($addresses_result)): ?>
                                                <option value="<?= $address['adreses_id'] ?>">
                                                    <?= htmlspecialchars($address['adreses_name']) ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="checkout-btn">Оформить заказ</button>
                                <?php else: ?>
                                    <div class="message warning">
                                        У вас нет сохраненных адресов. <a href="/pages/profile.php?type=adress">Добавьте адрес</a>,
                                        чтобы оформить заказ.
                                    </div>
                                    <button type="button" class="checkout-btn" disabled>Оформить заказ</button>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="message warning">
                                    Пожалуйста, <a href="/pages/auth.php">войдите в аккаунт</a>, чтобы выбрать адрес и оформить
                                    заказ.
                                </div>
                                <button type="button" class="checkout-btn" disabled>Оформить заказ</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
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