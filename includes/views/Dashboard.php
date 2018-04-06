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
  <div id="modal-backdrop" class="pos-default" onclick="setModal(false)"></div>
  <div id="modal" class="pos-default">
    <div id="modal-header">
      <h2 id="modal-title"></h2>
      <i id="modal-close" class="fas fa-times" onclick="setModal(false)"></i>
    </div>
    <div id="modal-content"></div>
  </div>
</section>
