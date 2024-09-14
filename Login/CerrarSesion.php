<?php
//funcion para salir de la aplicacion
    session_start();
    session_unset();
    session_destroy();

    header('location:../Index.php');

?>