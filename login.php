<?php

if (isset($_GET['error'])) {
$error = $_GET['error'];
if ($error == "unauthorized") {
$errormessage = "Error: Unauthorized";
}
}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, target-densityDpi=device-dpi, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/> 
<link rel='stylesheet' id='main'  href='assets/login.css' type='text/css' />
<script type="text/javascript" src="assets/rounded_corners.js"></script>
<title>Who's on call?</title>
</head>
<body>
<form action="main.php" method="post">
        <label>Username:</label>
            <input type="text" name="username" />
        <label>Password:</label>
            <input type="password" name="password"  />
            <?php

if (isset($errormessage)) {
echo "<label class=\"errormessage\">".$errormessage."</label>\n";
}

 ?>
            <input type="submit" value="Submit" name="submit" class="submit" />
</form>  
</body>
</html>
