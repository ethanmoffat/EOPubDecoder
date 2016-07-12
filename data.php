<?php
/**
EO Data Resource ~ Ethan Moffat
-- data.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
require("config.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title><?php echo title(paramToString($_GET['type'])); ?></title>
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
<?php require("copyright.php");?>
</div>
<div id="main">
<div class="mainText">
<e class="titlelabel"><?php echo $server_name.paramToString($_GET['type'])." details"; ?></e><p>
<?php
require('eodata.php');
require('loaddat.php');
$type = $_GET['type'];
if(isset($_GET['page']))
  $page = $_GET['page'];
else
  $page = 1;

switch($type)
{
case "npc":
if($use_cache == FALSE)
{
  LoadENF("pub/dtn001.enf");
  LoadCacheENF($_GET['sort'],$page,$items_per_page);
}
else
{
  if(!file_exists("cache/ENF.dat"))
    LoadENF("pub/dtn001.enf");
  LoadCacheENF($_GET['sort'],$page,$items_per_page);
}
break;
case "items":
case "equip":
case "weapons":
case "shields":
case "armor":
case "hats":
case "allItems":
if($use_cache == FALSE)
{
  LoadEIF("pub/dat001.eif");
  LoadCacheEIF($_GET['sort'],$page,$items_per_page,$type);
}
else
{
  if(!file_exists("cache/EIF.dat"))
    LoadEIF("pub/dat001.eif");
  LoadCacheEIF($_GET['sort'],$page,$items_per_page,$type);
}
break;
case "spells": 
if($use_cache == FALSE)
{
  LoadESF("pub/dsl001.esf");
  LoadCacheESF($_GET['sort'],$page,$items_per_page);
}
else
{
  if(!file_exists("cache/ESF.dat"))
    LoadESF("pub/dsl001.esf");
  LoadCacheESF($_GET['sort'],$page,$items_per_page);
}
break;
case "classes": 
if($use_cache == FALSE)
{
  LoadECF("pub/dat001.ecf");
  LoadCacheECF($_GET['sort'],$page,$items_per_page);
}
else
{
  if(!file_exists("cache/ECF.dat"))
    LoadECF("pub/dat001.ecf");
  LoadCacheECF($_GET['sort'],$page,$items_per_page);
}
break;
}
?>
</div>
</div>
</body>
</html>