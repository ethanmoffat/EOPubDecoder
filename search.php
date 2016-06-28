<?php
/**
EO Data Resource ~ Ethan Moffat
-- search.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
class PUBS
{
  static function Search($file,$expr)
  {
    $expr = strtolower($expr);
    $result = array();
    foreach($file as $line)
    {
      $linestr = explode(", ",$line);
      if($expr == substr(strtolower($linestr[1]),0,strlen($expr)) || strpos(strtolower($linestr[1]),$expr) != FALSE)
        array_push($result,$line);
    }
    return $result;
  }
}
function HairColor($num)
{
  switch($num)
  {
    case 0: return "Brown";
    case 1: return "Green";
    case 2: return "Pink";
    case 3: return "Red";
    case 4: return "Blonde";
    case 5: return "Blue";
    case 6: return "Purple";
    case 7: return "Luna";
    case 8: return "White";
    case 9: return "Black";
    default: return "ERROR";
  }
}

function ClassName($num)
{
  $file = file("cache/ECF.dat",FILE_IGNORE_NEW_LINES) or exit("Class File not loaded yet. Please visit class page.");
  if(!isset($file[$num-1]))
    return $num;
  $line = explode(", ",$file[$num-1]);
  
  return $line[1];
}
require("config.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title><?php echo title($_GET['input']." - Search results"); ?></title>
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
<e class="titlelabel">Search results: <?php echo $_GET['input']; ?></e><p>
<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$expr = $_GET['input'];
$_searchType = $_GET['search'];

//search for $expr in the selected file
$res = array();

if($_searchType == "none")
{
  exit("Please select a search type.");
}

if($_searchType == "ECF")
  $res = PUBS::Search(file("cache/ECF.dat",FILE_IGNORE_NEW_LINES),$expr);
elseif($_searchType == "ENF")
  $res = PUBS::Search(file("cache/ENF.dat",FILE_IGNORE_NEW_LINES),$expr);
elseif($_searchType == "ESF")
  $res = PUBS::Search(file("cache/ESF.dat",FILE_IGNORE_NEW_LINES),$expr);
elseif($_searchType == "EIF")
  $res = PUBS::Search(file("cache/EIF.dat",FILE_IGNORE_NEW_LINES),$expr);
  
if($_searchType == "ENF" && count($res) > 0)
{
?>
<!--NPC Results-->
<table>
  <tr>
    <th colspan="4">NPC Results</th>
  </tr>
  <?php paginate($res,4,TRUE); ?>
  <tr>
    <th width="50%">Name(id)</th>
    <th width="25%">Type</th>
    <th colspan="2">Stats</th>
  </tr>
  <?php
    for($i = ($page - 1)*$items_per_page; $i < ($page-1) *  $items_per_page + $items_per_page; $i++)
    {
    $result = explode(", ",substr($res[$i],1,count($res[$i])-2));
    if($result[1] == "eof")
      break;
    print<<<eof
    <tr align="center">
    <td>$result[1]($result[0])</td>
    <td>$result[2]</td>
    <td>
    <table class="nested">
    <tr class="nested"><td class="nested">HP:</td><td align="right" class="nested">$result[3]</td></tr>
    <tr class="nested"><td class="nested">MinDam:</td><td align="right" class="nested">$result[4]</td></tr>
    <tr class="nested"><td class="nested">MaxDam:</td><td align="right" class="nested">$result[5]</td></tr>
    <tr class="nested"><td class="nested">Accuracy:</td><td align="right" class="nested">$result[6]</td></tr>
    <tr class="nested"><td class="nested">Evade:</td><td align="right" class="nested">$result[7]</td></tr>
    <tr class="nested"><td class="nested">Armor:</td><td align="right" class="nested">$result[8]</td></tr>
    <tr class="nested"><td class="nested">Exp:</td><td align="right" class="nested">$result[9]</td></tr>
    </table>
    </td>
    </tr>
eof;
    if(!isset($res[$i+1]))
      break;
    }
  paginate($res,4,TRUE);
  ?>
</table>
<p>
<?php
}
elseif($_searchType == "ESF" && count($res) > 0)
{
?>
<!--Spell Results-->
<table>
  <tr>
    <th colspan="5">Spell Results</th>
  </tr>
  <?php paginate($res,4,TRUE); ?>
  <tr>
    <th>Name(id)</th>
    <th>TP/SP cost</th>
    <th>Targets</th>
    <th colspan="2">Stats</th>
  </tr>
  <?php
    for($i = ($page - 1)*$items_per_page; $i < ($page-1) *  $items_per_page + $items_per_page; $i++)
    {
    $result = explode(", ",substr($res[$i],1,count($res[$i])-2));
    print<<<eof
    <tr align="center">
    <td>$result[1]($result[0])</td>
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">SP: </td>
          <td align="right" class="nested">$result[2]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">TP: </td>
          <td align="right" class="nested">$result[3]</td>
        </tr>
      </table>
    </td>
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">Type:</td>
          <td align="right" class="nested">$result[4]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Restrict:</td>
          <td align="right" class="nested">$result[5]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Target:</td>
          <td align="right" class="nested">$result[6]</td>
        </tr>
      </table>
    </td>  
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">MinDam:</td>
          <td align="right" class="nested">$result[7]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">MaxDam:</td>
          <td align="right" class="nested">$result[8]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Accuracy:</td>
          <td align="right" class="nested">$result[9]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">HP (heal):</td>
          <td align="right" class="nested">$result[10]</td>
        </tr>
      </table>
    </td>
    </tr>
eof;
    }
    paginate($res,4,TRUE);
  ?>
</table>
<p>
<?php
}
elseif($_searchType == "ECF" && count($res) > 0)
{
?>
<!--Class Results-->
<table>
  <tr>
    <th colspan="3">Class Results</th>
  </tr>
  <?php paginate($res,3,TRUE); ?>
  <tr>
    <th>Name(id)</th>
    <th>Base Class</th>
    <th>Stats</th>
  </tr>
  <?php
    for($i = ($page - 1)*$items_per_page; $i < ($page-1) *  $items_per_page + $items_per_page; $i++)
    {
    $result = explode(", ",substr($res[$i],1,count($res[$i])-2));
    if($result[1] == "eof")
      break;
    print<<<eof
    <tr align="center">
    <td>$result[1]($result[0])</td>
    <td>$result[2]</td>
    <td>
    <table class="nested">
    <tr class="nested"><td class="nested">Strength:</td><td align="right" class="nested">$result[3]</td></tr>
    <tr class="nested"><td class="nested">Intelligence:</td><td align="right" class="nested">$result[4]</td></tr>
    <tr class="nested"><td class="nested">Wisdom:</td><td align="right" class="nested">$result[5]</td></tr>
    <tr class="nested"><td class="nested">Agility:</td><td align="right" class="nested">$result[6]</td></tr>
    <tr class="nested"><td class="nested">Constitution:</td><td align="right" class="nested">$result[7]</td></tr>
    <tr class="nested"><td class="nested">Charisma:</td><td align="right" class="nested">$result[8]</td></tr>
    </table>
    </td>
    </tr>
eof;
    if(!isset($res[$i+1]))
      break;
    }
    paginate($res,3,TRUE);
  ?>
</table>
<p>
<?php
}
elseif($_searchType == "EIF" && count($res) > 0)
{
?>
<!--Item Results-->
<table>
  <tr>
    <th colspan="4">Item Results</th>
  </tr>
  <?php paginate($res,4,TRUE); ?>
  <tr>
    <th width="30%">Name (id)</th>
    <th width="25%">Types / Special</th>
    <th>Stats</th>
    <th width="20%">Requirements</th>
  </tr>
  <?php
    for($i = ($page - 1)*$items_per_page; $i < ($page-1) *  $items_per_page + $items_per_page; $i++)
    {
    $linearr = explode(", ",substr($res[$i],1,count($res[$i])-2));
    if($linearr[1] == "eof")
      break;
    print<<<eof
    <tr align="center">
    <td>$linearr[1]($linearr[0])</td>
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">Type: </td>
          <td align="right" class="nested">$linearr[2]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Subtype: </td>
          <td align="right" class="nested">$linearr[3]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Special: </td>
          <td align="right" class="nested">$linearr[4]</td>
        </tr>
eof;
      if($linearr[2] == "Teleport")
      {
        print<<<eod
        <tr class="nested">
          <td width="50%" class="nested">Scroll Map:</td>
          <td align="right" class="nested">$linearr[18]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Scroll X:</td>
          <td align="right" class="nested">$linearr[19]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Scroll Y:</td>
          <td align="right" class="nested">$linearr[20]</td>
        </tr>
eod;
      }
      elseif($linearr[2] == "EffectPotion")
      {
        print<<<eof
        <tr class="nested">
          <td width="50%" class="nested">Effect:</td>
          <td align="right" class="nested">$linearr[18]</td>
        </tr>
eof;
      }
      elseif($linearr[2] == "EXPReward")
      {
        print<<<eod
        <tr class="nested">
          <td width="50%" class="nested">EXP: </td>
          <td align="right" class="nested">$linearr[18]</td>
        </tr>
eod;
      }
      elseif($linearr[2] == "HairDye")
      {
        echo "<tr class=\"nested\"><td width=\"50%\" class=\"nested\">Hair: </td><td align=\"right\" class=\"nested\">";
        echo HairColor($linearr[18]);
        echo "</td></tr>";
      }
      elseif($linearr[2] == "Armor")
      {      
        echo "<tr class=\"nested\"><td width=\"50%\" class=\"nested\">Gender: </td><td align=\"right\" class=\"nested\">";
        if($linearr[19] == "0")
          echo "Female";
        else
          echo "Male";
        echo "</td></tr>";
      }
    print<<<eof
        <tr class="nested">
          <td width="50%" class="nested">Weight: </td>
          <td align="right" class="nested">$linearr[29]</td>
        </tr>
      </table>
    </td>
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">HP: </td>
          <td align="right" class="nested">$linearr[5]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">TP: </td>
          <td align="right" class="nested">$linearr[6]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">MinDam: </td>
          <td align="right" class="nested">$linearr[7]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">MaxDam:</td>
          <td align="right" class="nested">$linearr[8]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Accuracy:</td>
          <td align="right" class="nested">$linearr[9]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Evade:</td>
          <td align="right" class="nested">$linearr[10]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Armor:</td>
          <td align="right" class="nested">$linearr[11]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Strength: </td>
          <td align="right" class="nested">$linearr[12]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Intelligence: </td>
          <td align="right" class="nested">$linearr[13]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Wisdom: </td>
          <td align="right" class="nested">$linearr[14]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Agility:</td>
          <td align="right" class="nested">$linearr[15]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Constitution:</td>
          <td align="right" class="nested">$linearr[16]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Charisma:</td>
          <td align="right" class="nested">$linearr[17]</td>
        </tr>
      </table>
    </td>
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">Level:</td>
          <td align="right" class="nested">$linearr[21]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Class:</td>
          <td align="right" class="nested">
eof;
          echo ClassName($linearr[22]);
print<<<eof
          </td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Strength:</td>
          <td align="right" class="nested">$linearr[23]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Intelligence:</td>
          <td align="right" class="nested">$linearr[24]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Wisdom: </td>
          <td align="right" class="nested">$linearr[25]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Agility:</td>
          <td align="right" class="nested">$linearr[26]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Constitution:</td>
          <td align="right" class="nested">$linearr[27]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Charisma:</td>
          <td align="right" class="nested">$linearr[28]</td>
        </tr>
      </table>
    </td>
    </tr>
eof;
    }
    paginate($res,4,TRUE);
  ?>
</table>
<?php } 
elseif(count($res) == 0)
  echo "No results found.";
?>
</div>
</div>
</body>
</html>