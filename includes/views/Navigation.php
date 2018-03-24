<html>
  <head>
    <title>CSCB20 - <?php echo $viewName; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111113">

    <link rel='stylesheet' type='text/css' href='/cscb20/punfrede/public/css/main.css'>
    <link rel='stylesheet' type='text/css' href='/cscb20/punfrede/public/css/<?php echo strtolower($viewName); ?>.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300|Source+Sans+Pro" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  </head>
  <body>
    <nav id="nav">
      <a id="nav-logo" href="index.html">CSCB20</a>
      <ul id="nav-text">
        <a href="home"><li>Home</li></a>
        <a href="syllabus"><li>Syllabus</li></a>
        <a href="assignment"><li>Assignments</li></a>
        <a href="lab"><li>Labs</li></a>
        <a href="https://piazza.com/class/jcpjjp5l4bywd"><li>Piazza</li></a>
        <a href="https://markus.utsc.utoronto.ca/cscb20w18/?locale=en"><li>Markus</li></a>
        <a href="team"><li>Course Team</li></a>
        <a href="feedback"><li>Feedback</li></a>
      </ul>
      <div id="nav-mobile">
        <i id="nav-mobile-btn" class="fas fa-bars" onclick="setMobileNav(true)"></i>
      </div>
    </nav>
    <ul id="nav-mobile-text" class="pos-default">
      <li id="nav-mobile-controls">
        <div onclick="setMobileNav(false)">
          <i class="fas fa-arrow-left"></i>
          <span>Back</span>
        </div>
      </li>
      <a href="home"><li>Home</li></a>
      <a href="syllabus"><li>Syllabus</li></a>
      <a href="assignment"><li>Assignments</li></a>
      <a href="lab"><li>Labs</li></a>
      <a href="https://piazza.com/class/jcpjjp5l4bywd"><li>Piazza</li></a>
      <a href="https://markus.utsc.utoronto.ca/cscb20w18/?locale=en"><li>Markus</li></a>
      <a href="team"><li>Course Team</li></a>
      <a href="feedback"><li>Feedback</li></a>
    </ul>
    <div id="nav-mobile-backdrop" class="pos-default" onclick="setMobileNav(false)"></div>
