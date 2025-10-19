<div class="header">
    <div class="left">
        <div class="logo">
            <img src="/img/mangaCat-logo 2.png" alt="Mangacat Logo">
            <span>MangaCat</span>
        </div>
        <nav class="nav">
            <a href="/">Главная</a>
            <a href="/pages/catalog.php">Каталог</a>
            <a href="/pages/about.php">О нас</a>
            <a href="/pages/contact.php">Контакты</a>
        </nav>
    </div>
    <div class="right">
        <div onclick="toggleMenu()" class="burger-menu">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="icons">
            <i class="fas fa-user dropdown_toggle"></i>
            <div id="dropdown_profile" class="dropdown_content">
                <ul>
                    <?php if ($_COOKIE['user_id'] == ''): ?>
                        <li><a href="/pages/reg.php">Регистрация</a></li>
                        <li><a href="/pages/auth.php">Вход</a></li>
                    <?php else: ?>
                        <li><a href="/pages/profile.php">Аккаунт</a></li>
                        <li><a href="#" onclick="openModal()">Выход</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <a href="/pages/cart.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </div>
</div>
<nav id="nav" class="burger-nav">
    <a href="/">Главная</a>
    <a href="/pages/catalog.php">Каталог</a>
    <a href="/pages/about.php">О нас</a>
    <a href="/pages/contact.php">Контакты</a>
</nav>



<?php
include "$root/php/modules/modal_exit.php";
?>