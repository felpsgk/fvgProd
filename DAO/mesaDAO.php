<?php


    include '../conexao.php';

    $sala = $_GET['postsala'];
    $andar = $_GET['postandar'];

    //echo $andar, "resultado </br>";
    //SELECT m.id, m.mesa, a.andar FROM mesa m INNER JOIN andar a WHERE m.sala = 1 AND a.andar = 9

    $sqlia = "SELECT m.id, m.mesa, a.andar FROM mesa m INNER JOIN andar a WHERE m.sala = '".$sala."' AND a.andar = '".$andar."' ORDER BY m.mesa + 0";

    //echo $sqlia, "resultado </br>";


    $resultado = mysqli_query($strcon, $sqlia);

    $mesa_arr = array();

    while ($row = mysqli_fetch_array($resultado)){
        $idmesa = $row['id'];
        $mesaNum = $row['mesa'];
        $mesa_arr[] = $mesaNum;
    }
    //echo $sala_arr;
    echo json_encode($mesa_arr);
