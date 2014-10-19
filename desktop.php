<?php

include "app/getcalldata.php";
include "app/getauthdata.php";

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<link rel='stylesheet' id='reset'  href='assets/reset.css' type='text/css' media='all' />
<link rel='stylesheet' id='main'  href='assets/oncall.css' type='text/css' />
<script type="text/javascript" src="assets/rounded_corners.js"></script>
<script type="text/javascript" src="assets/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
  //hide the all of the element with class keys_body
  $(".keys_body").hide();
  //toggle the componenet with class keys_body
  $(".keys_head").click(function()
  {
    $(this).next(".keys_body").slideToggle(600);
  });
});
</script>
<?php include_once "assets/favicon.php"; ?>
<title><?php print $fullname ?> is currently on call</title>
</head>
<body>
<div id="page">
<div id="top">
<img src="assets/logo.png" alt="<?php echo getoption("organisation")?>" title="<?php echo getoption("organisation")?>" />
<h1>Who's on call?</h1>
</div>
<div id="oncall">
<canvas id="OnCallWindow" width="800" height="220" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.</canvas>

<script>

OnCallWindow.style.border = "none";

var c=document.getElementById("OnCallWindow");
var ctx=c.getContext("2d");

ctx.strokeStyle = "rgba(0, 0, 0, 0)";
var grd=ctx.createLinearGradient(0,0,0,200);
grd.addColorStop(0,"#c7c7ff");
grd.addColorStop(1,"#7e7eff");
ctx.fillStyle = grd;

var grd=roundRect(ctx, 10, 10, 780, 200, 50, true);

var imgFace=c.getContext("2d");
var img = new Image();
img.src = "//www.gravatar.com/avatar/<?php print $emailmd5 ?>?s=160&d=mm"
img.onload = function () {
   imgFace.beginPath();
   imgFace.arc(200, 110, 80, 0, 2*Math.PI, true);
   imgFace.clip();
   imgFace.drawImage(img,120,30);
   imgFace.arc(200, 110, 80, 0, 2*Math.PI, true);
   imgFace.strokeStyle = '#a7a7ff';
   imgFace.lineWidth = 5;
   imgFace.stroke();
}

var lblName=c.getContext("2d");
lblName.font = "34px Arial";
lblName.fillStyle = "#000000";
lblName.fillText('<?php print $fullname ?>',400,100);

var lblOnCall=c.getContext("2d");
lblOnCall.font = "30px Arial";
lblOnCall.fillStyle = "#000000";
lblOnCall.fillText('is currently on call',400,140);

</script>

<div class="actions">
<p><a href="<?php echo "mailto:".getoption("support_email"); ?>" class="button-link button-colour-alt" data-rel="external">Submit a support ticket to Operations</a> <a href="<?php echo "mailto:".getoption("escalate_email"); ?>" class="button-link button-colour-red" data-rel="external">Escalate to on call*</a></p>
<p>Note: Please only escalate to <?php print $firstname ?> in the event of major site issues.<br />For non urgent issues, please use file a regular support ticket.</p>
<p>Should you require to contact <?php print $firstname ?> directly, you can use the following details:</p>
<p><a href="callto:<?php print $phone ?>" class="button-link button-colour-main" data-rel="external"><?php print $phone ?></a> <a href="mailto:<?php print $email ?>" class="button-link button-colour-main" data-rel="external"><?php print $email ?></a></p>
</div>
</div>
<!--<img src="code/php/qr_img.php?d=Testing+dynamic+QR+generation" class="qrborder" alt="QR Code" title="Scan me with your phone" />
<p>Scan the QR code to access this page directly from your phone.</p><br />-->
<!--<p>You have 0 access keys. You'll need to generate one to access the Mobile interface, the calendar feed, or the API</p>-->
<p class="keys_head button-link button-colour-main">Access Keys</p>
<div class="keys_body">
<p>Your access keys:</p>
<?php include "app/userkeys.php"; ?>
<p><a href="#" class="button-link button-colour-main">Generate</a></p>
</div>
<p><a href="#" class="button-link button-colour-main">View on call schedule</a></p>
</div>
<div id="footer">
<p>&quot;Who's On Call?&quot; Version <?php echo $version?> &copy; 2014 <a href="http://robertianhawdon.me.uk">Robert Hawdon</a> - Bede Gaming Ltd.</p>
<p>Best viewed with any modern browser</p>
<p><a href="?action=logout">Logout</a><?php # if ($staff == "1") { echo " | <a href=\"#\">Admin</a>"; }?></p>
</div>
</html>
