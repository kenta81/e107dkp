<?php
$raidzonestable = new RaidZonesTable();
$zone = $raidzonestable->fetchById($_GET['id']);
if ($zone)
{
	$zone->delete();
}
header("Location: ".e_SELF);
?>