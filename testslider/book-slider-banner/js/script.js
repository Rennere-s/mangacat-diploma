const slider = document.querySelector('.slider');
const books = document.querySelectorAll('.book');
const prevButton = document.querySelector('.slider-control.prev');
const nextButton = document.querySelector('.slider-control.next');
const bookTitle = document.getElementById('book-title');
const bookDescription = document.getElementById('book-description');

let currentIndex = 0;

function updateSlider() {
    slider.style.transform = `translateX(-${currentIndex * (books[0].offsetWidth + 20)}px)`;
    books.forEach((book, index) => {
        book.classList.toggle('active', index === currentIndex);
    });
    const activeBook = books[currentIndex];
    bookTitle.textContent = activeBook.dataset.title;
    bookDescription.textContent = activeBook.dataset.description;
}

prevButton.addEventListener('click', () => {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : books.length - 1;
    updateSlider();
});

nextButton.addEventListener('click', () => {
    currentIndex = (currentIndex < books.length - 1) ? currentIndex + 1 : 0;
    updateSlider();
});

updateSlider();