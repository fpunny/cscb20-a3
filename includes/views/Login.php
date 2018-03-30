<?php
  session_start();
  $_SESSION["token"] = "abcd";
  echo "QED";
?>
<div align = "center">
  <div class = "margin" align = "left">
    <div class = "topback"><b>Login</b>
      <form action = "">
        <input type = 'radio' name = "student" value = "Student">Student<br>
        <input type = 'radio' name="Ta" value = "Ta">TA<br>
        <input type = 'radio' name="professor" value = "Professor">professor<br>
      </form>
    </div>
      <div class = "innermargin">
        <form action = "" method = "post">
          <label> UserName   :</label><input type = "text" name = "username" class = 'box'/><br /><br />
          <label> Password   :</label><input type = "password" name = "password" class = "box"  /><br /><br />
          <input type = "submit" value = "Login"/><br />
        </form>
      </div>
  </div>
</div>
