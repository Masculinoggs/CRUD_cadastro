<?php

include('conexaodi.php');
include('funcaodi.php');

if(isset($_POST["disciplina_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM disciplina WHERE id = :id"
	);
	$result = $statement->execute(

		array(':id'	=>	$_POST["disciplina_id"])

	    );
}

?>