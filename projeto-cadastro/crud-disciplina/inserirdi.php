<?php
include('conexaodi.php');
include('funcaodi.php');

if(isset($_POST["operacao"]))
{
    if($_POST["operacao"] == "Adicionar")
    {
        $statement = $connection->prepare("INSERT INTO disciplina (nome, professor_id, aluno_id) VALUES (:nome, :professor_id, :aluno_id)");
        $result = $statement->execute(
             array(
                ':nome'   =>  $_POST["nome"],
                ':professor_id' =>  $_POST["professor_id"],
                ':aluno_id' =>  $_POST["aluno_id"],
             )
        );
    }
    if($_POST["operacao"] == "Editar")
    {
        $statement = $connection->prepare("UPDATE disciplina SET nome = :nome, professor_id = :professor_id, aluno_id = :aluno_id WHERE id = :id");
        $result = $statement->execute(
             array(
                ':nome'   =>  $_POST["nome"],
                ':professor_id' =>  $_POST["professor_id"],
                ':aluno_id' =>  $_POST["aluno_id"],
                ':id'       =>  $_POST["disciplina_id"]
             )
        );
    }

}
?>
      