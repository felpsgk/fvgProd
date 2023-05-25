<?php
session_start();

//require 'conexao.php';

//$sql = "UPDATE `usuario` SET `ativo` = '1' WHERE `usuario`.`id` = 0";
//mysqli_query($strcon, $sql);
unset($_SESSION['usuario']);
unset($_SESSION['perfil']);

header('Location: login.php');
exit();

?>