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
            <li>Or anything else you would like to comment on.</li>
          </ul>

          <p class="feedback-highlight">Please select a professor to address below before submitting.</p>
          <div class="feedback-wrapper">
            <select id="feedback-select" required>
              <option value="" selected disabled>Select a Professor</option>
            </select>
          </div>
        </div>
      </div>
      <div id="feedback-card-2" class="content-card" tabindex="0">
        <div class="feedback-card-header">
          <h2>Feedback Form</h2>
          <button onclick="send_feedback()" id="feedback-submit-btn">Submit</button>
        </div>
        <div class="feedback-card-content">
          <label>What do you like about the instructor teaching?</label>
          <textarea data-key="q1" class="feedback-form-input" placeholder="What's on your mind?"></textarea>
          <label>What do you recommend the instructor to do to improve their teaching?</label>
          <textarea data-key="q2" class="feedback-form-input" placeholder="What's on your mind?"></textarea>
          <label>What do you like about the labs?</label>
          <textarea data-key="q3" class="feedback-form-input" placeholder="What's on your mind?"></textarea>
          <label>What do you recommend the lab instructors to do to improve their lab teaching?</label>
          <textarea data-key="q4" class="feedback-form-input" placeholder="What's on your mind?"></textarea>
          <label>What else would you like us to know?</label>
          <textarea data-key="q5" class="feedback-form-input" placeholder="What's on your mind?"></textarea>
        </div>
      </div>
    </div>
  </section>
