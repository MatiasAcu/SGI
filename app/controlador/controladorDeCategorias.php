<?php

//CONTROLADOR DE CATEGORIAS
include ("../modelo/categoria.php");

//Alta de Categoria 
if(!empty($_GET["categoria"])){
    $categoria= new Categoria();
    $categoria= $categoria->constructorConParametros(strtoupper($_POST['categoria']));
    $nombreCategoria= $_POST["categoria"];
    if($resultado= $categoria->cargarCategoria()){
        echo "<script> alert('Categoria registrada con exito: $nombreCategoria '); window.location='../vistas/cargarProveedor.php' </script>";
    }
    else{
        echo "<script> alert('Categoria NO registrado con exito: $nombreCategoria, revise los datos ingresados'); window.location='../vistas/cargarProveedor.php' </script>";
    }
//Baja de Categoria
}elseif(!empty($_GET["idcategoriaElim"])){
    $categoria= new Categoria();
    $numeroCategoria= $_GET["idcategoriaElim"];
    if($resultado=$categoria->eliminarCategoria($_GET["idcategoriaElim"])){
        echo "<script> alert('Categoría ELIMINADA con exito, Número:   $numeroCategoria  '); window.location='../vistas/listadoCategorias.php' </script>";
    }
    else{
        echo "<script> alert('Categoría  NO ELIMINADA, Número:  $numeroCategoria, revise los datos ingresados'); window.location='../vistas/listadoCategorias.php' </script>";
    }
}elseif(!empty($_GET["nuevaCategoria"])){
    $categoria= new Categoria();
    $categoria= $categoria->constructorConParametros(strtoupper($_POST['categoria']));
    $nombreCategoria= $_POST["categoria"];
    if($resultado= $categoria->cargarCategoriaNueva()){
        echo "<script> alert('Categoria registrada con exito: $nombreCategoria '); window.location='../vistas/listadoCategorias.php' </script>";
    }
    else{
        echo "<script> alert('Categoria NO registrado con exito: $nombreCategoria, revise los datos ingresados'); window.location='../vistas/listadoCategorias.php' </script>";
    }
}


class ControladorDeCategoria{


    public function __construct(){

	}
  
   
}

?>