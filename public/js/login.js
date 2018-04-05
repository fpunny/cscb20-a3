let cards = document.querySelectorAll("#login .login-frame");

for (i = 0; i < cards.length; i++) {
  (function(item) {
    setTimeout(function () {
      item.classList.add("drop-animate");
    }, (i) * 300);
  })(cards[i]);
}

let msg = getParams("alert");
if (msg) {
  document.getElementById("alert").innerHTML = msg;
}

document.getElementById("login-btn").addEventListener("click", function(event) {
    event.preventDefault();
    let succ = true;
    let email = document.getElementById("login-email-input");
    let pass = document.getElementById("login-pass-input");

    let elabel = document.getElementById("login-email-label");
    let plabel = document.getElementById("login-pass-label");

    email.classList.remove("success");
    pass.classList.remove("success");
    email.classList.remove("error");
    pass.classList.remove("error");

    if (email.value == "") {
      email.classList.add("error");
      elabel.innerHTML = "Missing Email";
      succ = false;
    } else if (!(/(.+)@(.+){2,}\.(.+){2,}/.test(email.value))) {
      email.classList.add("error");
      elabel.innerHTML = "Invalid Email";
      succ = false;
    } else {
      email.classList.add("success");
      elabel.innerHTML = "";
    }

    if (pass.value != "") {
      pass.classList.add("success");
      plabel.innerHTML = "";
    } else {
      pass.classList.add("error");
      plabel.innerHTML = "Missing Password";
      succ = false;
    }

    if (succ) {
      login(email.value, pass.value);
    }
});

document.getElementById("register-btn").addEventListener("click", function(event) {
  event.preventDefault();
  let succ = true;
  let name = document.getElementById("reg-name-input");
  let utor = document.getElementById("reg-utorid-input");
  let email = document.getElementById("reg-email-input");
  let pass = document.getElementById("reg-pass-input");
  let select = document.getElementById("reg-type-input");

  let nlabel = document.getElementById("reg-name-label");
  let ulabel = document.getElementById("reg-utorid-label");
  let elabel = document.getElementById("reg-email-label");
  let plabel = document.getElementById("reg-pass-label");
  let slabel = document.getElementById("reg-type-label");

  let list = [[name, nlabel], [utor, ulabel], [pass, plabel], [select, slabel]];

  for (i in list) {
    list[i][0].classList.remove("success");
    list[i][0].classList.remove("error");

    if (list[i][0].value == "") {
      list[i][0].classList.add("error");
      list[i][1].innerHTML = "Missing Value";
      succ = false;
    } else {
      list[i][0].classList.add("success");
      list[i][1].innerHTML = "";
    }
  }

  email.classList.remove("success");
  email.classList.remove("error");

  if (email.value == "") {
    email.classList.add("error");
    elabel.innerHTML = "Missing Email";
    succ = false;
  } else if (!(/(.+)@(.+){2,}\.(.+){2,}/.test(email.value))) {
    email.classList.add("error");
    elabel.innerHTML = "Invalid Email";
    succ = false;
  } else {
    email.classList.add("success");
    elabel.innerHTML = "";
  }

  if (succ) {
    register(name.value, utor.value, email.value, pass.value, select.value);
  }

});

function login(email, password) {
  ajax({
    url: 'api/login',
    method: 'POST',
    data: {"e": email, "w": password},
    success: function (data) {
      let callback = getParams("callback");
      let base = document.getElementsByTagName('base');
      if (base && base.length > 0) {
        base = base[0].href;
      }
      if (callback) {
        window.location.replace(base + callback);
      } else {
        window.location.replace(base + "dashboard");
      }
    },
    error: function (err) {
      console.log(err);
    }
  });
}

function register(name, utorid, email, pass, type) {
  ajax({
    url: 'api/register',
    method: 'POST',
    data: {
      name: name,
      utorid: utorid,
      email: email,
      password: pass,
      type: type
    },
    success: function (data) {
      alert("You have successfully be registered");
      login(email, pass);
    },
    error: function (err) {
      alert("There appears to be an error. Do you perhaps have an account already?");
      console.log(err);
    }
  });
}
