<?php

session_start();



require 'conexao.php';



if (isset($_POST['login']) || !empty($_POST['login']) || isset($_POST['senha']) || !empty($_POST['senha'])) //Neste caso > 0 é só uma verificação se a chave do usuário é valida

{


    $usuario = mysqli_real_escape_string($strcon, $_POST['login']);

    $senha = mysqli_real_escape_string($strcon, $_POST['senha']);

    $selecionaId = "SELECT * FROM `usuario` WHERE usuario = '$usuario' AND senha = md5('$senha')";
    $selecionaTipo = "SELECT tipo FROM `usuario` WHERE usuario = '$usuario' AND senha = md5('$senha')";

    $resultado = mysqli_query($strcon, $selecionaId);
    $resultado2 = mysqli_query($strcon, $selecionaTipo);

    $row = mysqli_num_rows($resultado);

    $user = mysqli_fetch_array($resultado);
    $perfiluser = mysqli_fetch_array($resultado2);

    $tipo = $user['tipo'];
    $perfil = $perfiluser['tipo'];

    $id = $user['id'];


    if ($row == 1) {


        if ($tipo == 5) {

            $sql = "UPDATE `usuario` SET `ativo` = '1' WHERE `usuario`.`id` = '$id'";

            mysqli_query($strcon, $sql);


            $ativo = "SELECT ativo FROM `usuario` WHERE id = '$id' AND nome = '$usuario' AND senha = md5('$senha')";

            $resultadoAtivo = mysqli_query($strcon, $ativo);



            $idAtivo = mysqli_fetch_array($resultadoAtivo);

            $int = $idAtivo['ativo'];


            if ($int == 1) {

                $_SESSION['usuario'] = $usuario;
                $_SESSION['id'] = $id;
                $_SESSION['perfil'] = $perfil;

                header('Location: index.php');

                exit();
            } else {

                $_SESSION['nao_autenticado'] = true;

                header('Location: login.php');

                exit();
            }
        }


        $sql = "UPDATE `usuario` SET `ativo` = '1' WHERE `usuario`.`id` = '$id'";

        mysqli_query($strcon, $sql);



        $ativo = "SELECT ativo FROM `usuario` WHERE id = '$id' AND nome = '$usuario' AND senha = md5('$senha')";

        $resultadoAtivo = mysqli_query($strcon, $ativo);



        $idAtivo = mysqli_fetch_array($resultadoAtivo);



        $int = $idAtivo['ativo'];



        if ($int == 1) {

            $_SESSION['usuario'] = $usuario;
            $_SESSION['id'] = $id;
            $_SESSION['perfil'] = $perfil;

            header('Location: index.php');

            exit();
        } else {

            $_SESSION['nao_autenticado'] = true;

            header('Location: login.php');

            exit();
        }
    } else {

        $_SESSION['nao_autenticado'] = true;

        header('Location: login.php');

        exit();
    }
    # code...

}
