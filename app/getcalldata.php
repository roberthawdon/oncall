<?php

include $PATH."/app/dblogin.php";

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query("SELECT tbl_schedules.*, tbl_users.* FROM tbl_schedules INNER JOIN tbl_users ON tbl_schedules.user_ID=tbl_users.ID WHERE NOW() BETWEEN tbl_schedules.start_date AND tbl_schedules.end_date") or die("Error: ".mysqli_error($con));

while($row = mysqli_fetch_array($result))
  {
  $userID = $row['user_ID'];
  $start = $row['start_date'];
  $end = $row['end_date'];
  $override = $row['override'];
  $occomment = $row['comment'];
  $firstname = $row['first_name'];
  $lastname = $row['last_name'];
  $username = $row['username'];
  $password = $row['password'];
  $phone = $row['phone'];
  $email = $row['email'];
  $avatar = $row['avatar'];
  $staff = $row['staff'];
  }

$fullname = "$firstname $lastname";

include $PATH."/app/dblogout.php";

?>
