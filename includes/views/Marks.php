<section id="marks" class="section">
  <h1 class="main-header">Marks</h1>
  <div class="backdrop pos-default section"></div>
  <div class="overview">
    <div class="search content-card">
      <h2 class="content-header">Search by</h2>
      <p class="disclaimer">Search by utorid or userid.<br><span class="subtext">(By utorid if both selected)</span></p>
      <label>Utorid</label>
      <select id="utorid-select">
        <option value="" selected disabled>Select a utorid</option>
      </select>

      <label>User Id</label>
      <select id="id-select">
        <option value="" selected disabled>Select an id</option>
      </select>

      <div class="search-btn-wrapper">
        <button id="search-btn" type="button">Search</button>
      </div>
    </div>
    <div class="user content-card">
      <h2 class="content-header">User Information</h2>
      <div id="user-info">
        <h3 class="null-student">No Student Currently :(</h3>
      </div>
    </div>
  </div>
  <div class="content-card grades">
    <h2 class="content-header">All Grades</h2>
    <div class="list">
      <div class="list-header">
        <span class="list-col">
          Id
        </span>
        <span class="list-col">
          Utorid
        </span>
        <span class="list-col">
          Name
        </span>
        <span class="list-col">
          Work
        </span>
        <span class="list-col">
          Grade
        </span>
      </div>
      <div id="list-body">
        <div class="list-row">
          <span class="list-col">
            1
          </span>
          <span class="list-col">
            a
          </span>
          <span class="list-col">
            aa
          </span>
          <span class="list-col">
            A1
          </span>
          <span class="list-col">
            10
          </span>
        </div>
      </div>
    </div>
  </div>
</section>
