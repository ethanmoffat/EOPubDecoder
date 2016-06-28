<?php
/**
EO Data Resource ~ Ethan Moffat
-- loaddat.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
require("sorts.php");

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
  $file;
  try
  {
    if(!file_exists("cache/ECF.dat"))
      throw new Exception("ERROR");
    $file = file("cache/ECF.dat",FILE_IGNORE_NEW_LINES);
  }
  catch (Exception $e)
  {
    LoadECF("pub/dat001.ecf");
    $file = file("cache/ECF.dat",FILE_IGNORE_NEW_LINES);
  }
  if(!isset($file[$num-1]))
    return $num;
  $line = explode(", ",$file[$num-1]);
  
  return $line[1];
}

function LoadCacheENF($sort,$page,$items_per_page)
{
  $file = file("cache/ENF.dat",FILE_IGNORE_NEW_LINES);
  if($_GET['sort'] != "id")
    $file = fileSort($file);
  echo "<table>";
  paginate($file,4);
  print<<<eof
  <tr>
  <th width="50%"><a href="data.php?type=npc&sort=name&page=$page">Name</a>(<a href="data.php?type=npc&sort=id&page=$page">id</a>)</th><th width="25%"><a href="data.php?type=npc&sort=NPCtype&page=$page">Type</a></th><th colspan="2"><a href="data.php?type=npc&sort=NPCstats&page=$page">Stats</a></th>
  </tr>
eof;

  for($counter = ($page-1) * $items_per_page; $counter < ($page-1) * $items_per_page + $items_per_page; ++$counter)
  {
    $line = $file[$counter];
    $line = substr($line,1,strlen($line)-2);
    $linearr = explode(", ",$line);
    if($linearr[1] == "eof")
      break;
    print<<<eof
    <tr align="center">
    <td>$linearr[1]($linearr[0])</td>
    <td>$linearr[2]</td>
    <td>
    <table class="nested">
    <tr class="nested"><td class="nested">HP:</td><td align="right" class="nested">$linearr[3]</td></tr>
    <tr class="nested"><td class="nested">MinDam:</td><td align="right" class="nested">$linearr[4]</td></tr>
    <tr class="nested"><td class="nested">MaxDam:</td><td align="right" class="nested">$linearr[5]</td></tr>
    <tr class="nested"><td class="nested">Accuracy:</td><td align="right" class="nested">$linearr[6]</td></tr>
    <tr class="nested"><td class="nested">Evade:</td><td align="right" class="nested">$linearr[7]</td></tr>
    <tr class="nested"><td class="nested">Armor:</td><td align="right" class="nested">$linearr[8]</td></tr>
    <tr class="nested"><td class="nested">Exp:</td><td align="right" class="nested">$linearr[9]</td></tr>
    </table>
    </td>
    </tr>
eof;
    if(!isset($file[$counter + 1]))
      break;
  }  
  paginate($file,4);
  echo "</table>";
}
function LoadCacheECF($sort,$page,$items_per_page)
{
  $file = file("cache/ECF.dat",FILE_IGNORE_NEW_LINES);
  if($_GET['sort'] != "id")
    $file = fileSort($file);
  echo "<table>";
  paginate($file,3);
  print<<<eof
  <tr>
  <th width="50%"><a href="data.php?type=classes&sort=name&page=$page">Name</a>(<a href="data.php?type=classes&sort=id&page=$page">id</a>)</th><th width="15%"><a href="data.php?type=classes&sort=classBase&page=$page">Base Class</a></th><th><a href="data.php?type=classes&sort=classStats&page=$page">Stats</a></th>
  </tr>
eof;

  for($counter = ($page-1) * $items_per_page; $counter < ($page-1) * $items_per_page + $items_per_page; ++$counter)
  {
    $line = $file[$counter];
    $line = substr($line,1,strlen($line)-2);
    $linearr = explode(", ",$line);
    if($linearr[1] == "eof")
      break;
    print<<<eof
    <tr align="center">
    <td>$linearr[1]($linearr[0])</td>
    <td>$linearr[2]</td>
    <td>
    <table class="nested">
    <tr class="nested"><td class="nested">Strength:</td><td align="right" class="nested">$linearr[3]</td></tr>
    <tr class="nested"><td class="nested">Intelligence:</td><td align="right" class="nested">$linearr[4]</td></tr>
    <tr class="nested"><td class="nested">Wisdom:</td><td align="right" class="nested">$linearr[5]</td></tr>
    <tr class="nested"><td class="nested">Agility:</td><td align="right" class="nested">$linearr[6]</td></tr>
    <tr class="nested"><td class="nested">Constitution:</td><td align="right" class="nested">$linearr[7]</td></tr>
    <tr class="nested"><td class="nested">Charisma:</td><td align="right" class="nested">$linearr[8]</td></tr>
    </table>
    </td>
    </tr>
eof;
    if(!isset($file[$counter + 1]))
      break;
  }  
  paginate($file,3);
  
  echo "</table>";
}
function LoadCacheESF($sort,$page,$items_per_page)
{
  $file = file("cache/ESF.dat",FILE_IGNORE_NEW_LINES);
  if($_GET['sort'] != "id")
    $file = fileSort($file);
  echo "<table>";
  paginate($file,4);
  print<<<eof
  <tr>
  <th><a href="data.php?type=spells&sort=name&page=$page">Name</a>(<a href="data.php?type=spells&sort=id&page=$page">id</a>)</th><th><a href="data.php?type=spells&sort=spellCost&page=$page">TP/SP cost</a></th><th>Targets</th><th colspan="2"><a href="data.php?type=spells&sort=spellStats&page=$page">Stats</a></th>
  </tr>
eof;

  for($counter = ($page-1) * $items_per_page; $counter < ($page-1) * $items_per_page + $items_per_page; ++$counter)
  {
    $line = $file[$counter];
    $line = substr($line,1,strlen($line)-2);
    $linearr = explode(", ",$line);
    if($linearr[1] == "eof")
      break;
    print<<<eof
    <tr align="center">
    <td>$linearr[1]($linearr[0])</td>
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">SP: </td>
          <td align="right" class="nested">$linearr[2]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">TP: </td>
          <td align="right" class="nested">$linearr[3]</td>
        </tr>
      </table>
    </td>
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">Type:</td>
          <td align="right" class="nested">$linearr[4]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Restrict:</td>
          <td align="right" class="nested">$linearr[5]</td>
        </tr>
        <tr class="nested">
          <td width="50%" class="nested">Target:</td>
          <td align="right" class="nested">$linearr[6]</td>
        </tr>
      </table>
    </td>  
    <td valign="top">
      <table class="nested">
        <tr class="nested">
          <td width="50%" class="nested">MinDam:</td>
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
          <td width="50%" class="nested">HP (heal):</td>
          <td align="right" class="nested">$linearr[10]</td>
        </tr>
      </table>
    </td>
    </tr>
eof;
    if(!isset($file[$counter + 1]))
      break;
  }  
  paginate($file,4);
  
  echo "</table>";
}
function LoadCacheEIF($sort,$page,$items_per_page,$type)
{
  $file = file("cache/EIF.dat",FILE_IGNORE_NEW_LINES);
  
  if($type != "allItems")
    $file = filter($file,$type);
  if(count($file) <= 0)
    exit("Error: No results.");
  if($_GET['sort'] != "id")
    $file = fileSort($file);
  echo "<table>";
  paginate($file,4);
  print<<<eof
  <tr>
    <th width="30%"><a href="data.php?type=$type&sort=name&page=$page">Name</a>(<a href="data.php?type=$type&sort=id&page=$page">id</a>)</th>
    <th width="25%">Types / Special</th>
    <th><a href="data.php?type=$type&sort=itemStats&page=$page">Stats</a></th>
    <th width="20%"><a href="data.php?type=$type&sort=itemReqs&page=$page">Requirements</a></th>
  </tr>
eof;

  for($counter = ($page-1) * $items_per_page; $counter < ($page-1) * $items_per_page + $items_per_page; ++$counter)
  {
    $line = $file[$counter];
    $line = substr($line,1,strlen($line)-2);
    $linearr = explode(", ",$line);
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
    if(!isset($file[$counter + 1]))
      break;
  }  
  paginate($file,4);
  echo "</table>";  
}
?>