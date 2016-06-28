<?php
/**
EO Data Resource ~ Ethan Moffat
-- eodata.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
require("EOStuff.class.php");
//Class that encapsulates built in functions
//Assists with reading binary pub files
class BinFile
{
  var $file;
  
  public function __construct($path)
  {
    try
    {
      $this->file = fopen($path,"rb");
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
    }
  }
  
  public function ReadBytes($num)
  {
    $arr = unpack("C$num",fread($this->file,$num));
    return $arr;
  }
  
  public function ReadString($len)
  {
    return fread($this->file,$len);
  }
  
  public function Seek($length)
  {
    for($i = 0; $i < $length; ++$i)
      fgetc($this->file);
  }
  
  public function Close()
  {
    fclose($this->file);
  }
  
  public function Concat($s1, $s2)
  {
    return $s1.$s2;
  }
}

//Function that loads data directly from ENF file
//Stores loaded data in cache file
function LoadENF($fileName)
{
  $ENF = new BinFile($fileName);
  
  $outFile = fopen("cache/ENF.dat","w+");  
  
  $ENF->Seek(3);
  $rid = $ENF->ReadBytes(4);
  $len = $ENF->ReadBytes(2);
  
  $numobj = EOStuff::Number($len[1],$len[2]);
  $ENF->Seek(1);
  
  for($i = 1; $i <= $numobj; ++$i)
  {
    $namesize = $ENF->ReadBytes(1);
    $namesize[1] = EOStuff::Number($namesize[1]);
    $npcName = $ENF->ReadString($namesize[1]);
    $buf = $ENF->ReadBytes(EOStuff::ENF_SIZE);
    
    $type = EOStuff::NPCType(EOStuff::Number($buf[8],$buf[9]));
    $hp = EOStuff::Number($buf[12],$buf[13],$buf[14]);
    $mindam = EOStuff::Number($buf[17],$buf[18]);
    $maxdam = EOStuff::Number($buf[19],$buf[20]);
    $accuracy = EOStuff::Number($buf[21],$buf[22]);
    $evade = EOStuff::Number($buf[23],$buf[24]);
    $armor = EOStuff::Number($buf[25],$buf[26]);
    $exp = EOStuff::Number($buf[37],$buf[38]);
    
    fputs($outFile,"[$i, ");
    fputs($outFile,"$npcName, ");
    fputs($outFile,"$type, ");
    fputs($outFile,"$hp, $mindam, $maxdam, ");
    fputs($outFile,"$accuracy, $evade, $armor, $exp");
    fputs($outFile,"]\n");
  }
  
  fclose($outFile);
  $ENF->Close();
}

function LoadEIF($fileName)
{
  global $_gun_item_id;
  global $_gun_item_name;
  $EIF = new BinFile($fileName);
  
  $outFile = fopen("cache/EIF.dat","w+");
  
  $EIF->Seek(3);
  $rid = $EIF->ReadBytes(4);
  $len = $EIF->ReadBytes(2);
  
  $numobj = EOStuff::Number($len[1],$len[2]);
  $EIF->Seek(1);
  
  for($i = 1; $i <= $numobj; ++$i)
  {
    $namesize = $EIF->ReadBytes(1);
    $namesize[1] = EOStuff::Number($namesize[1]);
    $itemName = $EIF->ReadString($namesize[1]);
    
    $buf = $EIF->ReadBytes(EOStuff::EIF_SIZE);
    
    $type = EOStuff::ItemType(EOStuff::Number($buf[3]));
    $subtype = EOStuff::ItemSubType(EOStuff::Number($buf[4]));
    if($i == $_gun_item_id && $itemName == $_gun_item_name)
      $subtype = EOStuff::ItemSubType(1);
    $special = EOStuff::ItemSpecial(EOStuff::Number($buf[5]));
    
    $hp = EOStuff::Number($buf[6],$buf[7]);
    $tp = EOStuff::Number($buf[8],$buf[9]);
    $mindam = EOStuff::Number($buf[10],$buf[11]);
    $maxdam = EOStuff::Number($buf[12],$buf[13]);
    
    $accuracy = EOStuff::Number($buf[14],$buf[15]);
    $evade = EOStuff::Number($buf[16],$buf[17]);
    $armor = EOStuff::Number($buf[18],$buf[19]);
    
    $str = EOStuff::Number($buf[21]);
    $int = EOStuff::Number($buf[22]);
    $wis = EOStuff::Number($buf[23]);
    $agi = EOStuff::Number($buf[24]);
    $con = EOStuff::Number($buf[25]);
    $cha = EOStuff::Number($buf[26]);
    
    $scrollmap = EOStuff::Number($buf[33],$buf[34],$buf[35]);
    $scrollx = EOStuff::Number($buf[36]);
    $scrolly = EOStuff::Number($buf[37]);
    
    $levelreq = EOStuff::Number($buf[38],$buf[39]);
    $classreq = EOStuff::Number($buf[40],$buf[41]);
    
    $strreq = EOStuff::Number($buf[42],$buf[43]);
    $intreq = EOStuff::Number($buf[44],$buf[45]);
    $wisreq = EOStuff::Number($buf[46],$buf[47]);
    $agireq = EOStuff::Number($buf[48],$buf[49]);
    $conreq = EOStuff::Number($buf[50],$buf[51]);
    $chareq = EOStuff::Number($buf[52],$buf[53]);
    
    $weight = EOStuff::Number($buf[56]);
    
    fputs($outFile,"[$i, ");
    fputs($outFile,"$itemName, ");
    fputs($outFile,"$type, $subtype, $special, ");
    fputs($outFile,"$hp, $tp, $mindam, $maxdam, ");
    fputs($outFile,"$accuracy, $evade, $armor, ");
    fputs($outFile,"$str, $int, $wis, $agi, $con, $cha, ");
    fputs($outFile,"$scrollmap, $scrollx, $scrolly, ");
    fputs($outFile,"$levelreq, $classreq, ");
    fputs($outFile,"$strreq, $intreq, $wisreq, $agireq, $conreq, $chareq, ");
    fputs($outFile,"$weight");
    fputs($outFile,"]\n");
  }
  
  fclose($outFile);
  $EIF->Close();
}

function LoadESF($fileName)
{
  $ESF = new BinFile($fileName);
  
  $outFile = fopen("cache/ESF.dat","w+");
  
  $ESF->Seek(3);
  $rid = $ESF->ReadBytes(4);
  $len = $ESF->ReadBytes(2);
  
  $numobj = EOStuff::Number($len[1],$len[2]);
  $ESF->Seek(1);
  
  for($i = 1; $i <= $numobj; ++$i)
  {
    $namesize = $ESF->ReadBytes(1);
    $shoutsize = $ESF->ReadBytes(1);
    $namesize[1] = EOStuff::Number($namesize[1]);
    $shoutsize[1] = EOStuff::Number($shoutsize[1]);
    if($namesize[1] == 0 || $shoutsize[1] == 0)
      break;
    $spellName = $ESF->ReadString($namesize[1]);
    $spellShout = $ESF->ReadString($shoutsize[1]);
    
    $buf = $ESF->ReadBytes(EOStuff::ESF_SIZE);
    
    $tp = EOStuff::Number($buf[5],$buf[6]);
    $sp = EOStuff::Number($buf[7],$buf[8]);
    
    $type = EOStuff::SpellType(EOStuff::Number($buf[11]));
    $targetRestrict = EOStuff::SpellTargetRestrict(EOStuff::Number($buf[18]));
    $target = EOStuff::SpellTarget(EOStuff::Number($buf[19]));
    
    $mindam = EOStuff::Number($buf[24],$buf[25]);
    $maxdam = EOStuff::Number($buf[26],$buf[27]);
    $accuracy = EOStuff::Number($buf[28],$buf[29]);
    $hp = EOStuff::Number($buf[35],$buf[36]);
    
    fputs($outFile,"[$i, ");
    fputs($outFile,"$spellName, ");
    fputs($outFile,"$tp, $sp, ");
    fputs($outFile,"$type, $targetRestrict, $target, ");
    fputs($outFile,"$mindam, $maxdam, $accuracy, $hp");
    fputs($outFile,"]\n");
  }
  
  fclose($outFile);
  $ESF->Close();  
}
function LoadECF($fileName)
{
  $ECF = new BinFile($fileName);
  
  $outFile = fopen("cache/ECF.dat","w+");
  
  $ECF->Seek(3);
  $rid = $ECF->ReadBytes(4);
  $len = $ECF->ReadBytes(2);
  
  $numobj = EOStuff::Number($len[1],$len[2]);
  $ECF->Seek(1);
  
  for($i = 1; $i <= $numobj; ++$i)
  {
    $namesize = $ECF->ReadBytes(1);
    $namesize[1] = EOStuff::Number($namesize[1]);
    $itemName = $ECF->ReadString($namesize[1]);
    
    $buf = $ECF->ReadBytes(EOStuff::ECF_SIZE);
    
    $base = EOStuff::Number($buf[1]);
    $str = EOStuff::Number($buf[3],$buf[4]);
    $int = EOStuff::Number($buf[5],$buf[6]);
    $wis = EOStuff::Number($buf[7],$buf[8]);
    $agi = EOStuff::Number($buf[9],$buf[10]);
    $con = EOStuff::Number($buf[11],$buf[12]);
    $cha = EOStuff::Number($buf[13],$buf[14]);
    
    fputs($outFile,"[$i, ");
    fputs($outFile,"$itemName, ");
    fputs($outFile,"$base, $str, $int, $wis, $agi, $con, $cha");
    fputs($outFile,"]\n");
  }
  
  fclose($outFile);
  $ECF->Close();
}
?>