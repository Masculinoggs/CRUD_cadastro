<?php

include('conexaoal.php');
include('funcaoal.php');

if(isset($_POST["aluno_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM aluno WHERE id = :id"
	);
	$result = $statement->execute(

		array(':id'	=>	$_POST["aluno_id"])

	    );
}

?>