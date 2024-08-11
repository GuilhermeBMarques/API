<?php

    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "SEGRED0s";
    $dbName = "formulario-usuario";

    
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    /*  //PRA CONFIRMAR SE O MYSQLI ESTA CONCTADO
    if($conexao->connect_errno)
    {
        echo "Erro";
    }
    else
    {
        echo "Conexão efetuada com sucesso";
    }
    */
?>