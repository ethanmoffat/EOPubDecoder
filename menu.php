<?php
/**
EO Data Resource ~ Ethan Moffat
-- config.php --
Release as part of the EO Data resource
V 0.1.0, 04-17-2011
**/
?>
<script language="javascript">
function formCheck()
{
if(document.form.input.value == "")
{
  alert("Please enter a search term");
  return false;
}
else if(document.form.search[0].checked == false && 
	document.form.search[1].checked == false && 
	document.form.search[2].checked == false && 
	document.form.search[3].checked == false)
	{
	  alert("Please enter a search type");
	  return false;
	}
}
</script>
<ul class="leftMenuLink">
<li><a href="index.php"               class="leftMenuLink">Home</a></li>
<li><a href="credits.php"             class="leftMenuLink">Credits</a></li>
<hr class="menuBreak">
<li><a href="data.php?type=armor&sort=id"     class="leftMenuLink">Armor</a></li>
<li><a href="data.php?type=hats&sort=id"      class="leftMenuLink">Hats</a></li>
<li><a href="data.php?type=shields&sort=id"   class="leftMenuLink">Shields</a></li>
<li><a href="data.php?type=weapons&sort=id"   class="leftMenuLink">Weapons</a></li>
<li><a href="data.php?type=equip&sort=id"     class="leftMenuLink">Other Equipment</a></li>
<li><a href="data.php?type=items&sort=id"     class="leftMenuLink">Other Items</a></li>
<hr class="menuBreak">
<li><a href="data.php?type=allItems&sort=id"      class="leftMenuLink">All Items</a></li>
<li><a href="data.php?type=spells&sort=id"    class="leftMenuLink">Spells</a></li>
<li><a href="data.php?type=classes&sort=id"   class="leftMenuLink">Classes</a></li>
<li><a href="data.php?type=npc&sort=id"       class="leftMenuLink">NPCs</a></li>
<hr class="menuBreak">
<li align="center">
  <form name="form" method="GET" action="search.php" onSubmit="return formCheck()">
    <input type="text" name="input"><br><br>
    <table class="nested">
      <tr class="nested">
        <td class="nested" align="right"><input type="radio" name="search" value="EIF"></td>
        <td class="nested" width="60%"> Items</td>
      </tr>
      <tr class="nested">
        <td class="nested" align="right"><input type="radio" name="search" value="ESF"></td>
        <td class="nested" width="60%"> Spells</td>
      </tr>
      <tr class="nested">
        <td class="nested" align="right"><input type="radio" name="search" value="ECF"></td>
        <td class="nested" width="60%"> Classes</td>
      </tr>
      <tr class="nested">
        <td class="nested" align="right"><input type="radio" name="search" value="ENF"></td>
        <td class="nested" width="60%"> NPCs</td>
      </tr>
    </table>
<script language="javascript">
document.form.input.value = "<?php if(isset($_GET['input'])) echo $_GET['input']; ?>";
<?php 
if(isset($_GET['search']))
{
  if($_GET['search'] == "EIF") { ?> document.form.search[0].checked = true <?php }
  if($_GET['search'] == "ESF") { ?> document.form.search[1].checked = true <?php }
  if($_GET['search'] == "ECF") { ?> document.form.search[2].checked = true <?php }
  if($_GET['search'] == "ENF") { ?> document.form.search[3].checked = true <?php }
}
?>
</script>
    <input type="submit" value="Search">
  </form>
</li>
</ul>