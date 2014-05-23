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

$valid = checkauth($auth);

if ($valid) {
echo "So far so good";
} else {
echo "Bad auth, so far so good";
}

?>
