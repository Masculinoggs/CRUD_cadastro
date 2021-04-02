<?php
include('conexao.php');
include('funcao.php');

if(isset($_POST["professor_id"]))
{
    $output = array();
    $statement = $connection->prepare("SELECT * FROM professor WHERE id = '".$_POST["professor_id"]."' LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["id"] = $row["id"];
        $output["nome"] = $row["nome"];
        $output["cpf"] = $row["cpf"];
        $output["datanas"] = $row["datanas"];
        $output["disciplina_id"] = $row["disciplina_id"];
    }
    echo json_encode($output);
}
?>  