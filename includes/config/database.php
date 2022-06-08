<?php

function conectarDB() : mysqli{
    $db = new mysqli ('localhost', 'root', '' , 'tfg_db');
    if(!$db){
        echo "No se pudo conectar";
        exit;
    }
    return $db;
}


function realizarConsulta ( $db, $consulta): mysqli_result{
    return mysqli_query($db, $consulta);
}