document.addEventListener("DOMContentLoaded", () => {
    const dropdownToggle = document.querySelector('.dropdown_toggle');
    const dropdownContent = document.querySelector('#dropdown_profile');

    dropdownToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownContent.classList.toggle('show');
    });

    document.addEventListener('click', (e) => {
        if (!dropdownToggle.contains(e.target) && !dropdownContent.contains(e.target)) {
            dropdownContent.classList.remove('show');
        }
    });
});

   function truncateText(selector, maxLength) {
       const element = document.querySelectorAll(selector);
       element.forEach(element => {
        if (element) {
            const text = element.innerText;
 
            if (text.length > maxLength) {
                element.innerText = text.slice(0, maxLength) + '...';
            }
        } else {
            console.error(`Element with selector "${selector}" not found.`);
        }
       });
   }

document.addEventListener('DOMContentLoaded', function() {
    truncateText('.truncate', 90); 
});

function handleModalClick(event){
    if (event.target === document.getElementById('modal')){
        closeModal();
    }
}

function openModal() {
    document.getElementById('modal').style.display = 'flex';
}

// Close the modal
function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

function initSlider(sliderContainer) {
    const slider = sliderContainer.querySelector('.slider');
    const books = sliderContainer.querySelectorAll('.book');
    const prevButton = sliderContainer.querySelector('.slider-control.prev');
    const nextButton = sliderContainer.querySelector('.slider-control.next');
    const bookTitle = sliderContainer.querySelector('.book-title');
    const bookDescription = sliderContainer.querySelector('.book-description-text');
    const learnMoreButton = sliderContainer.querySelector('.learn-more');

    let currentIndex = 0;

    function updateSlider() {
        // Сдвигаем слайдер
        slider.style.transform = `translateX(-${currentIndex * (books[0].offsetWidth + 20)}px)`;

        // Обновляем активный класс у книг
        books.forEach((book, index) => {
            book.classList.toggle('active', index === currentIndex);
        });

        // Обновляем текстовое описание, только если элементы существуют
        const activeBook = books[currentIndex];
        if (bookTitle && activeBook.dataset.title) {
            bookTitle.textContent = activeBook.dataset.title;
        }
        if (bookDescription && activeBook.dataset.description) {
            bookDescription.textContent = activeBook.dataset.description;
        }
        if (learnMoreButton && activeBook.dataset.link) {
            learnMoreButton.setAttribute('href', activeBook.dataset.link);
        }
        // console.log("Active Book:", activeBook);
        // console.log("bookTitle:", bookTitle);
        // console.log("bookDescription:", bookDescription);
    }

    // Обработчики кнопок
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : books.length - 1;
        updateSlider();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex < books.length - 1) ? currentIndex + 1 : 0;
        updateSlider();
    });

    // Обработка клика по книге
    books.forEach((book, index) => {
        book.addEventListener('click', () => {
            currentIndex = index;
            updateSlider();
        });
    });

    // Инициализация
    updateSlider();

    // Обновление при изменении размера окна
    window.addEventListener('resize', () => {
        updateSlider();
    });
}

// Инициализируем все слайдеры
document.querySelectorAll('.book-slider').forEach(initSlider);

// Функция toggleMenu остаётся без изменений
function toggleMenu() {
    const nav = document.getElementById('nav');
    nav.classList.toggle('active');
}

// document.querySelector('.registration-form').addEventListener('submit', function(event) {
//     event.preventDefault();
//     alert('Форма отправлена!');
// });

// document.querySelector('.subscription button').addEventListener('click', function() {
//     const emailInput = document.querySelector('.subscription input');
//     if (emailInput.value) {
//         alert(`Вы подписались с email: ${emailInput.value}`);
//         emailInput.value = '';
//     } else {
//         alert('Пожалуйста, введите email.');
//     }
// });

