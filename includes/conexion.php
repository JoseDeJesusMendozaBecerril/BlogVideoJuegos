<?php
    //Conexion
    $servidor = 'localhost';
    $usuario = 'root';
    $contrasena = '';
    $basededatos='BD_PHPMYSQL';
    
    $db = mysqli_connect($servidor, $usuario, $contrasena, $basededatos);
    
    mysqli_query($db, "SET NAMES 'utf8'");

   //Iniciar la sesion
   if(!isset($_SESSION)){
    session_start();
    }
    
    
?>
