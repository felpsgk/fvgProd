<?php


    include '../conexao.php';

    $andar = $_GET['postandar'];

    //echo $andar, "resultado </br>";

    $sqlia = "SELECT id, sala FROM sala WHERE andar = ".$andar;

    //echo $sqlia, "resultado </br>";


    $resultado = mysqli_query($strcon, $sqlia);

    $sala_arr = array();

    while ($row = mysqli_fetch_array($resultado)){
        $idSala = $row['id'];
        $salaNum = $row['sala'];
        $sala_arr[] = $salaNum;
    }
    //echo $sala_arr;
    echo json_encode($sala_arr);
?>