<?php
include('conexaodi.php');
include('funcaodi.php');

if(isset($_POST["disciplina_id"]))
{
    $output = array();
    $statement = $connection->prepare("SELECT * FROM disciplina WHERE id = '".$_POST["disciplina_id"]."' LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["id"] = $row["id"];
        $output["nome"] = $row["nome"];
        $output["professor_id"] = $row["professor_id"];
        $output["aluno_id"] = $row["aluno_id"];
    }
    echo json_encode($output);
}
?>  