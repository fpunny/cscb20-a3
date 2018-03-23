let syl_col1 = document.querySelectorAll("#syll-col-1 .content-card");
let syl_col2 = document.querySelectorAll("#syll-col-2 .content-card");

if (window.matchMedia("(max-width: 800px)").matches) {
  for (i = 0; i < syl_col1.length; i++) {
    (function(item) {
      setTimeout(function () {
        item.classList.add("drop-animate");
      }, (i) * 300);
    })(syl_col1[i]);
  }

  for (i = 0; i < syl_col2.length; i++) {
    (function(item) {
      setTimeout(function () {
        item.classList.add("drop-animate");
      }, (i) * 300);
    })(syl_col2[i]);
  }
} else {
  for (i = 0; i < Math.max(syl_col1.length, syl_col2.length); i++) {
    (function(item1, item2) {
      setTimeout(function () {
        if (item1) {
          item1.classList.add("drop-animate");
        }

        if (item2) {
          item2.classList.add("drop-animate");
        }
      }, (i) * 300);
    })(syl_col1[i], syl_col2[i]);
  }
}
