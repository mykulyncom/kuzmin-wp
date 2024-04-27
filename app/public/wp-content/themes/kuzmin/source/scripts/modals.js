function bindModal(triggerSelector, modalSelector, closeSelector) {
    const $trigger = document.querySelectorAll(triggerSelector);
    const $modal = document.querySelector(modalSelector);
    const $close = document.querySelector(closeSelector);

    $trigger.forEach((item) => {
        item.addEventListener('click', (e) => {
            // if (e.target) {
            //     e.preventDefault();
            // }
            $modal.style.display = 'block';
            document.body.classList.add('modal-open');
        });
    });

    if ($close) {
        $close.addEventListener('click', () => {
            $modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        });
    }

    if ($modal) {
        $modal.addEventListener('click', (e) => {
            if (e.target === $modal) {
                $modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        });
    }
}

bindModal('.send-cv', '.modal-cv', '.close-cv');
bindModal('.btn-send-rev', '.modal-review', '.close-review');

// bindModal('.button-buy', '.modal-buy', '.close-buy');

function buyModal(triggerSelector, closeSelector) {
    const $trigger = document.querySelectorAll(triggerSelector);
    const $close = document.querySelectorAll(closeSelector);

    $trigger.forEach((item) => {
        item.addEventListener('click', (e) => {
            // e.preventDefault(); // Забезпечуємо, щоб посилання не переходило за посиланням

            // Отримуємо id модального вікна з атрибуту href посилання
            const modalId = item.getAttribute('href').substring(1); // Відкидаємо символ '#'
            const $modal = document.getElementById(modalId);

            if ($modal) {
                $modal.style.display = 'block';
                document.body.classList.add('modal-open');
            }
        });
    });

    $close.forEach((item) => {
        item.addEventListener('click', () => {
            const modalId = item.parentElement.parentElement.parentElement.id;
            const $modal = document.getElementById(modalId);
            if ($modal) {
                $modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        });
    });

}
buyModal('.button-buy', '.close-buy');

const modalSend = document.querySelector('.modal-send');
const modalSendClose = document.querySelector('.close-send');
const modalCV = document.querySelector('.modal-cv');
const modalsBuy = document.querySelectorAll('.modal-buy');
const modalRev = document.querySelector('.modal-review');

const clRev = document.querySelector('.reviews-done');

if(clRev) {
    clRev.addEventListener('click', () => {
        modalRev.style.display = 'none';
        document.body.classList.remove('modal-open');
    });
}

document.addEventListener('wpcf7mailsent', (e) => {
    if ('mail_sent' === e.detail.status) {

        modalsBuy.forEach(modal => {
            modal.style.display = 'none';
        });
        if (modalCV) {
            modalCV.style.display = 'none';
        }
        if (modalRev) {
            modalRev.style.display = 'none';
        }
        modalSend.style.display = 'block';
        document.body.classList.add('modal-open');
        window.scrollTo(0, 0);
        modalSendClose.addEventListener('click', () => {
            modalSend.style.display = 'none';
            document.body.classList.remove('modal-open');
        });
    }
});
