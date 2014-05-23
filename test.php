<?php

include_once "config/config.php";
include "app/dblogin.php";

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query("SELECT tbl_schedules.*, tbl_users.* FROM tbl_schedules INNER JOIN tbl_users ON tbl_schedules.user_ID=tbl_users.ID WHERE NOW() BETWEEN tbl_schedules.start_date AND tbl_schedules.end_date") or die("Error: ".mysqli_error($con));

while($row = mysqli_fetch_array($result))
  {
  echo "" . $row['user_ID'] . " ";
  echo "" . $row['start_date'] . " ";
  echo "" . $row['end_date'] . " ";
  echo "" . $row['override'] . " ";
  echo "" . $row['comment'] . " ";
  echo "" . $row['first_name'] . " ";
  echo "" . $row['last_name'] . " ";
  echo "" . $row['username'] . " ";
  echo "" . $row['password'] . " ";
  echo "" . $row['auth'] . " ";
  echo "" . $row['auth_active'] . " ";
  echo "" . $row['phone'] . " ";
  echo "" . $row['email'] . " ";
  echo "" . $row['avatar'] . " ";
  echo "" . $row['staff'] . " ";
  }


include "app/dblogout.php";

?>
