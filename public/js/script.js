let nav = document.getElementById("nav");
let text = document.getElementById("nav-text");
let mobilenav = document.getElementById("nav-mobile-text");
let mobileback = document.getElementById("nav-mobile-backdrop");
let loginButton = document.getElementById("sign-in-btn");
let focus = false;

if (nav) {
  window.addEventListener("scroll", function () {
    if (document.body.scrollTop === 0) {
      nav.classList.remove("nav-dropped");
      text.style.color = "white";
      nav.style.color = "white";
      loginButton.classList.remove("color");
      loginButton.classList.add("white");

      var a = document.querySelectorAll("#nav-text a");
      [].forEach.call(a, function(i) {
        i.classList.remove("nax-text-hover");
      });

    } else {
      nav.classList.add("nav-dropped");
      text.style.color = "#3b3b3b";
      nav.style.color = "#3b3b3b";
      loginButton.classList.remove("white");
      loginButton.classList.add("color");

      var a = document.querySelectorAll("#nav-text a");
      [].forEach.call(a, function(i) {
        i.classList.add("nax-text-hover");
      });

    }
  });

  document.getElementById("nav-logo").addEventListener("focusout", function () {
    if (window.matchMedia("(max-width: 1100px)").matches) {
      setMobileNav(true);
      setTimeout(function () {
        document.querySelectorAll("#nav-mobile-text a")[0].focus();
      }, 100);
    }
  });

  mobilenav.addEventListener("focusin", function () {
    if (mobilenav.style.display === "none") {
      setMobileNav(true);
    }
    focus = true;
  }, true);

  mobilenav.addEventListener("focusout", function () {
    focus = false;
    setTimeout(function () {
      if (!focus) {
        setMobileNav(false);
      }
    }, 200);
  }, true);

  function setMobileNav(state) {
    if (state) {
      mobileback.style.display = "flex";
      mobilenav.style.display = "flex";
      mobilenav.style.opacity = 0;

      (function fade() {
        var val = parseFloat(mobilenav.style.opacity);
        if (!((val += .05) > 1)) {
          mobilenav.style.opacity = val;
          mobileback.style.opacity = val;
          requestAnimationFrame(fade);
        }
      })();
    } else {
      (function fade() {
        if ((mobilenav.style.opacity -= .05, mobileback.style.opacity -= .05) < .05) {
          mobilenav.style.display = "none";
          mobileback.style.display = "none";
        } else {
          requestAnimationFrame(fade);
        }
      })();
    }
  }
}

function ajax(param) {
  return new Promise((resolve, reject)=> {
    param.async = param.async || true;
    param.method = param.method || "GET";

    let xhttp = new XMLHttpRequest();
    if (param.headers) {
      for (header in param.headers) {
        xhttp.setRequestHeader(header, param.headers[header]);
      }
    }
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        if (this.status == 200 && param.success) {
          try {
            param.success(JSON.parse(this.responseText));
          } catch (err) {
            console.log(this.responseText);
          }
          resolve();
        } else if (param.error) {
          try {
            param.error(JSON.parse(this.responseText));
          } catch (err) {
            console.log(this.responseText);
          }
        }
      }
    }
    xhttp.open(param.method, param.url, param.async);
    if (param.data) {
      xhttp.send(JSON.stringify(param.data));
    } else {
      xhttp.send();
    }
  });
}

function getParams(name, url) {
  if (!url) {
    url = window.location.href;
  }
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
