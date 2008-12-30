<?php
if (isset($_POST['name']) && $_POST['name'] != "")
{
	$databasestable = new DatabasesTable();
	$newdatabase = $databasestable->createRow();
	$newdatabase->name = $_POST['name'];
	$newdatabase->save();
}
header("Location: ".e_SELF); 
?>
