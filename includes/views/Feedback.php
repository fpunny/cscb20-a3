  <section id="feedback" class="section">
    <div id="feedback-backdrop" class="pos-default"></div>
    <h1 id="feedback-title">Feedback</h1>
    <div class="content">
      <div id="feedback-card-1" class="content-card" tabindex="0">
        <div class="feedback-card-header">
          <h2>Your Opinion Matters</h2>
        </div>
        <div class="feedback-card-content">
          <p class="feedback-highlight">Let us know so we can further improve the course</p>
          <ul>
            <li>What do you like about the instructor teaching?</li>
            <li>What do you recommend the instructor to do to improve their teaching?</li>
            <li>What do you like about the labs?</li>
            <li>What do you recommend the lab instructors to do to improve their lab teaching?</li>
          </ul>

          <p class="feedback-highlight">Please select a professor to address below before sumbitting.</p>
          <div class="course-eval-wrapper">
            <select id="course-eval-select"  required>
              <option value="" selected disabled>Select a Professor</option>
              <option value="S">Student</option>
              <option value="P">Professor</option>
              <option value="T">TA</option>
            </select>
          </div>
        </div>
      </div>
      <div id="feedback-card-2" class="content-card" tabindex="0">
        <div class="feedback-card-header">
          <h2>Feedback Form</h2>
          <button id="feedback-submit-btn">Submit</button>
        </div>
        <div class="feedback-card-content">
          <textarea id="feedback-form-input" placeholder="What's on your mind?"></textarea>
        </div>
      </div>
    </div>
  </section>
