<?php
/**
EO Data Resource ~ Ethan Moffat
-- index.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
require("config.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title><?php echo title("index"); ?></title>
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
Data resource application for reading data directly from EOSERV pub files, and displaying the data in a web site.
<!-- Home page for your data resource site -->
</div>
</div>
</body>
</html>