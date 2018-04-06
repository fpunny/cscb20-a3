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
  url: "api/session",
  success: function (data) {
    user = data.data;
  },
  error: function (err) {
    console.log(err);
  }
}).then(function () {
  getUser();
  getFeedback();
  getRemarks();
  getGrades();
});

function getFeedback() {
  var src = document.getElementById("feedback");
  if (src) {
    ajax({
      url: "api/feedback",
      success: function (data) {
        for (i in data) {
          var options = { year: 'numeric', month: 'long', day: 'numeric' };
          var stat = (data[i].viewed == 0)? 'NEW' : "viewed";
          var name = (data[i].viewed == 0)? ' new' : '';
          var date = new Date(data[i].date);
          data[i].date = date;
          src.innerHTML += '<div onclick="feedback_modal(' + i + ')" class="stack-item' + name + '"><div class="stack-head"><h3>' + data.toLocaleDateString('en-US', options) + '</h3><span>' + stat + '</span></div><div class="stack-status"><p>' + data[i].data + '</p><div class="dot"></div></div></div>';
        }
      },
      error: function (err) {
        console.log(err);
      }
    });
  }
}

function getUser() {
  var dat = user;
  var src = document.getElementById("overview-content");
  for (item in dat) {
    var title = item[0].toUpperCase() + item.substr(1);
    if (item != 'id' && dat[item] != null) {
      src.innerHTML += "<div class='overview-content'><h3>" + title + ":</h3><span>" + dat[item] + "</span></div>";
    }
  }
}

function getGrades() {
  ajax({
    url: "api/marks",
    success: function (data) {
      var obj = {};

      for (i in data) {
        var type = data[i].type;
        if (!(type in obj)) {
          obj[type] = {total: 0, grade: 0};
        }
        obj[type].total += parseInt(data[i].total);
        obj[type].grade += parseInt(data[i].grade);
      }

      var src = document.getElementById('grades');
      if (src) {
        for (i in obj) {
          var grade = Math.round(obj[i].grade / obj[i].total * 10000) / 100;
          src.innerHTML += '<div class="grade-content"><span>' + grade + '%</span><h3>' + i + '</h3></div>';
        }
      }

    },
    error: function (err) {
      console.log(err);
    }
  });
}

function getRemarks() {
  ajax({
    url: "api/remarks",
    success: function (data) {
      var src = document.getElementById("remarks");
      for (i in data) {
        var msg = data[i].data[data[i].data.length - 1];
        var date = new Date(msg.time);
        data[i].date = date;
        var time = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();

        src.innerHTML += '<div onclick="remarks_modal(' + i + ')" class="stack-item"><div class="stack-head"><h3>' + data[i].wName + ' - ' + data[i].name + '</h3><span>' + time + '</span></div><div class="stack-status"><p>' + msg.data + '</p><div class="dot"></div></div></div>';
      }
    },
    error: function (err) {
      console.log(err);
    }
  });
}

function logout() {
  ajax({
    url: "api/login",
    method: "DELETE",
    success: function (data) {
      window.location.href = 'home';
    },
    error: function (err) {
      console.log(err);
    }
  })
}
