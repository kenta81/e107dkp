<?php
$raidzonestable = new RaidZonesTable();
$zone = $raidzonestable->fetchById($_POST['zoneid']);
if ($zone)
{
	$zone->name = $_POST['zonename'];
	var_dump($zone);
	$zone->save();
}
header("Location: ".e_SELF);
?>