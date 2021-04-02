<?php
include('conexao.php');
include('funcao.php');

if(isset($_POST["operation"]))
{
    if($_POST["operation"] == "Adicionar")
    {
        $statement = $connection->prepare("INSERT INTO professor (nome, cpf, datanas, disciplina_id) VALUES (:nome, :cpf, :datanas, :disciplina_id)");
        $result = $statement->execute(
             array(
                ':nome'   =>  $_POST["nome"],
                ':cpf' =>  $_POST["cpf"],
                ':datanas' =>  $_POST["datanas"],
                ':disciplina_id' =>  $_POST["disciplina_id"],
             )
        );
    }
    if($_POST["operation"] == "Editar")
    {
        $statement = $connection->prepare("UPDATE professor SET nome = :nome, cpf = :cpf, datanas = :datanas, disciplina_id = :disciplina_id WHERE id = :id");
        $result = $statement->execute(
             array(
                ':nome'   =>  $_POST["nome"],
                ':cpf' =>  $_POST["cpf"],
                ':datanas' =>  $_POST["datanas"],
                ':disciplina_id' =>  $_POST["disciplina_id"],
                ':id'       =>  $_POST["professor_id"]
             )
        );
    }

}
?>
      