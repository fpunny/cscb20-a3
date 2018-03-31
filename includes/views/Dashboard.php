<?php
session_start();
?>
<section id="dashboard" class="section">
  <div id="dashboard-backdrop" class="pos-default"></div>
  <div id="dashboard-header-wrapper">
    <h1 id="dashboard-title">Dashboard</h1>
    <a href="#" id="logout-btn">Logout</a>
  </div>
  <div class="content">
    <div class="content-row">
      <div class="content-card small">
        <h2>Overview</h2>
        <div class="overview-content">
          <h3>Name:</h3>
          <span>Nancii</span>
        </div>
        <div class="overview-content">
          <h3>Type:</h3>
          <span>Student</span>
        </div>
        <div class="overview-content">
          <h3>Email:</h3>
          <span>Nancii@nancii.com</span>
        </div>
        <div class="overview-content">
          <h3>Utorid:</h3>
          <span>NanciiNancii</span>
        </div>
        <div class="update-info-btn-wrapper">
          <a class="update-info-btn" href="#">Update Info</a>
        </div>
      </div>
      <div class="content-card big">
        <div class="content-head-wrapper">
          <h2>Remark Requests</h2>
          <a href="#" class="more">New Request</a>
        </div>
        <div class="stack">

          <div class="stack-item new">
            <div class="stack-head">
              <h3>Assignment 1</h3>
              <span>Today</span>
            </div>
            <div class="stack-status">
              <p>Pls give me grade</p>
              <div class="dot"></div>
            </div>
          </div>

          <div class="stack-item">
            <div class="stack-head">
              <h3>Assignment 2</h3>
              <span>2 Months ago</span>
            </div>
            <div class="stack-status">
              <p>NOPE xDDD. GET REKT. YEEEEEEEEEEEEEEEEEeeETTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTtttttTT</p>
              <div class="dot"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    $user = Controller::getUser();
    require_once("./includes/components/dashboard/" . $user['type'] . ".php");

    ?>

  </div>
</section>
