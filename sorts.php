<?php
/**
EO Data Resource ~ Ethan Moffat
-- sorts.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
function fileSort($file)
{
  $n = count($file);
  if($n == 1)
    return $file;
  
  $l1 = array_slice($file,0,$n / 2);
  $l2 = array_slice($file,$n / 2);
  
  $l1 = fileSort($l1);
  $l2 = fileSort($l2);
  
  return fileMerge($l1,$l2,$_GET['sort']);
}

function fileMerge($a,$b,$sort)
{
  $c = array();
  while(count($a) > 0 && count($b) > 0)
  {
    $temp = substr($a[0],1,strlen($a[0]) - 2);
    $aLine = explode(", ",$temp);
    $temp = substr($b[0],1,strlen($b[0]) - 2);
    $bLine = explode(", ",$temp);
    if($sort == "name")
    {
      $aLine = $aLine[1];
      $bLine = $bLine[1];
    }
    elseif($sort == "NPCtype")
    {
      $aLine = $aLine[2];
      $bLine = $bLine[2];
    }
    elseif($sort == "NPCstats" || $sort == "classStats")
    {
      $sum = (int)$aLine[3] + (int)$aLine[4] + (int)$aLine[5] + (int)$aLine[6] + (int)$aLine[7] + (int)$aLine[8];
      $aLine = 0-(int)$sum;
      $sum = (int)$bLine[3] + (int)$bLine[4] + (int)$bLine[5] + (int)$bLine[6] + (int)$bLine[7] + (int)$bLine[8];
      $bLine = 0-(int)$sum;
    }
    elseif($sort == "classBase")
    {
      $aLine = 0-(int)$aLine[2];
      $bLine = 0-(int)$bLine[2];
    }
    elseif($sort == "spellStats")
    {
      $sum = (int)$aLine[7] + (int)$aLine[8] + (int)$aLine[9] + (int)$aLine[10];
      $aLine = 0-(int)$sum;
      $sum = (int)$bLine[7] + (int)$bLine[8] + (int)$bLine[9] + (int)$bLine[10];
      $bLine = 0-(int)$sum;
    }
    elseif($sort == "spellCost")
    {
      $sum = (int)$aLine[2] + (int)$aLine[3];
      $aLine = 0-(int)$sum;
      $sum = (int)$bLine[2] + (int)$bLine[3];
      $bLine = 0-(int)$sum;
    }
    elseif($sort == "itemStats")
    {
      $sum = (int)$aLine[5] + (int)$aLine[6] + (int)$aLine[7] + (int)$aLine[8] + (int)$aLine[9] + (int)$aLine[10] + (int)$aLine[11] + (int)$aLine[12] + (int)$aLine[13] + (int)$aLine[14] + (int)$aLine[15] + (int)$aLine[16] + (int)$aLine[17];
      $aLine = 0-(int)$sum;
      $sum = (int)$bLine[5] + (int)$bLine[6] + (int)$bLine[7] + (int)$bLine[8] + (int)$bLine[9] + (int)$bLine[10] + (int)$bLine[11] + (int)$bLine[12] + (int)$bLine[13] + (int)$bLine[14] + (int)$bLine[15] + (int)$bLine[16] + (int)$bLine[17];
      $bLine = 0-(int)$sum;
    }
    elseif($sort == "itemReqs")
    {
      $sum = (int)$aLine[21] + (int)$aLine[22] + (int)$aLine[23] + (int)$aLine[24] + (int)$aLine[25] + (int)$aLine[26] + (int)$aLine[27] + (int)$aLine[28];
      $aLine = 0-(int)$sum;
      $sum = (int)$bLine[21] + (int)$bLine[22] + (int)$bLine[23] + (int)$bLine[24] + (int)$bLine[25] + (int)$bLine[26] + (int)$bLine[27] + (int)$bLine[28];
      $bLine = 0-(int)$sum;
    }
    
    if($aLine > $bLine)
    {
      array_push($c,$b[0]);
      $b = array_slice($b,1);
    }
    else
    {
      array_push($c,$a[0]);
      $a = array_slice($a,1);
    }
  }
  while(count($a) > 0)
  {
    array_push($c,$a[0]);
    $a = array_slice($a,1);
  }
  while(count($b) > 0)
  {
    array_push($c,$b[0]);
    $b = array_slice($b,1);
  }
  
  return $c;
}

function filter($file,$type)
{
  switch($type)
  {//case is the $_GET value, switches type to the one read into the .dat file
    case "armor": $type = "Armor"; break;
    case "weapons": $type = "Weapon"; break;
    case "shields": $type = "Shield"; break;
    case "hats": $type = "Hat"; break;
    case "items": $type = "StaticUnknownMoneyHealTeleportSpellEXPRewardStatRewardSkillRewardKeyBeerHairDyeEffectPotionCureCurse"; break;
    case "equip": $type = "BootsGlovesAccessoryBeltNecklaceRingArmletBracer"; break;
    default: exit("Error in filter($file,$type); contact webmaster");
  }
  $return = array();
  for($i = 0; $i < count($file); ++$i)
  {
    $line = explode(", ",$file[$i]);
    if($line[1] == "eof")
      break;
    if(strpos($type,$line[2]) != FALSE || $line[2] == $type)
      array_push($return,$file[$i]);
    if(!isset($file[$i+1]))
      break;
  }
  
  return $return;
}

?>