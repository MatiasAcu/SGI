<?php

//CONTROLADOR DE LOTES
include ("../modelo/lote.php");

//ALTAS
if(isset($_POST["btnCargarLote"]))
{   
    $lote= new Lote();
    $codigoArticulo=$_POST["codigoArtículo"];
    $fechaLote= $_POST["fechaLote"];
    $descripcion=  $_POST["descripcion"];
    $lote= $lote->constructorConParametros($codigoArticulo, $fechaLote, $descripcion);  
        if($resultado= $lote->cargarLote()){
            echo "<script> alert('Lote registrado con exito'); window.location='../vistas/listadoDeLotes.php?articulo=$codigoArticulo' </script>";
        }else{
            echo "<script> alert('Lote NO registrado con exito, revise los datos ingresados'); window.location='../vistas/listadoDeLotes.php?articulo=$codigoArticulo' </script>";
        }//BAJAS
}else if(!empty($_GET["BTNEC"])){
    $lote= new Lote();
    $codigoArticulo=$_GET["articulo"];
    $idLote= $_GET["idlote"];
    if($resultado=$lote->eliminarLote($idLote)){
        echo "<script> alert('Lote eliminado con exito'); window.location='../vistas/listadoDeLotes.php?articulo=$codigoArticulo' </script>";
    }else{
        echo "<script> alert('Lote NO eliminado con exito, revise los datos ingresados'); window.location='../vistas/listadoDeLotes.php?articulo=$codigoArticulo' </script>";
    }
}
//Modificacion
if(isset($_POST["btnModificarLote"]))
{   
    $lote= new Lote();
    $codigoArticulo=$_POST["codigoArtículo"];
    $fechaLote= $_POST["fechaLote"];
    $descripcion=  $_POST["descripcion"];
    $idLote=$_POST["idLote"];
    $lote= $lote->constructorConParametros($codigoArticulo, $fechaLote, $descripcion);  
        if($resultado= $lote->modificarLote($idLote)){
            echo "<script> alert('Lote modificado con exito'); window.location='../vistas/listadoDeLotes.php?articulo=$codigoArticulo' </script>";
        }else{
            echo "<script> alert('Lote NO modificado con exito, revise los datos ingresados'); window.location='../vistas/listadoDeLotes.php?articulo=$codigoArticulo' </script>";
        }
}
?>