let cards = document.querySelectorAll("#dashboard .content-card");

console.log(cards);

for (i = 0; i < cards.length; i++) {
  (function(item) {
    setTimeout(function () {
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(cards[i]);
}
