<?php

require '../../conexao.php';

$dia = date("Y-m-d");

$data = array(
    ':crm'  => $_POST["crm"],
    ':medico'  => $_POST["medico"],
    ':andar'  => $_POST["andar"],
    ':sala'  => $_POST["sala"],
    ':mesa'  => $_POST["mesa"],
    ':ti'  => $_POST["ti"],
    ':dia' => $dia,
    ':turno'  => $_POST["turno"]
);


$sqlold = "INSERT INTO presenca (crm, medico, andar, sala, mesa, dia, ti, turno) VALUES (:crm,:medico,:andar,:sala,:mesa,:dia,:ti,:turno)";



$statement = $connect->prepare($sqlold);

//$sql = "INSERT INTO presenca (crm, medico, andar, sala, mesa, dia, ti, turno) VALUES ('$crm','$medico','$andar','$sala','$mesa','$dia','$ti','$turno');";

//echo $sql;

//$result = mysqli_query($strcon, $sql);

//echo $result;

if ($statement->execute($data)) {
    $output = array(
        'crm'  => $_POST["crm"],
        'medico'  => $_POST["medico"],
        'andar'  => $_POST["andar"],
        'sala'  => $_POST["sala"],
        'mesa'  => $_POST["mesa"],
        'ti'  => $_POST["ti"],
        'dia' => $dia,
        'turno'  => $_POST["turno"]
    );

    echo json_encode($output);
}
