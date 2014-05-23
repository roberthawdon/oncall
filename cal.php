<?php

$auth = $_GET['auth'];

include_once "config/config.php";
include $PATH."/app/dblogin.php";

function checkauth($auth) {

global $con, $PATH, $DBHOST, $DBUSER, $DBPASS, $DBNAME;

$query = "SELECT tbl_users.*, tbl_auth.* FROM tbl_auth INNER JOIN tbl_users on tbl_auth.user_ID=tbl_users.ID WHERE token = '$auth'";

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query($query) or die("Error: ".mysqli_error($con));

if($result->num_rows == 0)
{
$valid = FALSE;
} else {
$valid = TRUE;
}

return $valid;

}

function getschedule() {

global $con, $PATH, $DBHOST, $DBUSER, $DBPASS, $DBNAME;

$query = "SELECT tbl_schedules.*, tbl_users.* FROM tbl_schedules INNER JOIN tbl_users ON tbl_schedules.user_ID=tbl_users.ID ORDER BY tbl_schedules.ID";

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query($query) or die("Error: ".mysqli_error($con));

return $result;

}

function process($result) {

while($row = mysqli_fetch_array($result))
  {
  
  $dtstart = strtotime($row['start_date']);
  $dtend = strtotime($row['end_date']);
  
  echo "BEGIN:VEVENT
DTSTART;VALUE=DATE:".date("Ymd", $dtstart)."
DTEND;VALUE=DATE:".date("Ymd", $dtend)."
DTSTAMP:".date("Ymd\THis\Z", $dtstart)."
UID:" . md5(uniqid(mt_rand(), true)) . "@oncall.test
CREATED:".date("Ymd\THis\Z", $dtstart)."
DESCRIPTION:".$row['first_name']."'s phone number is: ".$row['phone']."
LAST-MODIFIED:".date("Ymd\THis\Z", $dtstart)."
LOCATION:
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY:".$row['first_name']." ".$row['last_name']." is on call
TRANSP:TRANSPARENT
END:VEVENT
";
  }
}

header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename=calendar.ics');

$valid = checkauth($auth);

if ($valid) {
echo "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
METHOD:PUBLISH
X-WR-CALNAME:Who's on call?
X-WR-TIMEZONE:Europe/London
X-WR-CALDESC:
";
$schedule = getschedule();
echo process($schedule);
echo "END:VCALENDAR";
} else {
echo "Error: Bad Authentication";
}

?>
