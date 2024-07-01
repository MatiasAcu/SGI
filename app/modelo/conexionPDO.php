<?php

//Datos para la conexion con la BD
try {
   $usuario='root';
    $contrasena='';
    $mbd = new PDO('mysql:host=localhost;dbname=sistema_gestion_inventario;port=3306', $usuario, $contrasena);
} catch (PDOException $e){
    echo $e->getMessage();
}

?>