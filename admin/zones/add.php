<?php
global $ns;

$text .= "
<script type=\"application/javascript\">
function submitCreateZone() {
	if (document.createzone.zonename.value == \"\") {
		alert(\"".LAN_ADMIN_ZONES_ADD_NONAMEERROR.".\");
		document.createzone.zonename.style.border = \"3px solid #FF0000\";
	} else {
		document.createzone.submit();
	}
}
</script>
<div style=\"text-align: center;\">
<h2>Create Zone</h2>
<form name=\"createzone\" method=\"post\" action=\"".e_SELF."?action=create\">
<table>
<tr><td><label for=\"zonename\">".LAN_ADMIN_ZONES_ADD_NAME."</label></td><td><input type=\"text\" name=\"zonename\"/></td></tr>
<tr><td colspan=\"2\"><input type=\"button\" value=\"".LAN_ADMIN_COMMON_RESET."\" onclick=\"javascript: document.createzone.reset();\"/><input type=\"button\" value=\"".LAN_ADMIN_ZONES_ADD_CREATE."\" onclick=\"javascript: submitCreateZone();\"/></td></tr>
</table>
</form>
";
$text .= "<a href=\"admin_e107dkp.php\">".LAN_ADMIN_COMMON_MAINMENU."</a>";
$text .= "</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">".LAN_ADMIN_COMMON_MAINMENU."</a> -> <a href=\"".e_SELF."\">".LAN_ADMIN_ZONES_ADD_PARENTTITLE."</a> -> ".LAN_ADMIN_ZONES_ADD_TITLE, $text);
?>