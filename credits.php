<?php
/**
EO Data Resource ~ Ethan Moffat
-- credits.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
require("config.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title><?php echo title("Credits"); ?></title>
</head>
<body>
<div id="topmenu">
<div style="padding:8px;font-size:30px">
<?php echo $server_name." Data Resource"; ?>
</div>
</div>
<div id="leftmenu">
<?php require("menu.php");?>
</div>
<div id="credit">
(c) Ethan Moffat 2011
</div>
<div id="main">
<div class="mainText">
<e class="titlelabel">Application Credits</e><p>
<?php echo $server_name." development - "; for($i = 0; $i < count($staff_name)-1; ++$i) echo $staff_name[$i].", "; echo $staff_name[count($staff_name)-1]; ?><br>
Endless Online - <a href="http://www.endless-online.com/developers.html" target="_blank">Developer List</a><br>
Application - Ethan Moffat (<a href="https://www.github.com/ethanmoffat" target="_blank">GitHub profile</a>)<br>
</div>
</div>
</body>
</html>