<section id="dashboard" class="section">
  <div id="dashboard-backdrop" class="pos-default"></div>
  <div id="dashboard-header-wrapper">
    <h1 id="dashboard-title">Dashboard</h1>
    <button id="logout-btn" onclick="logout()">Logout</button>
  </div>
  <div class="content">
    <div class="content-row">
      <div class="content-card small">
        <h2>Overview</h2>
        <div id="overview-content"></div>
        <div class="update-info-btn-wrapper">
          <a class="update-info-btn" href="#">Update Info</a>
        </div>
      </div>
      <div class="content-card big">
        <div class="content-head-wrapper">
          <h2>Remark Requests</h2>
          <?php
            if (Dashboard::getUser()['type'] == 'Student') {
              echo '<a href="marks" class="more">New Request</a>';
            }
          ?>
        </div>
        <div id="remarks" class="stack"></div>
      </div>
    </div>

    <?php

    $user = Dashboard::getUser();
    require_once("./includes/components/dashboard/" . $user['type'] . ".php");

    ?>

  </div>
</section>
