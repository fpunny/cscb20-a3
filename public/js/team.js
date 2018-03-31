let team_items = document.querySelectorAll("#team .content-card");

console.log(team_items);

for (i = 0; i < team_items.length; i++) {
  (function(item) {
    setTimeout(function () {
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(team_items[i]);
}
