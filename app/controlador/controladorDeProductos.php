<?php

//CONTROLADOR DE Articulos
include ("../modelo/articulo.php");
include ("../modelo/categoria.php");

//ALTAS
if(isset($_POST["btnCargarArticulo"]))
{   
    $articulo= new Articulo();
    $codigoArticulo=$_POST["codigoArtículo"];
    $codigoCategoria= $_POST["categoria"];
    $proveedor=  $_POST["proveedor"];
    $categoria= new Categoria();
    if(($articulo->articuloPorCodigo($codigoArticulo)==False) AND ($categoria->categoriaValida($codigoCategoria, $proveedor)) ){
    $articulo= $articulo->constructConParametros($_POST["nombre"], $_POST["stock"], 
    $_POST["precio_unitario"],  $_POST["categoria"],$_POST["codigoArtículo"], $_POST["stockMinimo"], $_POST["proveedor"],
    $_POST["unidadReferencia"], $_POST["zonaDeposito"]);
        if($resultado= $articulo->cargarArticulo()){
            echo "<script> alert('Artículo registrado: $codigoArticulo con exito'); window.location='../vistas/cargarProducto.php' </script>";
        }else{
            echo "<script> alert('Artículo NO registrado con exito: $codigoArticulo, revise los datos ingresados'); window.location='../vistas/cargarProducto.php' </script>";
        }
    }else{
        echo "<script> alert('Artículo NO registrado con exito: $codigoArticulo, revise los datos ingresados'); window.location='../vistas/cargarProducto.php' </script>";
    }
}//MODIFICACION
if(isset($_POST["btnModificarProducto"]))
{
   
    $articulo= new Articulo();
    $codigoArticulo=$_POST["codigoArtículo"];
    $codigoCategoria= $_POST["categoria"];
    $proveedor=  $_POST["proveedor"];
    $categoria= new Categoria();
    if($categoria->categoriaValida($codigoCategoria, $proveedor) ){
    $articulo= $articulo->constructConParametrosModificación($_POST["nombre"], $_POST["stock"], 
    $_POST["precio_unitario"],  $_POST["categoria"],$_POST["codigoArtículo"], $_POST["stockMinimo"], $_POST["proveedor"],
    $_POST["unidadReferencia"], $_POST["zonaDeposito"]);
    $nombreArticulo= $_POST["nombre"];
    if($resultado= $articulo->modificarProducto($_POST["idarticulo"])){
        $idarticulo= $_POST["idarticulo"];
        echo "<script> alert('Artículo MODIFICADO con exito:  $nombreArticulo '); window.location='../vistas/listadoArticulos.php' </script>";
    }
    else{
        echo "<script> alert('Artículo  NO MODIFICADO con exito: $nombreArticulo, revise los datos ingresados'); window.location='../vistas/listadoArticulos.php' </script>";
    }
    }
}//BAJAS
else if(!empty($_GET["BTNEC"])){
    $articulo= new Articulo();
    $numeroArticulo= $_GET["idarticulo"];
    if($resultado=$articulo->eliminarArticulo($_GET["idarticulo"])){
        echo "<script> alert('Artículo ELIMINADO con exito, Número:  $numeroArticulo  '); window.location='../vistas/listadoArticulos.php' </script>";
    }
    else{
        echo "<script> alert('Artículo  NO ELIMINADO, Número:  $numeroArticulo, revise los datos ingresados'); window.location='../vistas/listadoArticulos.php' </script>";
    }
}

class ControladorDeArticulos{


    public function __construct(){

	}
  
    public function determinarAlertas(){
        $articulo= new Articulo();
        $numeroDeAlertas= $articulo->numeroDeAlertas();   
        return  $numeroDeAlertas;
    }
}


?>