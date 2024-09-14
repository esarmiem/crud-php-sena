<?php
// Configuración de la conexión con la base de datos MySQL
    $host = "localhost";
    $user = "id21118699_davidmejia21";
    $pass = "Alejomejia21+";
    $db = "id21118699_crudphp";

    $conexion = new mysqli($host, $user, $pass, $db);

    if (!$conexion) {
        echo "Conexion fallida";
    }
?>