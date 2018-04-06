<section id="marks" class="section">
  <h1 class="main-header">Marks</h1>
  <div class="backdrop pos-default section"></div>
  <?php
    if (Dashboard::getUser()['type'] == 'Student') {
      require_once("./includes/components/marks/Student.php");
    } else {
      require_once("./includes/components/marks/Staff.php");
    }
  ?>
</section>
