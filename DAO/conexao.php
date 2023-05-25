<?php

//session_start();
    $servername = "localhost:3306"; /* pode deixar localhost */
    $username = "hnrtco66_felpsgk"; /* nome do usuario do banco de dados */ 
    $password = "rootdoadmin"; /* ssenha do banco de dados caso exista senao deixa $password = "" */
    $dbname = "hnrtco66_fvgweb"; /* nome do seu banco de dados*/

    $port = "3306"; /* nome do seu banco de dados*/
    // Criando a conexão com o banco de dados
    $strcon = new mysqli($servername, $username, $password, $dbname, $port);

    //UTILIZADO PRA CRUD
    $connect = new PDO("mysql:host=localhost:3306;dbname=hnrtco66_fvgweb", $username, $password);

    // Checando a conexão com o banco de dados

    if ($strcon->connect_error) {

        die('Connect Error (' . $strcon->connect_errno . ') ' . $strcon->connect_error);

    } 
    
?>