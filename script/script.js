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
    const bookElements = Array.from(sliderContainer.querySelectorAll('.book'));
    const prevButton = sliderContainer.querySelector('.slider-control.prev');
    const nextButton = sliderContainer.querySelector('.slider-control.next');
    const bookTitle = sliderContainer.querySelector('.book-title');
    const bookDescription = sliderContainer.querySelector('.book-description-text');
    const learnMoreButton = sliderContainer.querySelector('.learn-more');

    const visibleCount = 4;
    const gap = 20; // px gap between slides
    const slideWidth = bookElements[0].offsetWidth;
    const cloneCount = visibleCount;
    const totalOriginal = bookElements.length;

    // Clone slides for infinite effect
    const prefixClones = bookElements.slice(-cloneCount).map(el => {
        const clone = el.cloneNode(true);
        clone.classList.add('clone');
        return clone;
    });
    const suffixClones = bookElements.slice(0, cloneCount).map(el => {
        const clone = el.cloneNode(true);
        clone.classList.add('clone');
        return clone;
    });
    // Append clones
    prefixClones.forEach(clone => slider.appendChild(clone));
    bookElements.forEach(el => slider.appendChild(el));
    suffixClones.forEach(clone => slider.appendChild(clone));

    const allSlides = Array.from(slider.children);
    let currentIndex = cloneCount; // start at first original
    
    function updatePosition(animate = true) {
        if (animate) {
            slider.style.transition = 'transform 0.4s ease';
        } else {
            slider.style.transition = 'none';
        }
        const offset = -currentIndex * (slideWidth + gap);
        slider.style.transform = `translateX(${offset}px)`;

        // Update descriptions based on real index
        const realIndex = ((currentIndex - cloneCount) % totalOriginal + totalOriginal) % totalOriginal;
        const activeBook = bookElements[realIndex];
        bookElements.forEach((book, idx) => {
            book.classList.toggle('active', idx === realIndex);
        });
        if (bookTitle && activeBook.dataset.title) bookTitle.textContent = activeBook.dataset.title;
        if (bookDescription && activeBook.dataset.description) bookDescription.textContent = activeBook.dataset.description;
        if (learnMoreButton && activeBook.dataset.link) learnMoreButton.setAttribute('href', activeBook.dataset.link);
    }

    slider.addEventListener('transitionend', () => {
        // Loop boundary check
        if (currentIndex >= totalOriginal + cloneCount) {
            currentIndex = cloneCount;
            updatePosition(false);
        } else if (currentIndex < cloneCount) {
            currentIndex = totalOriginal + cloneCount - 1;
            updatePosition(false);
        }
    });

    prevButton.addEventListener('click', () => {
        currentIndex--;
        updatePosition();
    });
    nextButton.addEventListener('click', () => {
        currentIndex++;
        updatePosition();
    });
    
    // Click slide to jump
    allSlides.forEach((slide, idx) => {
        slide.addEventListener('click', () => {
            // Only respond to original slides
            let newIndex;
            if (idx < cloneCount) {
                newIndex = idx + totalOriginal;
            } else if (idx >= cloneCount + totalOriginal) {
                newIndex = idx - totalOriginal;
            } else {
                newIndex = idx;
            }
            currentIndex = newIndex;
            updatePosition();
        });
    });

    // Initial setup: set container width and position
    slider.style.width = `${allSlides.length * (slideWidth + gap)}px`;
    updatePosition(false);

    // Recompute on resize
    window.addEventListener('resize', () => {
        // If slide width changes, you may need to recalculate slideWidth and width
        updatePosition(false);
    });
}

document.querySelectorAll('.book-slider').forEach(initSlider);


// Функция toggleMenu остаётся без изменений
function toggleMenu() {
    const nav = document.getElementById('nav');
    nav.classList.toggle('active');
}

  // Accordion logic
  document.querySelectorAll('.accordion-header').forEach(header => {
    header.addEventListener('click', () => {
      const body = header.nextElementSibling;
      const isOpen = body.classList.contains('open');
      
      // Close all open accordion bodies
      document.querySelectorAll('.accordion-body').forEach(b => b.classList.remove('open'));

      if (!isOpen) {
        body.classList.add('open');
      }
    });
  });

//   // Form submission handler
//   document.getElementById('contactForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     alert('Спасибо! Ваше сообщение отправлено.');
//     this.reset();
//   });


function maskPhone(selector, masked = '+7 (___) ___-__-__') {
	const elems = document.querySelectorAll(selector);

	function mask(event) {
		const keyCode = event.keyCode;
		const template = masked,
			def = template.replace(/\D/g, ""),
			val = this.value.replace(/\D/g, "");
		console.log(template);
		let i = 0,
			newValue = template.replace(/[_\d]/g, function (a) {
				return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
			});
		i = newValue.indexOf("_");
		if (i !== -1) {
			newValue = newValue.slice(0, i);
		}
		let reg = template.substr(0, this.value.length).replace(/_+/g,
			function (a) {
				return "\\d{1," + a.length + "}";
			}).replace(/[+()]/g, "\\$&");
		reg = new RegExp("^" + reg + "$");
		if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) {
			this.value = newValue;
		}
		if (event.type === "blur" && this.value.length < 5) {
			this.value = "";
		}

	}

	for (const elem of elems) {
		elem.addEventListener("input", mask);
		elem.addEventListener("focus", mask);
		elem.addEventListener("blur", mask);
	}
	
}

// use

maskPhone('.imput-tel');

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

