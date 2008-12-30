<?php
$databasestable = new DatabasesTable();
$database = $databasestable->fetchById($_GET['id']);
if ($database)
{
	$database->delete();
}

header("Location: ".e_SELF);
?>
