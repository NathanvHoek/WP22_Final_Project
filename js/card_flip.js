function flipCard() {
    var cards = document.querySelectorAll('.card');
    [...cards].forEach((card) => {
            card.classList.toggle('is-flipped');
        });
}