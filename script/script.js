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

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.slider').forEach(slider => {
        const slides = slider.querySelectorAll('.slide');
        const dots = slider.querySelectorAll('.dot');
        const prevButton = slider.querySelector('.prev-slide');
        const nextButton = slider.querySelector('.next-slide');
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                showSlide(currentIndex);
            });
        });

        prevButton.addEventListener('click', prevSlide);
        nextButton.addEventListener('click', nextSlide);

        // Автоматическое перелистывание слайдов каждые 5 секунд
        // setInterval(nextSlide, 5000);

        // Инициализация первого слайда
        showSlide(currentIndex);
    });
});
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

