<div class="footer">
    <div class="contact">
        <p class="red-header">Свяжитесь с нами!</p>
        <p>Email: support@mangacat.com</p>
        <p>Телефон: +7(999)-999-99-99</p>
        <p>Адрес: г. Москва, ул. Авиамоторная улица, д. 12к2</p>
    </div>
    <nav class="footer-menu">
        <div class="footer-menu-left">
            <p class="red-header">Меню</p>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/pages/catalog.php">Каталог</a></li>
                <li><a href="/pages/contact.php">Контакты</a></li>
                <li><a href="/pages/cart.php">Корзина</a></li>
                <li><a href="/pages/about.php">О нас</a></li>
            </ul>
        </div>
        <div class="footer-menu-catalog">
            <p class="red-header">Каталог</p>

            <ul>
                <?php
                $genres_sql = $sql->query("SELECT * FROM `genres`");
                while ($row = mysqli_fetch_array($genres_sql)):
                    ?>
                    <div>
                        <a href="/pages/catalog.php?id=<?= $row['genre_id'] ?>">
                            <li><?= $row['genre_name'] ?></li>
                        </a>
                    </div>
                <?php endwhile; ?>
            </ul>
        </div>
    </nav>
</div>