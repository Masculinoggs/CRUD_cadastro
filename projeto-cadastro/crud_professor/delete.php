<?php

include('conexao.php');
include('funcao.php');

if(isset($_POST["professor_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM professor WHERE id = :id"
	);
	$result = $statement->execute(

		array(':id'	=>	$_POST["professor_id"])

	    );
}

?>