<div id="grade-student" class="overview remark">
  <div class="grade-card content-card">
    <h2 class="content-header">Remark Request</h2>
    <p class="disclaimer">Select the course work to remark.</p>
    <label>Course Work</label>
    <select id="grade-select">
      <option value="" selected disabled>Select a course work</option>
    </select>

    <div class="grade-btn-wrapper">
      <button id="grade-submit-btn" type="button">Submit</button>
    </div>
  </div>
  <div class="reason-card content-card">
    <h2 class="content-header">Reason</h2>
    <form id="grade-content">
      <textarea id="grade-text" placeholder="Explain clearly where and why you believe the mark is incorrect and we would respond as soon as possible"></textarea>
    </form>
  </div>
</div>

<div id="grades-list" class="content-card grades">
  <h2 class="content-header">All Grades</h2>
  <div class="list">
    <div class="list-header">
      <span class="list-col">Id</span>
      <span class="list-col">Work</span>
      <span class="list-col">Grade</span>
    </div>
    <div id="slist-body"></div>
  </div>
</div>
