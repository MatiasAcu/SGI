<?php

//CONTROLADOR DE PROVEEDORES
include ("../modelo/proveedor.php");

//ALTAS
if(isset($_POST["btnCargarProveedor"]))
{
    $proveedor= new Proveedor();
    $proveedor= $proveedor->constructorConParametros($_POST["nombre"], $_POST["direccion"], $_POST["telefono"], $_POST["email"], $_POST["cuit"],$_POST["personaContacto"], $_POST["formaPago"],$_POST["categorias"], $_POST["codigo"] ); 
    $nombreProveedor= $_POST["nombre"];
    if($resultado= $proveedor->cargarProveedor()){
        echo "<script> alert('Proveedor registrado con exito: $nombreProveedor '); window.location='../vistas/listadoProveedores.php' </script>";
    }
    else{
        echo "<script> alert('Proveedor NO registrado con exito: $nombreProveedor, revise los datos ingresados'); window.location='../vistas/cargarProveedor.php' </script>";
    }//BAJAS
}else if(!empty($_GET["BTNEC"])){
    $proveedor= new Proveedor();
    $numeroProveedor= $_GET["idproveedor"];
    if($resultado=$proveedor->eliminarProveedor($_GET["idproveedor"])){
        echo "<script> alert('Proveedor ELIMINADO con exito, Número:  $numeroProveedor  '); window.location='../vistas/listadoProveedores.php' </script>";
    }
    else{
        echo "<script> alert('Proveedor NO ELIMINADO, Número:  $numeroProveedor, revise los datos ingresados'); window.location='../vistas/listadoProveedores.php' </script>";
    }
}//MODIFICACION
if(isset($_POST["btnModificarProveedor"]))
{
    $proveedor= new Proveedor();
    $proveedor= $proveedor->constructorConParametros($_POST["nombre"], $_POST["direccion"], $_POST["telefono"] ,  $_POST["email"] , $_POST["cuit"] , $_POST["personaContacto"], $_POST["formaPago"], $_POST["categorias"], $_POST["idproveedor"]);
    $nombreProveedor= $_POST["nombre"];
    if($resultado= $proveedor->modificarProveedor($_POST["idproveedor"])){
        echo "<script> alert('Proveedor MODIFICADO con exito:  $nombreProveedor '); window.location='../vistas/listadoProveedores.php' </script>";
    }
    else{
        echo "<script> alert('Proveedor NO MODIFICADO con exito: $nombreProveedor, revise los datos ingresados. Recuerde haber seleccionado/ re-seleccionado las categorías del mismo'); window.location='../vistas/listadoProveedores.php' </script>";
    }
}else if(!empty($_GET["categoria"])){
    print($_POST['message-text']);
}


class ControladorDeProveedores{


    public function __construct(){

	}
  
    public function numeroDeProveedorParaCargar(){
        $proveedorDAO= new ProveedorDAO(new Proveedor());
        $numero= $proveedorDAO-> obtenerUltimoNumeroProveedor();
       
        return $numero;
    }
}

?>