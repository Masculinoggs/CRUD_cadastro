<?php

function get_total_all_records()
{
	include('conexao.php');
	$statement = $connection->prepare("SELECT * FROM professor");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>