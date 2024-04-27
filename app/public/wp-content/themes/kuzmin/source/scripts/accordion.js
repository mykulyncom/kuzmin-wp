const details = document.querySelectorAll("details");

details.forEach((detail) => {
    detail.addEventListener("toggle", () => {
        if (detail.open) setTargetDetail(detail);
        detail.classList.toggle('accordion__item--open');
    });
});

function setTargetDetail(targetDetail) {
    details.forEach((detail) => {
        if (detail !== targetDetail) {
            detail.open = false;
        }
    });
}
