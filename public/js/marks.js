let cards = document.querySelectorAll("#marks .content-card");
let uSearch = document.getElementById("utorid-select");
let cSearch = document.getElementById("course-select");
let course = document.getElementById("course-content");
let info = document.getElementById("user-info");
let pList = document.getElementById('plist-body');
let sList = document.getElementById('slist-body');
let btn = document.getElementById('search-btn');
let cBtn = document.getElementById('course-search-btn');
let marks = [];
let work = [];

for (i = 0; i < cards.length; i++) {
  (function(item) {
    setTimeout(function () {
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(cards[i]);
}

ajax({
  url: 'api/marks',
  method: 'GET',
  success: function (data) {
    marks = data;
    for (i in marks) {
      // Professor/TA Dashboard
      if (pList) {
        pList.innerHTML += '<div class="list-row"><span class="list-col">' + marks[i].id + '</span><span class="list-col">' + marks[i].utorid + '</span><span class="list-col">' + marks[i].sname + '</span><span class="list-col">' + marks[i].wname + '</span><span class="list-col">' + marks[i].grade + '/' + marks[i].total + '</span></div>';
      } else if (sList) {
        sList.innerHTML += '<div class="list-row"><span class="list-col">' + marks[i].id + '</span><span class="list-col">' + marks[i].wname + '</span><span class="list-col">' + marks[i].grade + '/' + marks[i].total + '</span></div>';
      }
    }
  },
  error: function (err) {
    console.log(err);
  }
}).then(function () {
  if (btn && uSearch && info) {
    ajax({
      url: 'api/users',
      method: 'GET',
      success: function (data) {
        for (i in data) {
          if (data[i].type == "Student") {
            uSearch.innerHTML += "<option value='" + data[i].utorid + "'>" + data[i].utorid + "</option>";
          }
        }
      },
      error: function (err) {
        console.log(err);
      }
    });

    btn.addEventListener('click', function (e) {
      if (uSearch.value != "") {
        info.innerHTML = "";
        let value = uSearch.value;
        let sid = -1;
        for (i in marks) {
          if (value == marks[i].utorid) {
            sid = marks[i].sid;
            info.innerHTML += '<div class="mark-item"><label>' + marks[i].wname + '</label><input type="number" data-id="' + marks[i].id + '" data-wid="' + marks[i].wid + '" placeholder="' + marks[i].grade + '/' + marks[i].total + '" min="0" max="' + marks[i].total + '"/></div>';
          }
        }
        info.innerHTML += "<button id='update-btn' type='button' onclick='update(" + sid + ")'>Update</button>"
      }
    });
  }

  if (cSearch && course) {
    ajax({
      url: 'api/work',
      method: "GET",
      success: function (data) {
        work = data;
        for (i in data) {
          cSearch.innerHTML += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
        }
      },
      error: function (err) {
        console.log(err);
      }
    }).then(function () {
      cBtn.addEventListener('click', function (e) {
        if (cSearch.value != "") {
          course.innerHTML = "";
          let value  = cSearch.value;
          if (value == "0") {
            course.innerHTML = '<div class="mark-item"><label>Name</label><input type="text" data-key="name" placeholder="What\'s name?"></div><div class="mark-item"><label>Type</label><input type="text" data-key="type" placeholder="What work is this?"></div><div class="mark-item"><label>Total</label><input type="number" data-key="total" min="0" placeholder="What is out of?"></div>';
          } else {
            for (i in work) {
              if (value == work[i].id) {
                course.innerHTML = '<div class="mark-item"><label>Name</label><input type="text" data-key="name" placeholder="' + work[i].name + '"></div><div class="mark-item"><label>Type</label><input type="text" data-key="type" placeholder="' + work[i].type + '"></div><div class="mark-item"><label>Total</label><input type="number" data-key="total" min="0" placeholder="' + work[i].total + '"></div>';
              }
            }
          }
          course.innerHTML += "<button id='update-btn' type='button' onclick='update_work(" + value + ")'>Update</button>"
        }
      });
    });
  }

  if (document.getElementById("grade-student")) {
    let grade_select = document.getElementById("grade-select");
    let grade_btn = document.getElementById("grade-submit-btn");
    let grade_text = document.getElementById("grade-text");

    for (i in marks) {
      grade_select.innerHTML += "<option value='" + marks[i].wid + "'>" + marks[i].wname + "</option>"
    }

    grade_btn.addEventListener("click", function (e) {
      if (grade_select.value != "" && grade_text.value != "") {
        ajax({
          url: "api/remarks",
          method: "POST",
          data: {wid: parseInt(grade_select.value), data: grade_text.value},
          success: function (data) {
            alert("Remark Request Sent");
            location.reload();
          },
          error: function (err) {
            console.log(err);
          }
        });
      } else if (grade_select.value == ""){
        alert("Please select the work to remark");
      } else {
        alert("Please provide a reason for your remark");
      }
    });
  }
});

function update(sid) {
  let items = document.querySelectorAll("#user-info .mark-item input");
  items.forEach(function(item) {
    if (item.value != "") {
      let id = item.getAttribute("data-id");
      let wid = item.getAttribute("data-wid");

      ajax({
        url: 'api/marks/' + id,
        method: 'POST',
        data: {"wid": wid, "sid": sid, "grade": item.value},
        success: function(data) {
          console.log(id + " Has successfully been updated");
        },
        error: function (err) {
          console.log(err);
        }
      });
    }
  });
  alert("Marks have been posted/updated");
  location.reload();
}

function update_work(id) {
  let items = document.querySelectorAll('#course-content .mark-item input');
  let obj = {};

  // Add New
  if (id == 0) {
    items.forEach(function (item) {
      if (item.value != "") {
        switch(item.getAttribute("type")) {
          case "text":
            obj[item.getAttribute("data-key")] = "'" + item.value + "'";
            break;
          case "number":
            obj[item.getAttribute("data-key")] = parseInt(item.value);
            break;
        }
      } else {
        alert("Missing " + item.getAttribute("data-key"));
      }
    });

  // Update
  } else {
    items.forEach(function (item) {
      if (item.value != "") {
        switch(item.getAttribute("type")) {
          case "text":
            obj[item.getAttribute("data-key")] = "'" + item.value + "'";
            break;
          case "number":
            obj[item.getAttribute("data-key")] = parseInt(item.value);
            break;
        }
      }
    });
  }

  ajax({
    url: "api/work" + (id != 0? "/" + id: ""),
    method: "POST",
    data: obj,
    success: function (data) {
      console.log(data);
      alert("Successfully work updated/created");
      location.reload();
    },
    error: function (err) {
      console.log(err);
    }
  });
}
