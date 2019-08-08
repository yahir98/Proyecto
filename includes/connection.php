<?php

    $server="127.0.0.1";
    $user="greentec";
    $pass="123456";
    $db="greentec";
    $port="3306";

    $conexion = new mysqli(
        $server, $user, $pass, $db, $port
    );

    if ($conexion->connect_errno ) {
        die($conexion->connect_error);
    }

    $conexion->set_charset("utf8");

?>
