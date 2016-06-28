<?php
/**
EO Data Resource ~ Ethan Moffat
-- config.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
/*
$server_name (string): Your server's name. Used within the website for display purpose only.
*/
$server_name = "EO Web";
/*
$staff_name (string array): Array of staff members. Used for display on credits page.
*/
$staff_name = array("Ethan Moffat");
/*
$use_cache (bool): 
	Determines behavior of loading functions. If FALSE, then each time data is requested,
	the pub files will be reloaded completely (increases server load).
	TRUE will set the function to only load the values from cached .dat files in the cache folder.
	In order to update changes to your pubs within the site, you will need to either set this to false or
	delete the .dat files located in the cache folder.
*/
$use_cache = TRUE;
/*
$items_per_page (int) : How many items to display on the information/search pages
*/
$items_per_page = 15;

/*
$_gun_item_name (string) : The name of the gun item in your pub file (if using completely custom pubs)
*/
$_gun_item_name = "Gun";
/*
$_gun_item_id (int) : The ID of the gun item in your pub file (if using completely custom pubs)
*/
$_gun_item_id = 365;
/*
I just put these functions in here for shits and giggles. 
Paginate is really the only one that does anything important.
title and paramToString are merely cosmetic.
*/
function title($pageName)
{
$retstring = "";
if($pageName == "index")
	$retstring.="Home Page";
else
	$retstring.=$pageName." Page";

return $retstring;
}

function paramToString($param)
{
  switch($param)
  {
    case "npc": return " - NPC"; break;
    case "armor": return " - Armor"; break;
    case "hats": return " - Hat"; break;
    case "shields": return " - Shield"; break;
    case "weapons": return " - Weapon"; break;
    case "equip": return " - Other Equipment"; break;
    case "items": return " - Other Item"; break;
    case "spells": return " - Spell"; break;
    case "classes": return " - Class"; break;
    case "allItems": return " - All Item"; break;
    default: return " ".$param; break;
  }
}

function paginate($file,$colspan,$search = FALSE)
{
  global $items_per_page;
  if(isset($_GET['page']))
    $page = $_GET['page'];
  else
    $page = 1;
  $sort;
  $type;
  $input;
  $search;
  if(isset($_GET['sort']))
    $sort = $_GET['sort'];
  if(isset($_GET['type']))
    $type = $_GET['type'];
    
  if(isset($_GET['input']))
    $input = $_GET['input'];
  if(isset($_GET['search']))
    $search = $_GET['search'];
    
  $numPages = count($file) / $items_per_page + 1;
  if((count($file) - 1) % $items_per_page == 0)
    $numPages--;
  if($numPages <= 0)
    $numPages = 1;
  $prevPage = $page - 1;
  $nextPage = $page + 1;
  if($nextPage > $numPages)
    $nextPage = 0;
    
  echo "<tr><td colspan=\"$colspan\">";
  
  if($prevPage == 0)
    echo "<<[prev] ";
  else
  {
    if($search == FALSE)
      echo "<a href=\"data.php?type=$type&sort=$sort&page=$prevPage\"><<[prev]</a> ";
    else
      echo "<a href=\"search.php?input=$input&search=$search&page=$prevPage\"><<[prev]</a> ";
  }
    
  for($i = 1; $i <= $numPages; ++$i)
  {
    if($i == $page)
      echo "$i ";
    else
    {
      if($search == FALSE)
        echo "<a href=\"data.php?type=$type&sort=$sort&page=$i\">$i</a> ";
      else
        echo "<a href=\"search.php?input=$input&search=$search&page=$i\">$i</a> ";
    }
  }
  
  if($nextPage == 0)
    echo "[next]>> ";
  else
  {
    if($search == FALSE)
      echo "<a href=\"data.php?type=$type&sort=$sort&page=$nextPage\">[next]>></a> ";
    else
      echo "<a href=\"search.php?input=$input&search=$search&page=$nextPage\">[next]>></a> ";
  }
}
?>