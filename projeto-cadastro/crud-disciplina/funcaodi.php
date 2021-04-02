<?php

function get_total_all_records()
{
	include('conexaodi.php');
	$statement = $connection->prepare("SELECT * FROM disciplina");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>