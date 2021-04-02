<?php

function get_total_all_records()
{
	include('conexaoal.php');
	$statement = $connection->prepare("SELECT * FROM aluno");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>