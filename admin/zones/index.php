<?php
global $ns;

$zonestable = new RaidZonesTable();
$zones = $zonestable->fetchAll();

$text .= "<div style=\"text-align: center;\">";
if ($zones->count()) {
	$text .= "<table>";
	$text .= "<tr><th>".LAN_ADMIN_ZONES_INDEX_ZONENAME."</th><th>".LAN_ADMIN_COMMON_EDIT."</th><th>".LAN_ADMIN_COMMON_DELETE."</th></tr>";
	foreach ($zones as $zone) {
		$text .= "<tr><td>".$zone->name."</td><td><a href=\"?action=edit&id=".$zone->id."\">Edit</a></td><td><a href=\"?action=delete&id=".$zone->id."\" onclick=\"javascript: return confirm('Are you sure you want to delete ".$zone->name."?');\">Delete</a></td></tr>";
	}
	$text .= "</table>";
} else {
	$text .= "<p>".LAN_ADMIN_ZONES_INDEX_NOZONES.".</p>";
}

$text .= "<a href=\"?action=add\">".LAN_ADMIN_ZONES_INDEX_CREATE."</a><br/><br/>";
$text .= "<a href=\"admin_e107dkp.php\">".LAN_ADMIN_COMMON_MAINMENU."</a>";
$text .= "</div>"; 

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> ".LAN_ADMIN_ZONES_INDEX_TITLE, $text);

?>