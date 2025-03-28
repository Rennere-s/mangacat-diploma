<div class="footer">
<div class="contact">
            <p class="red-header">Свяжитесь с нами!</p>
            <p>Email: rhapsody.company@gmail.com</p>
            <p>Телефон: +7(999)-999-99-99</p>
            <p>Адрес: ул. Староавиатинская 15 к.6</p>
        </div>
        <nav class="footer-menu">
            <div class="footer-menu-left">
                <p class="red-header">Меню</p>
                <ul>
                    <li><a href="#">Главная</a></li>
                    <li><a href="#">Каталог</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">О нас</a></li>
                </ul>
            </div>
            <div class="footer-menu-catalog">
                <p class="red-header">Каталог</p>

                <ul>
                    <?php 
                    
                    $genres_link = mysqli_connect('localhost','root','root','mangaCat');
                    $genres_sql = "SELECT * FROM `genres`";
                    $genres_result = mysqli_query($genres_link,$genres_sql);
                    while($row = mysqli_fetch_array($genres_result)):
                    ?>
                    <div>
                    <a href="/catalog/?genre=<?=$row['genre_id']?>"><li><?=$row['genre_name']?></li></a>
                    </div>
                    <?php endwhile; ?>
                </ul>
            </div>
        </nav>
        <div class="subscription">
            <p  class="red-header">Что бы узнавать об обновлениях самым первым</p>
            <input type="email" placeholder="Email">
            <button>Подпишись!</button>
            <p>&copy; ООО "Новый книжный центр" | все права защищены</p>
        </div>
        
</div>