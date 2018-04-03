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
  url: "/api/session",
  success: function (data) {
    user = data.data;
  },
  error: function (err) {
    console.log(err);
  }
}).then(function () {
  getUser();
  getFeedback();
  ajax({
    url: "/api/work",
    success: function (data) {
      getGrades(data);
      getRemarks(data);
    },
    error: function (err) {
      console.log(err);
    }
  });
});

function getFeedback() {
  var src = document.getElementById("feedback");
  if (src) {
    ajax({
      url: "/api/feedback?token=",
      success: function (data) {
        for (i in data) {
          var options = { year: 'numeric', month: 'long', day: 'numeric' };
          var stat = (data[i].viewed == 0)? 'NEW' : "viewed";
          var name = (data[i].viewed == 0)? ' new' : '';
          var date = new Date(data[i].date);
          src.innerHTML += '<a href="/feedbacks/' + data[i].id + '" class="stack-item' + name + '"><div class="stack-head"><h3>' + date.toLocaleDateString('en-US', options) + '</h3><span>' + stat + '</span></div><div class="stack-status"><p>' + data[i].data + '</p><div class="dot"></div></div></a>';
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
}

function getGrades(work) {
  ajax({
    url: "/api/marks",
    success: function (data) {
      var obj = {};
      for (i in work) {
        var type = work[i].type;
        var wid = work[i].id;
        if (!(wid in obj)) {
          obj[wid] = {total: 0, grade: 0};
          switch (type) {
            case 'A':
              obj[wid].name = "Assignment"; break;
            case 'L':
              obj[wid].name = "Lab"; break;
            case 'M':
              obj[wid].name = "Midterm"; break;
            case 'F':
              obj[wid].name = "Final"; break;
          }
        }
        obj[wid].total += parseInt(work[i].total);
      }

      for (i in data) {
        obj[data[i].wid].grade += parseInt(data[i].grade);
      }

      var src = document.getElementById('grades');
      if (src) {
        for (i in obj) {
          var grade = Math.round(obj[i].grade / obj[i].total * 10000) / 100;
          src.innerHTML += '<div class="grade-content"><span>' + grade + '%</span><h3>' + obj[i].name + '</h3></div>';
        }
      }

    },
    error: function (err) {
      console.log(err);
    }
  });
}

function getRemarks(work) {
  ajax({
    url: "/api/remarks?token=" + user.token,
    success: function (data) {
      var src = document.getElementById("remarks");
      for (i in data) {
        for (j in work) {
          if (data[i].wid == work[j].id) {
            var msg = data[i].data[data[i].data.length - 1];
            var date = new Date(msg.time);
            var time = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();

            src.innerHTML += '<a href="/remarks/' + data[i].id + '" class="stack-item"><div class="stack-head"><h3>' + work[j].name + '</h3><span>' + time + '</span></div><div class="stack-status"><p>' + msg.data + '</p><div class="dot"></div></div></a>';
          }
        }
      }
    },
    error: function (err) {
      console.log(err);
    }
  });
}
