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
                        <li><a href="/pages/reg.php">Регестрация</a></li>
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
</nav>



<?php
include "$root/php/modules/modal_exit.php";
?>

<!-- <div class="header">
        <div class="header-up">
            <div class="header-up header-up--search">
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg></a>
            </div>
            <div class="header-up header-up--logo">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 152.000000 152.000000" preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,152.000000) scale(0.100000,-0.100000)"
                        stroke="none">
                        <path d="M237 1293 c-4 -3 -4 -50 0 -104 l6 -97 -42 -86 c-23 -47 -48 -104
-56 -127 -18 -50 -19 -159 -3 -231 l12 -53 7 81 c13 139 27 196 76 294 40 79
48 107 53 169 l5 73 56 -58 c30 -33 64 -74 74 -91 33 -57 71 -33 41 25 -22 43
-121 148 -172 183 -46 32 -48 32 -57 22z" />
                        <path d="M1224 1266 c-55 -37 -141 -132 -169 -185 -14 -28 -14 -35 -3 -42 21
-13 24 -12 53 33 29 44 113 138 124 138 3 0 6 -30 6 -68 0 -59 5 -77 42 -148
51 -101 70 -162 78 -256 3 -40 9 -84 12 -98 l6 -25 8 29 c4 16 11 59 15 95 7
75 -11 143 -72 263 -40 80 -50 140 -36 218 15 80 1 90 -64 46z" />
                        <path d="M623 1031 c-77 -21 -94 -29 -159 -69 l-41 -25 28 -25 c35 -29 36 -39
7 -47 -22 -7 -148 -84 -148 -91 0 -1 18 -13 40 -25 22 -13 40 -25 40 -28 0 -3
-30 -21 -66 -40 -36 -19 -86 -53 -112 -76 l-46 -42 90 -11 c50 -7 120 -21 155
-33 87 -29 210 -93 244 -129 l29 -30 -228 0 c-179 0 -226 3 -220 13 4 6 27 35
51 64 42 49 43 52 22 58 -26 8 -86 -46 -126 -113 -43 -73 -47 -72 245 -72 233
0 261 -2 295 -19 36 -18 38 -18 74 0 34 17 62 19 295 19 213 0 260 2 264 14 7
19 -27 81 -74 135 -33 38 -42 43 -66 37 l-27 -7 51 -58 c27 -31 50 -61 50 -64
0 -4 -102 -7 -227 -7 l-228 1 38 34 c48 42 174 108 247 128 30 9 95 21 143 28
l88 12 -33 35 c-18 19 -68 55 -111 80 l-79 46 42 25 43 25 -29 23 c-16 13 -54
35 -84 50 -30 16 -57 29 -60 31 -3 2 10 16 29 31 l34 28 -48 28 c-133 78 -295
103 -432 66z m97 -219 l-1 -177 -40 77 c-23 42 -67 109 -100 147 -32 39 -59
73 -59 76 0 18 172 70 193 58 4 -2 7 -84 7 -181z m168 172 c15 -3 48 -15 74
-26 l47 -20 -62 -74 c-34 -40 -81 -108 -104 -151 l-43 -78 0 91 c0 50 3 132 6
182 8 102 -1 94 82 76z m-254 -294 c25 -47 52 -103 61 -124 16 -37 11 -34 -72
50 -52 52 -114 104 -150 124 -34 19 -63 38 -63 41 0 3 26 18 58 32 l57 26 32
-32 c17 -18 52 -70 77 -117z m449 110 c15 -7 27 -16 27 -20 0 -3 -19 -17 -42
-30 -68 -37 -149 -104 -200 -166 -27 -31 -48 -49 -48 -40 0 25 101 214 138
257 37 43 30 43 125 -1z m-514 -204 c62 -60 151 -172 151 -190 0 -3 -24 12
-52 34 -101 76 -275 150 -355 150 -43 0 -23 21 58 60 97 47 92 48 198 -54z
m600 44 c62 -31 77 -50 40 -50 -78 0 -246 -70 -348 -145 -35 -26 -60 -41 -55
-33 53 90 166 216 233 261 26 18 35 15 130 -33z" />
                        <path d="M330 918 c-6 -44 -10 -82 -8 -84 2 -2 16 32 30 75 24 74 24 80 8 84
-16 4 -20 -6 -30 -75z" />
                        <path d="M1161 991 c-11 -7 -8 -21 13 -72 l27 -64 -7 65 c-7 71 -12 83 -33 71z" />
                    </g>
                </svg>
                <div class="header-up-logo header-up-logo--text">MANGACAT</div>
                </a>
            </div>
            <div class="header-up header-up--profile">
                <div class="header-up--profile header-up--profile--user">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                    </svg>
                    </a>
                </div>
                <div class="header-up--profile header-up--profile--cart">
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 576 512">
                        <path
                            d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                    </svg></a>
                </div>
            </div>
        </div>
        <div class="header-line"></div>
        <div class="header-down">
            <div class="header-down header-down--nav">
                <ul>
                    <li><a href="#" class="nav-link">Главная</a></li>
                    <li><a href="#" class="nav-link">Каталог</a></li>
                    <li><a href="#" class="nav-link">О Нас</a></li>
                </ul>
            </div>
        </div>
    </div> -->