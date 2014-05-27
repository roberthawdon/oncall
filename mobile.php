<!-- Who's on call? -->

<?php

include "app/getcalldata.php";

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, target-densityDpi=device-dpi, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel='stylesheet' id='reset'  href='assets/reset.css' type='text/css' media='all' />
<link rel='stylesheet' id='main'  href='assets/oncall_mobile.css' type='text/css' />
<?php include_once "assets/favicon.php"; ?>
<title>Who's on call?</title>
</head>
<body>
<div id="page">
<div id="top">
<img src="assets/logo.png" width="96" height="46" alt="Bede Gaming" title="Bede Gaming" />
<h1>Who's on call?</h1>
</div>
<div id="oncall">
<img src="uploads/<?php print $avatar ?>" width="80px" height="80px" alt="<?php print $fullname ?>" />
<p><?php print $fullname ?> is currently on call</p>
<div class="actions">
<p><a href="callto:<?php print $phone ?>" class="button-link button-colour-main">Phone</a></p>
<p><a href="sms:<?php print $phone ?>" class="button-link button-colour-main">SMS</a></p>
<p><a href="mailto:<?php print $email ?>" class="button-link button-colour-main">E-Mail</a></p>
<!--<form action="tel:<?php print $phone ?>">
<div>
<input id="sitebutton" type="submit" value="Call">
</div>
</form>
<form action="sms:<?php print $phone ?>" method="post">
<div>
<input id="sitebutton" type="submit" value="SMS">
</div>
</form>
<form action="mailto:<?php print $email ?>">
<div>
<input id="sitebutton" type="submit" value="E-Mail">
</div>
</form>-->
<p>Note: Only escalate to <?php print $firstname ?> in the event of major site issues.<br />For non urgent issues, please file a support ticket to support@bedegaming.zendesk.com.</p>
<p><a href="#" class="button-link button-colour-alt">Zendesk</a></p>
</div>
</div>
<p><a href="#" class="button-link button-colour-main">View on call schedule</a></p>
<!--<input id="sitebutton" type="button" value="View on call schedule">-->
</div>
<div id="footer">
<p>Who's On Call? V. <?php echo $version?><br />&copy; 2014 <a href="http://robertianhawdon.me.uk">Robert Hawdon</a> - Bede Gaming Ltd.</p>
</div>
</html>
