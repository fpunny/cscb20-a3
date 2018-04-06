let cards = document.querySelectorAll("#dashboard .content-card");
let backdrop = document.getElementById("modal-backdrop");
let modal = document.getElementById("modal");
let user, feedback, remarks;

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
        console.log(data);
        for (i in data) {
          var options = { year: 'numeric', month: 'long', day: 'numeric' };
          var stat = (data[i].viewed == 0)? 'NEW' : "viewed";
          var name = (data[i].viewed == 0)? ' new' : '';
          var date = new Date(data[i].date);
          data[i].date = date;

          var text = "&nbsp;";
          for (j in data[i].data) {
            if (data[i].data[j] != "") {
              text = data[i].data[j];
              break;
            }
          }

          src.innerHTML += '<div onclick="feedback_modal(' + i + ')" class="stack-item' + name + '"><div class="stack-head"><h3>' + date.toLocaleDateString('en-US', options) + '</h3><span>' + stat + '</span></div><div class="stack-status"><p>' + text + '</p><div class="dot"></div></div></div>';
        }
        feedback = data;
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
      remarks = data;
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

function setModal(state) {
  if (state) {
    backdrop.style.display = "flex";
    backdrop.style.opacity = 0;
    modal.style.display = "flex";
    modal.style.opacity = 0;

    (function modal_fade() {
      var val = parseFloat(backdrop.style.opacity);
      if (!((val += .05) > 1)) {
        backdrop.style.opacity = val;
        modal.style.opacity = val;
        requestAnimationFrame(modal_fade);
      }
    })();
  } else {
    (function modal_fade() {
      if ((modal.style.opacity -= .05, backdrop.style.opacity -= .05) < .05) {
        backdrop.style.display = "none";
        modal.style.display = "none";
        document.getElementById('modal-title').innerHTML = "";
        document.getElementById('modal-content').innerHTML = "";
      } else {
        requestAnimationFrame(modal_fade);
      }
    })();
  }
}

function defineModal(width, height) {
  modal.style.width = width;
  modal.style.height = height;
}

function feedback_modal(id) {
  document.getElementById('modal-title').innerHTML = "Feedback";
  for (i in feedback[id].data) {
    if (feedback[id].data[i] != "") {
      var header = "";
      switch(i) {
        case 'q1':
          header = "What do you like about the instructor teaching?"; break;
        case 'q2':
          header = "What do you recommend the instructor to do to improve their teaching?"; break;
        case 'q3':
          header = "What do you like about the labs?"; break;
        case 'q4':
          header = "What do you recommend the lab instructors to do to improve their lab teaching?"; break;
        case 'q5':
          header = "What else would you like us to know?"; break;
      }
      document.getElementById('modal-content').innerHTML += "<div class='feedback-modal-item'><h3>" + header + "</h3><p>" + feedback[id].data[i] + "</p></div>";
    }
  }
  view(id);
  setModal(true);
}

function view(id) {
  ajax({
    url: "api/feedback/" + feedback[id].id,
    method: "POST",
    success: function (data) {
      console.log(data);
      let item = document.querySelectorAll("#feedback .stack-item")[id];
      if (item.classList.contains("new")) {
        item.classList.remove("new");
        document.querySelectorAll("#feedback .stack-item")[0].children[0].children[1].innerHTML = "viewed";
      }
    },
    error: function (err) {
      console.log(err);
    }
  });
}
