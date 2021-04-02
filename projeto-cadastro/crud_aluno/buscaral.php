<?php
include('conexaoal.php');
include('funcaoal.php');
$query = '';
$output = array();
$query .= "SELECT * FROM aluno ";
if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE nome LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR cpf LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR datanas LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR disciplina_id LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY id ASC ';
}

if($_POST["length"] != -1)
{
    $query .= 'LIMIT ' .$_POST['start']. ', ' .$_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
    $sub_array = array();

    $sub_array[] = $row["id"];
    $sub_array[] = $row["nome"];
    $sub_array[] = $row["cpf"];
    $sub_array[] = $row["datanas"];
    $sub_array[] = $row["disciplina_id"];
    $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary btn-sm update">Editar</button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-sm delete">Deletar</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_total_all_records(),
    "data"              =>  $data
);
echo json_encode($output);
?>
      