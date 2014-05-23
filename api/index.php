<?php

header('Content-Type: application/json');

$apiver = "1";

$output = "";
$auth = "";

include_once "../config/config.php";
include $PATH."/app/dblogin.php";

function calldb($query) {

global $auth, $con, $PATH, $DBHOST, $DBUSER, $DBPASS, $DBNAME;

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query($query) or die("Error: ".mysqli_error($con));

return $result;

}

function checkauth($auth) {

$query = "SELECT tbl_users.*, tbl_auth.* FROM tbl_auth INNER JOIN tbl_users on tbl_auth.user_ID=tbl_users.ID WHERE token = '$auth'";

$result = calldb($query);

if($result->num_rows == 0)
{
$valid = FALSE;
} else {
$valid = TRUE;
}

return $valid;

}

function process($result) {

global $apiver, $action;

if ($action == "test") {
while($row = mysqli_fetch_array($result))
  {
  $userID = $row['user_ID'];
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  }
$output = "{\"api_version\":\"".$apiver."\",\"authenticated_user\":\"".$userID."\",\"authenticated_first_name\":\"".$first_name."\",\"authenticated_last_name\":\"".$last_name."\"}";
}
elseif ($action == "current") {
while($row = mysqli_fetch_array($result))
  {
  $userID = $row['user_ID'];
  $startdate = $row['start_date'];
  $enddate = $row['end_date'];
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
$output = "{\"api_version\":\"".$apiver."\",\"user_ID\":\"".$userID."\",\"first_name\":\"".$firstname."\",\"last_name\":\"".$lastname."\",\"phone\":\"".$phone."\",\"email\":\"".$email."\",\"start_date\":\"".$startdate."\",\"end_date\":\"".$enddate."\",\"avatar\":\"".$avatar."\",\"comment\":\"".$occomment."\"}";
}

return $output;

}

function genquery($action) {

global $auth;

if ($action == "test") {
$query = "SELECT tbl_users.*, tbl_auth.* FROM tbl_auth INNER JOIN tbl_users on tbl_auth.user_ID=tbl_users.ID WHERE token = '$auth'";
}
elseif ($action == "current") {
$query = "SELECT tbl_schedules.*, tbl_users.* FROM tbl_schedules INNER JOIN tbl_users ON tbl_schedules.user_ID=tbl_users.ID WHERE NOW() BETWEEN tbl_schedules.start_date AND tbl_schedules.end_date";
}

return $query;

}

if (isset($_POST['data']) && !empty($_POST['data'])) {
$data = $_POST['data'];
$json_a=json_decode($data,true);
} else {
$output  = "{\"api_version\":\"".$apiver."\",\"error\":\"no data\"}";
}

if (isset($json_a["auth"])) {
$auth = $json_a["auth"];
} else {
$output  = "{\"api_version\":\"".$apiver."\",\"error\":\"unauthorized\"}";
}


if (isset($json_a["action"])) {
$action = $json_a["action"];
$varify = checkauth($auth);
if ($varify) {
$query = genquery($action);
$result = calldb($query);
$output = process($result);
} else {
$output  = "{\"api_version\":\"".$apiver."\",\"error\":\"unauthorized\"}";
}
} else {
$output  = "{\"api_version\":\"".$apiver."\",\"error\":\"no action requested\"}";
}

include $PATH."/app/dblogout.php";

echo $output;?>
