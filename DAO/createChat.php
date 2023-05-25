<?php

require '../conexao.php';
$msg = $_POST['msgText'];
$msgFrom = $_POST['nomeUsu'];
$idUsu = $_POST['idUsu'];

$data = array(
    ':msg'  => $_POST["msgText"],
    ':msgFrom'  => $_POST["nomeUsu"],
    ':idUsu'  => $_POST["idUsu"]
);
$sqlold = "INSERT INTO chat (userId, msg, msgFrom) VALUES (:idUsu, :msg,:msgFrom)";

$statement = $connect->prepare($sqlold);

if ($statement->execute($data)) {
    $output = array(
        'msg'  => $_POST["msgText"],
        'msgFrom'  => $_POST["nomeUsu"],
        'idUsu'  => $_POST["idUsu"]
    );
    echo json_encode($output);
}

?>