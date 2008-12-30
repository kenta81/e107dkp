<?php
if (isset($_POST['name']) && $_POST['name'] != '')
{
	$databasestable = new DatabasesTable();
	$database = $databasestable->fetchById($_POST['id']);
	print $_POST['name'];
	if ($database)
	{
		$database->name = $_POST['name'];
		$database->save();
	}
}
header("Location: ".e_SELF);
?>
