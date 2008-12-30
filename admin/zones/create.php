<?php
$zonename = $_POST['zonename'];
$raidzonestable = new RaidZonesTable();
$zone = $raidzonestable->createRow();
$zone->name = $zonename;
$zone->save();
header("Location: ".e_SELF);
?>