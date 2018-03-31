let cards = document.querySelectorAll("#dashboard .content-card");
let user;

for (i = 0; i < cards.length; i++) {
  (function(item) {
    setTimeout(function () {
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(cards[i]);
}

ajax({
  url: "/_api/sessiontotoken",
  success: function (data) {
    console.log(data);
    user = data;
  },
  error: function (err) {
    console.log(err);
  }
}).then(function () {
  getUser();
  getGrades();
  getRemarks();
});

function getUser() {
  ajax({
    url: "/api/users/" + user.id + "?token=" + user.token,
    success: function (data) {
      var dat = data[0];
      console.log(dat);
      var src = document.getElementById("overview-content");
      for (item in dat) {
        var title = item[0].toUpperCase() + item.substr(1);
        if (item == "type") {
          switch(dat.type) {
            case 'S':
              dat.type = "Student"; break;
            case 'P':
              dat.type = "Professor"; break;
            case 'T':
              dat.type = "TA"; break;
          }
        }
        if (item != 'id' && dat[item] != null) {
          src.innerHTML += "<div class='overview-content'><h3>" + title + ":</h3><span>" + dat[item] + "</span></div>";
        }
      }
    },
    error: function (err) {
      console.log(err);
    }
  });
}

function getGrades() {

}

function getRemarks() {

}
