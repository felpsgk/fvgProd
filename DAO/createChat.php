<?php

require '../conexao.php';
$msg = $_POST['msgText'];
$msgFrom = $_POST['nomeUsu'];
$idUsu = $_POST['idUsu'];
$dataMsg = $_POST['dataMsg'];
$horaMsg = $_POST['horaMsg'];

$data = array(
    ':msg'  => $_POST["msgText"],
    ':msgFrom'  => $_POST["nomeUsu"],
    ':idUsu'  => $_POST["idUsu"],
    ':dataMsg'  => $_POST["dataMsg"],
    ':horaMsg'  => $_POST["horaMsg"]
);
$sqlold = "INSERT INTO chat (userId, msg, msgFrom, dataMsg, horaMsg) 
VALUES (:idUsu, :msg,:msgFrom,:dataMsg,:horaMsg)";

$statement = $connect->prepare($sqlold);

if ($statement->execute($data)) {
    $output = array(
        'msg'  => $_POST["msgText"],
        'msgFrom'  => $_POST["nomeUsu"],
        'idUsu'  => $_POST["idUsu"],
        'dataMsg'  => $_POST["dataMsg"],
        'horaMsg'  => $_POST["horaMsg"]
    );
    echo json_encode($output);
}
