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
      <form id="login-frame">
        <h2 class="form-title"><strong>CSCB20</strong> | Login</h2>
        <input id="email-input" type="text" placeholder="Email">
        <input id="pass-input" type="password" placeholder="Password">
        <div class="form-foot">
          <button type="submit">Login</button>
          <div>
            <a id="form-register" href="#register">New User? Click here to register!</a>
          </div>
        </div>
      </form>
    </section>
  </body>
  <script src="/public/js/script.js"></script>
  <script src="/public/js/<?php echo strtolower($viewName); ?>.js"></script>
</html>
