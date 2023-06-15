<?php

require '../conexao.php';
$msg = $_POST['msgText'];
$msgFrom = $_POST['nomeUsu'];
$idUsu = $_POST['idUsu'];
$horaAtual = $_POST['horaAtual'];

$data = array(
    ':msg'  => $_POST["msgText"],
    ':msgFrom'  => $_POST["nomeUsu"],
    ':idUsu'  => $_POST["idUsu"],
    ':horaAtual'  => $_POST["horaAtual"]
);
$sqlold = "INSERT INTO chat (userId, msg, msgFrom, horaAtual) 
VALUES (:idUsu, :msg,:msgFrom,:horaAtual)";

$statement = $connect->prepare($sqlold);

if ($statement->execute($data)) {
    $output = array(
        'msg'  => $_POST["msgText"],
        'msgFrom'  => $_POST["nomeUsu"],
        'idUsu'  => $_POST["idUsu"],
        'horaAtual'  => $_POST["horaAtual"]
    );
    echo json_encode($output);
}
