<?php

$userid = $_COOKIE['user'];

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query("CALL get_access_keys('$userid')") or die("Error: ".mysqli_error($con));

while($row = mysqli_fetch_array($result))
  {
  $kkeyID = $row['ID'];
  $kuserID = $row['user_ID'];
  $ktoken = $row['token'];
  $kcreated = $row['created'];
  $kexpiry = $row['expiry'];
  $kterminated = $row['terminated'];
  $kcomment = $row['comment'];
  }

foreach ($kkeyID as $index => $key) {
echo "<p>Key ID: " . $key . "<br />Key Value: " . $ktoken[$index] . "</p>";
}



?>
