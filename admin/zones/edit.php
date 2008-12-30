<?php
global $ns;

$raidzonestable = new RaidZonesTable();
$zone = $raidzonestable->fetchById($_GET['id']);

if ($zone)
{
	$text .= "
	<script type=\"application/javascript\">
	function submitEditZone() {
		if (document.editzone.zonename.value == \"\") {
			alert(\"".LAN_ADMIN_ZONES_EDIT_NONAME.".\");
			document.editzone.zonename.style.border = \"3px solid #FF0000\";
		} else {
			document.editzone.submit();
		}
	}
	</script>
	<div style=\"text-align: center;\">
	<h2>".LAN_ADMIN_ZONES_EDIT_TITLE."</h2>
	<form name=\"editzone\" method=\"post\" action=\"".e_SELF."?action=update\">
	<table>
	<tr><td><label for=\"zonename\">".LAN_ADMIN_ZONES_EDIT_ZONENAME."</label></td><td><input type=\"text\" name=\"zonename\" value=\"".$zone->name."\"/></td></tr>
	<tr><td colspan=\"2\"><input type=\"button\" value=\"".LAN_ADMIN_COMMON_RESET."\" onclick=\"javascript: document.editzone.reset();\"/><input type=\"button\" value=\"".LAN_ADMIN_ZONES_EDIT_EDITZONE."\" onclick=\"javascript: submitEditZone();\"/></td></tr>
	</table>
	<input type=\"hidden\" name=\"zoneid\" value=\"".$zone->id."\"/>
	</form>
	";
	$text .= "<a href=\"admin_e107dkp.php\">".LAN_ADMIN_COMMON_MAINMENU."</a>";
	$text .= "</div>";
}
else
{
	$text .= "<div style=\"text-align: center;\"><p>".LAN_ADMIN_ZONES_EDIT_NOSUCHZONE."</p><a href=\"".e_SELF."\">Back</a></div>";
}


$ns->tableRender("<a href=\"admin_e107dkp.php\">".LAN_ADMIN_COMMON_MAINMENU."</a> -> <a href=\"".e_SELF."\">".LAN_ADMIN_ZONES_EDIT_PARENTTITLE."</a> -> ".LAN_ADMIN_ZONES_EDIT_TITLE, $text);
?>