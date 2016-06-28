<?php
/**
EO Data Resource ~ Ethan Moffat
-- EOStuff.class.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/

//class with static functions/const members
//random usefulness
class EOStuff
{
  const ENF_SIZE = 39;
  const ESF_SIZE = 51;
  const EIF_SIZE = 58;
  const ECF_SIZE = 14;

  const MAX1 = 253;
  const MAX2 = 64009;
  const MAX3 = 16194277;
  
  public static function Number($b1, $b2 = 254, $b3 = 254, $b4 = 254)
  {
    if($b1 == 0 || $b1 == 254) $b1 = 1;
    if($b2 == 0 || $b2 == 254) $b2 = 1;
    if($b3 == 0 || $b3 == 254) $b3 = 1;
    if($b4 == 0 || $b4 == 254) $b4 = 1;
    
    $b1--;
    $b2--;
    $b3--;
    $b4--;

    return ($b4*self::MAX3 + $b3*self::MAX2 + $b2*self::MAX1 + $b1);
  }
  
  public static function NPCType($typetemp)
  {
    $type = "";
    switch($typetemp)
    {
      case 0: $type = "NPC"; break;
      case 1: $type = "Passive"; break;
      case 2: $type = "Aggresive"; break;
      case 3: $type = "Unknown1"; break;
      case 4: $type = "Unknown2"; break;
      case 5: $type = "Unknown3"; break;
      case 6: $type = "Shop"; break;
      case 7: $type = "Inn"; break;
      case 8: $type = "Unknown4"; break;
      case 9: $type = "Bank"; break;
      case 10: $type = "Barber"; break;
      case 11: $type = "Guild"; break;
      case 12: $type = "Priest"; break;
      case 13: $type = "Law"; break;
      case 14: $type = "Skills"; break;
      case 15: $type = "Quest"; break;
      default: $type = "ERROR"; break;
    }
    return $type;  
  }
  
  public static function ItemType($num)
  {
    switch($num)
    {
      case 0: return "Static"; break;
      case 1: return "Unknown"; break;
      case 2: return "Money"; break;
      case 3: return "Heal"; break;
      case 4: return "Teleport"; break;
      case 5: return "Spell"; break;
      case 6: return "EXPReward"; break;
      case 7: return "StatReward"; break;
      case 8: return "SkillReward"; break;
      case 9: return "Key"; break;
      case 10: return "Weapon"; break;
      case 11: return "Shield"; break;
      case 12: return "Armor"; break;
      case 13: return "Hat"; break;
      case 14: return "Boots"; break;
      case 15: return "Gloves"; break;
      case 16: return "Accessory"; break;
      case 17: return "Belt"; break;
      case 18: return "Necklace"; break;
      case 19: return "Ring"; break;
      case 20: return "Armlet"; break;
      case 21: return "Bracer"; break;
      case 22: return "Beer"; break;
      case 23: return "EffectPotion"; break;
      case 24: return "HairDye"; break;
      case 25: return "CureCurse"; break;
      default: return "ERROR"; break;      
    }
  }
  
  public static function ItemSubType($num)
  {
    switch($num)
    {
      case 0: return "None"; break;
      case 1: return "Ranged"; break;
      case 2: return "Arrows"; break;
      case 3: return "Wings"; break;
      default: return "ERROR"; break;
    }
  }
  
  public static function ItemSpecial($num)
  {
    switch($num)
    {
      case 0: return "Normal"; break;
      case 1: return "Rare"; break;
      case 2: return "Unknown"; break;
      case 3: return "Unique"; break;
      case 4: return "Lore"; break;
      case 5: return "Cursed"; break;
      default: return "ERROR"; break;
    }
  }
  
  public static function SpellType($num)
  {
    switch($num)
    {
      case 0: return "Damage"; break;
      case 1: return "Heal"; break;
      case 2: return "Bard"; break;
      default: return "ERROR"; break;
    }
  }
  
  public static function SpellTargetRestrict($num)
  {
    switch($num)
    {
      case 0: return "Any"; break;
      case 1: return "Friendly"; break;
      case 2: return "Opponent"; break;
      default: return "ERROR"; break;
    }
  }
  
  public static function SpellTarget($num)
  {
    switch($num)
    {
      case 0: return "Normal"; break;
      case 1: return "Self"; break;
      case 2: return "Unknown"; break;
      case 3: return "Group"; break;
      default: return "ERROR"; break;
    }
  }
}
?>