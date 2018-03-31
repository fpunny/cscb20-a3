let feedback_items = document.querySelectorAll("#feedback .content-card");

for (i = 0; i < feedback_items.length; i++) {
  (function(item) {
    setTimeout(function () {
      console.log(item);
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(feedback_items[i]);
}
