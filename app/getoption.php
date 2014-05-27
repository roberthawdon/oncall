<?php

function getoption($option) {

global $con, $PATH, $DBHOST, $DBUSER, $DBPASS, $DBNAME;

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query("SELECT * FROM tbl_options where option_name = '$option'") or die("Error: ".mysqli_error($con));

while($row = mysqli_fetch_array($result))
  {
  $optionname = $row['option_name'];
  $optionvalue = $row['option_value'];
  }

return $optionvalue;

}

?>
