let feedback_items = document.querySelectorAll("#feedback .content-card");
let select = document.getElementById("feedback-select");
let form = document.getElementById("feedback-form-input");

for (i = 0; i < feedback_items.length; i++) {
  (function(item) {
    setTimeout(function () {
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(feedback_items[i]);
}

ajax({
  url: 'api/users',
  method: 'GET',
  success: function (data) {
    for (i in data) {
      if (data[i].type == "Professor") {
        select.innerHTML += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
      }
    }
  },
  error: function (err) {
    console.log(err);
  }
});

function send_feedback() {
  var complete = true;
  var obj = {};
  var items = document.querySelectorAll("#feedback-card-2 .feedback-form-input");
  if (select.value == "") {
    alert("Please select a professor");
    complete = false;
  } else {
    complete = false;
    // Ensure atleast one of them is filled out
    items.forEach(function(item) {
      complete = complete || (item.value != "");
      obj[item.getAttribute("data-key")] = item.value;
    });

    if (!complete) {
      alert("Please answer 1 or more questions");
    }
  }

  console.log({sid: select.value, data: obj});

  if (complete) {
    ajax({
      url: 'api/feedback',
      method: 'POST',
      data: {sid: select.value, data: obj},
      success: function (data) {
        alert("Feedback has been sent");
        location.reload();
      },
      error: function (err) {
        console.log(err);
      }
    });
  }
}
