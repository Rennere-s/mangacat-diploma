<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaCat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/contact.css">
    <link rel="shortcut icon" href="/img/mangaCat-logo 2.png" />
</head>

<body>
    <header>
        <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/php/modules/header.php";
        $sql = new mysqli('localhost', 'root', 'root', 'mangacat');
        ?>
    </header>
   <main>
          <h1 class="main-title-contact">Контакты</h1>
  <section class="contacts">
    <div class="contact-info">
      <div class="contact-card">
        <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.5 4.5 10 10 10s10-4.5 10-10V5l-9-4zm0 2.3l7.9 3.2v4c0 4.9-4 9-9 9s-9-4.1-9-9v-4l7.9-3.2zM12 17c-3.3 0-6-2.7-6-6v-2h12v2c0 3.3-2.7 6-6 6z"/></svg>
        <h3>Email</h3>
        <p>support@example.com</p>
      </div>
      <div class="contact-card">
        <svg viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8z"/><path d="M12 14c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2s2 .9 2 2v4c0 1.1-.9 2-2 2z"/></svg>
        <h3>Рабочее время</h3>
        <p>Пн-Пт: 9:00 - 18:00</p>
      </div>
      <div class="contact-card">
        <svg viewBox="0 0 24 24"><path d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5-1.1 2.5-2.5 2.5z"/></svg>
        <h3>Адрес</h3>
        <p>ул. Пушкина, д. 10, г. Москва</p>
      </div>
    </div>
  </section>

  <section class="contact-form">
    <h2>Отправьте нам сообщение</h2>
    <form id="contactForm">
      <input type="text" placeholder="Ваше имя" required/>
      <input type="email" placeholder="Email" required/>
      <textarea rows="5" placeholder="Сообщение..." required></textarea>
      <button type="submit">Отправить</button>
    </form>
  </section>

  <section class="faq">
    <h2>Часто задаваемые вопросы</h2>
    <div class="accordion">
      <div class="accordion-item">
        <button class="accordion-header">
          Почему так дорого?
          <span class="icon">+</span>
        </button>
        <div class="accordion-body">
          Мы продаем мангу не отдельными выпусками а целыми томами.
        </div>
      </div>
      <div class="accordion-item">
        <button class="accordion-header">
          Как долго идёт доставка?
          <span class="icon">+</span>
        </button>
        <div class="accordion-body">
        По Москве и МО: 1–3 дня
        В другие регионы РФ: 3–14 дней
        Для международных отправлений — от 7 до 21 дня
        </div>
      </div>
      <div class="accordion-item">
        <button class="accordion-header">
           Какие способы оплаты вы принимаете?
          <span class="icon">+</span>
        </button>
        <div class="accordion-body">
          На данный момент мы принимаем оплату только на месте при доставке - картой или наличными
        </div>
      </div>
      <div class="accordion-item">
        <button class="accordion-header">
           Чем отличается том от полной версии манги?
          <span class="icon">+</span>
        </button>
        <div class="accordion-body">
        Том — это отдельный выпуск манги, обычно включающий несколько глав. Полные издания содержат сразу несколько томов в одной книге. У нас представлены именно отдельные тома, как в оригинальных изданиях.
        </div>
      </div>
      <div class="accordion-item">
        <button class="accordion-header">
           На каком языке изданы маги тома?
          <span class="icon">+</span>
        </button>
        <div class="accordion-body">
        Все наши тома изданы на русском языке. Мы работаем только с официальными русскоязычными изданиями.
        </div>
      </div>
      <div class="accordion-item">
        <button class="accordion-header">
           Есть ли в наличии все серии/тома?
          <span class="icon">+</span>
        </button>
        <div class="accordion-body">
        Актуальное наличие указано в карточке каждого товара. Если интересующего вас тома нет в наличии — вы можете связаться с нами, чтобы узнать о сроках поставки.
        </div>
      </div>
      <div class="accordion-item">
        <button class="accordion-header">
          В течение какого времени можно вернуть покупку?
          <span class="icon">+</span>
        </button>
        <div class="accordion-body">
        Возврат возможен в течение 14 дней с момента получения заказа. Для бракованных товаров срок увеличивается до 30 дней.
        </div>
      </div>
    </div>
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