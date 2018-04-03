<html>
  <head>
    <title>CSCB20 - <?php echo $viewName; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111113">

    <link rel='stylesheet' type='text/css' href='/public/css/main.css'>
    <link rel='stylesheet' type='text/css' href='/public/css/<?php echo strtolower($viewName); ?>.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300|Source+Sans+Pro" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  </head>
  <body>
    <section id="login" class="section">
      <div class="frame">
        <form class="login-frame" id="login-frame">
          <h2 class="form-title"><strong>CSCB20</strong> | Login</h2>
          <p id="alert"></p>
          <input id="login-email-input" type="text" placeholder="Email" required>
          <label id="login-email-label" for="login-email-input"></label>
          <input id="login-pass-input" type="password" placeholder="Password" required>
          <label id="login-pass-label" for="login-pass-input"></label>
          <div class="form-foot">
            <button id="login-btn" type="submit">Login</button>
          </div>
        </form>
        <form class="login-frame" id="register-frame">
          <h2 class="form-title"><strong>CSCB20</strong> | Register</h2>
          <input id="reg-name-input" type="text" placeholder="Full Name" required>
          <label id="reg-name-label" for="reg-name-input"></label>
          <input id="reg-utorid-input" type="text" placeholder="Utorid" required>
          <label id="reg-utorid-label" for="reg-utorid-input"></label>
          <input id="reg-email-input" type="text" placeholder="Email" required>
          <label id="reg-email-label" for="reg-email-input"></label>
          <input id="reg-pass-input" type="password" placeholder="Password" required>
          <label id="reg-pass-label" for="reg-pass-input"></label>
          <select id="reg-type-input"  required>
            <option value="" selected disabled>User Type</option>
            <option value="S">Student</option>
            <option value="P">Professor</option>
            <option value="T">TA</option>
          </select>
          <label id="reg-type-label" for="reg-type-input"></label>
          <div class="form-foot">
            <button id="register-btn" type="submit">Register</button>
          </div>
        </form>
      </div>
    </section>
  </body>
  <script src="/public/js/script.js"></script>
  <script src="/public/js/<?php echo strtolower($viewName); ?>.js"></script>
</html>
