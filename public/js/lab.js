let labs = document.querySelectorAll("#lab .content-card");
let labs_back = document.querySelectorAll("#lab .content-card .content-card-back");
let colors = ["#ff0068", "#007cff", "#00c2ba", "#00da3b", "#f9ae00"];

for (i = 0; i < labs.length; i++) {
  (function(item, back) {
    setTimeout(function () {
      back.style.backgroundColor = colors[Math.floor(Math.random()*colors.length)];
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(labs[i], labs_back[i]);
}
