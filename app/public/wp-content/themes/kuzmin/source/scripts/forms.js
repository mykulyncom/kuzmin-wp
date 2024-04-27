import iMask from 'imask';
const phones = document.querySelectorAll('input[type="tel"]');

const maskOptions = {
    mask: '+{38}(000)-000-00-00',
}
const masksOptions = {
    phone: {
        mask: '+{38}(000)-000-00-00',
    }
};
for(const item of phones) {
    new iMask(item, masksOptions.phone);
}

// phones.forEach(phone => {
//     const mask = new iMask(phone, maskOptions);
// });

const clearIcon = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.3335 1.94123L10.2256 0.833374L5.8335 5.22552L1.44135 0.833374L0.333496 1.94123L4.72564 6.33337L0.333496 10.7255L1.44135 11.8334L5.8335 7.44123L10.2256 11.8334L11.3335 10.7255L6.94135 6.33337L11.3335 1.94123Z" fill="#45372E"/></svg>'

const inputsWrap = document.querySelectorAll('.wpcf7-form-control-wrap');
const clearHtml = `<button class="clear-input-button">${clearIcon}</button>`;

inputsWrap.forEach(wrap => {
   // wrap.innerHTML += clearHtml;
   const input = wrap.querySelector('input');
   const clearBtn = wrap.querySelector('.clear-input-button');
    const handleInputChange = (e) => {
        if (e.target.value && !input.classList.contains("clear-input--touched")) {
            input.classList.add("clear-input--touched")
        } else if (!e.target.value && input.classList.contains("clear-input--touched")) {
            input.classList.remove("clear-input--touched")
        }
    }

    const handleButtonClick = (e) => {
        input.value = ''
        input.focus()
        input.classList.remove("clear-input--touched")
    }

    // input.addEventListener("input", handleInputChange)
    // clearBtn.addEventListener("click", handleButtonClick)
});

$('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
});

$(document).ready(function() {
    // Знаходимо перший блок з класом vacancy-sel всередині форми з класом wpcf7-form
    var firstVacancySel = $('.wpcf7-form .vacancy-sel:first');

    // Знаходимо всі чекбокси всередині цього блоку та встановлюємо їх у стан вибраного
    firstVacancySel.find('input[type="checkbox"]').prop('checked', true);
});

