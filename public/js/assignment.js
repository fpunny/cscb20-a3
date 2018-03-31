let assignments = document.querySelectorAll("#assignment .content-card");

for (i = 0; i < assignments.length; i++) {
  (function(item) {
    setTimeout(function () {
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(assignments[i]);
}
