<?php

$userid = $_COOKIE['user'];

mysqli_select_db($con , $DBNAME) or die("Error: ".mysqli_error($con));

$result = $con->query("CALL get_access_keys('$userid')") or die("Error: ".mysqli_error($con));

while($row = mysqli_fetch_array($result))
  {
  $kkeyID[] = $row['ID'];
  $kuserID[] = $row['user_ID'];
  $ktoken[] = $row['token'];
  $kcreated[] = $row['created'];
  $kexpiry[] = $row['expiry'];
  $kterminated[] = $row['terminated'];
  $kcomment[] = $row['comment'];
  }

foreach ( $kkeyID as $index => $keyID ) {
#echo "<p>Key ID: " . $keyID . "<br />Key Value: " . $ktoken[$index] . "</p>";
echo "<p><img src=\"code/php/qr_img.php?d=http%3A%2F%2Fdev-oncall.op-ezy.co.uk%2F%3Fauth%3D" . $ktoken[$index] . "\" class=\"qrborder\" alt=\"QR Code\" title=\"Scan me with your phone\" /></p>";
}


?>
