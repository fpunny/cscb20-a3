<div class="overview">
  <div class="search content-card">
    <h2 class="content-header">Search by</h2>
    <p class="disclaimer">Search by utorid.<br><span class="subtext">(Displays all marks of the student)</span></p>
    <label>Utorid</label>
    <select id="utorid-select">
      <option value="" selected disabled>Select a utorid</option>
    </select>

    <div class="search-btn-wrapper">
      <button id="search-btn" type="button">Search</button>
    </div>
  </div>
  <div class="user content-card">
    <h2 class="content-header">User Information</h2>
    <form id="user-info">
      <h3 class="null-student">No Student has been selected yet :(</h3>
    </form>
  </div>
</div>

<?php

  if (Marks::getUser()["type"] == "Professor") {
    require_once("./includes/components/marks/Professor.php");
  }

?>

<div id="grades-list" class="content-card grades">
  <h2 class="content-header">All Grades</h2>
  <div class="list">
    <div class="list-header">
      <span class="list-col">Id</span>
      <span class="list-col">Utorid</span>
      <span class="list-col">Name</span>
      <span class="list-col">Work</span>
      <span class="list-col">Grade</span>
    </div>
    <div id="plist-body"></div>
  </div>
</div>
