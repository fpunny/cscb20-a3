let newsfeed = document.getElementById("home-newsfeed");
let newsfeed_items = document.querySelectorAll(".home-news-item");
let resources = document.getElementById("home-res");
let res_items = document.querySelectorAll(".home-res-item");
let calendar = document.getElementById("calendar-wrapper");

if (newsfeed.offsetTop < (window.screen.height * (2 / 3))) {
  for (i = 0; i < newsfeed_items.length; i++) {
    (function(item) {
      setTimeout(function () {
        console.log(item);
        item.classList.add("drop-animate");
      }, (i) * 300);
    })(newsfeed_items[i]);
  }
} else {
  window.addEventListener("scroll", function newsListener() {
    if (document.body.scrollTop > 0) {
      for (i = 0; i < newsfeed_items.length; i++) {
        (function(item) {
          setTimeout(function () {
            console.log(item);
            item.classList.add("drop-animate");
          }, (i) * 300);
        })(newsfeed_items[i]);
      }
      window.removeEventListener("scroll", newsListener);
    }
  });
}

window.addEventListener("scroll", function calListener() {
  if (document.body.scrollTop > calendar.offsetTop - (window.screen.height * (2 / 3))) {
    calendar.classList.add("drop-animate");
    window.removeEventListener("scroll", calListener);
  }
});

window.addEventListener("scroll", function resListener() {
  if (document.body.scrollTop > resources.offsetTop - (window.screen.height * (2 / 3))) {
    for (i = 0; i < res_items.length; i++) {
      (function(item) {
        setTimeout(function () {
          console.log(item);
          item.classList.add("drop-animate");
        }, (i) * 300);
      })(res_items[i]);
    }
    window.removeEventListener("scroll", resListener);
  }
});
