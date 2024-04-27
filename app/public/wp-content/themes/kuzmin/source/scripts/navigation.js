window.onload = function () {
    const openMenuBtn = document.querySelector('.navigation-btn');
    const navContainer = document.querySelector('.navigation');
    const mobOpenSub = document.querySelectorAll('.nav-open-sub');
    const overlay = document.querySelector('.nav-overlay');

    // Функція для додавання або видалення класу 'active' для елементів
    function toggleActive(element, className) {
        if (element) {
            element.classList.toggle(className);
        }
    }

    function removeActive(element, className) {
        if (element) {
            element.classList.remove(className);
        }
    }

    function addActive(element, className) {
        if (element) {
            element.classList.add(className);
        }
    }

    function removeClass(element, className) {
        if (element) {
            const allEl = document.querySelectorAll(element);
            allEl.forEach(el => {
                el.classList.remove(className);
            });
        }
    }

    function isTouch() {
        return window.innerWidth < 980;
    }

    function hoverMenu() {
        // Додаємо обробник події для кожного dropdown
        document.querySelectorAll('.navigation__dropdown').forEach(function (dropdown) {
            var subMenu = dropdown.querySelector('.sub-navigation');

            let del;
            // removeClass('.navigation__dropdown', 'navigation__dropdown--active');
            // removeClass(subMenu, 'sub-navigation--active');


            dropdown.addEventListener('mouseover', function (event) {
                addActive(dropdown, 'navigation__dropdown--active');
                addActive(subMenu, 'sub-navigation--active');
                if (isTouch()) {
                    dropdown.removeEventListener('mouseover', del);
                }
            });

            dropdown.addEventListener('mouseout', function (event) {
                removeActive(dropdown, 'navigation__dropdown--active');
                removeActive(subMenu, 'sub-navigation--active');
                if (isTouch()) {
                    dropdown.removeEventListener('mouseout', del);
                }
            });

            // Додаємо обробник події для кожного sub-dropdown
            dropdown.querySelectorAll('.sub-navigation__dropdown').forEach(function (subDropdown) {
                var subRight = subDropdown.querySelector('.sub-navigation--right');

                // removeClass(subDropdown, 'sub-navigation__item--active');
                // removeClass(subRight, 'sub-navigation--right--active');

                subDropdown.addEventListener('mouseover', function (event) {
                    event.preventDefault();
                    addActive(subDropdown, 'sub-navigation__item--active');
                    addActive(subRight, 'sub-navigation--right--active');
                    if (isTouch()) {
                        subDropdown.removeEventListener('mouseover', del);
                    }
                });

                subDropdown.addEventListener('mouseout', function (event) {
                    event.preventDefault();
                    removeActive(subDropdown, 'sub-navigation__item--active');
                    removeActive(subRight, 'sub-navigation--right--active');
                    if (isTouch()) {
                        subDropdown.removeEventListener('mouseout', del);
                    }
                });
            });
        });
    }

    function removeAllClasses() {
        openMenuBtn.classList.remove('navigation-btn--active');
        navContainer.classList.remove('navigation--active');
        overlay.classList.remove('nav-overlay--open');
        document.body.classList.remove('modal-open');
        removeClass('.nav-open-sub', 'nav-open-sub--open');
        removeClass('.navigation__dropdown', 'navigation__dropdown--active');
        removeClass('.sub-navigation--right', 'sub-navigation--active');
        removeClass('.sub-navigation', 'sub-navigation--active');
        removeClass('.sub-navigation__dropdown', 'sub-navigation__item--active');
    }

    function clickMenu() {
        openMenuBtn.addEventListener('click', () => {

            if (overlay.classList.contains('nav-overlay--open')) {
                removeAllClasses();
            } else {
                openMenuBtn.classList.add('navigation-btn--active');
                navContainer.classList.add('navigation--active');
                overlay.classList.add('nav-overlay--open');
                document.body.classList.add('modal-open');
            }
        });

        mobOpenSub.forEach(btn => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('nav-open-sub--open');
                const subPopup = btn.nextElementSibling;
                const subParent = btn.parentElement;
                // if (subParent.classList.contains('navigation__dropdown')) {
                //     console.log('parent');
                //     removeClass('.navigation__dropdown', 'navigation__dropdown--active');
                //     removeClass('.sub-navigation', 'sub-navigation--active');
                //     subParent.classList.add('navigation__dropdown--active');
                //     subPopup.classList.add('sub-navigation--active');
                // }
                // if (subParent.classList.contains('sub-navigation__item')) {
                //     console.log(subParent);
                // }
                subPopup.classList.toggle('sub-navigation--active');
                if (subParent.classList.contains('navigation__dropdown')) {
                    subParent.classList.toggle('navigation__dropdown--active');
                } else {
                    subParent.classList.toggle('sub-navigation__item--active');
                }
            });
        });

        overlay.addEventListener('click', () => {
            removeAllClasses();
        });
    }

    function checkTouch() {
        if (isTouch()) {
            clickMenu()
        } else {
            hoverMenu();
        }
    }

    checkTouch();

    window.addEventListener('resize', function () {
        checkTouch();
    });
};
