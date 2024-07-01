<?php

class CategoriaDAO{
   private $categoria;

    public function __construct( $categoria){$this->categoria = $categoria;}
	
    public function getCategoria() {return $this->categoria;}

    public function setCategoria( $categoria): void {$this->categoria = $categoria;}



    public function persistirCategoria(){
        include ("../modelo/conexionPDO.php");
/*  
        Observacion en el registro de categorias se verifica que no se carguen dos categorias con el mismo nombre 
        para eso se realiza la siguiente sentencia
        */
        $sentencia = $mbd->prepare("SELECT COUNT(*) FROM categorias where nombre= :nombreC");
        $sentencia->bindParam(':nombreC', $nombreParam);
        $nombreParam=$this->getCategoria()->getNombre();   
        $sentencia->execute();
        $numeroFilas =$sentencia->fetchColumn();
        if($numeroFilas > 0){//el nombre ya esta en uso
            echo "<script> alert('Categoria NO registrada con exito: $nombreParam NO esta disponible'); window.location='../vistas/cargarProveedor.php' </script>";
        }
        else if ($numeroFilas == 0)
        {
        $sentencia = $mbd->prepare("INSERT INTO categorias(nombre) values(:nombreP)");
        $sentencia->bindParam(':nombreP',$nombreParam);
            
        $nombreParam=$this->getCategoria()->getNombre();
        
        if($sentencia->execute()){
            return True;
        }
        else{
            return False;
        }
    }
    }

    public function validarCategoria($codigoCategoria,$proveedor){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT COUNT(*) as categoria FROM categorias_proveedores WHERE idproveedor=:idproveedorP AND idcategoria=:idcategoriaP");
        $sentencia->bindParam(':idproveedorP',$proveedor);
        $sentencia->bindParam(':idcategoriaP',$codigoCategoria);
        
        if($sentencia->execute()){
            $datos= $sentencia->fetch(PDO::FETCH_OBJ);
            return $datos->categoria > 0;
          
        }
        else{
            return False;
        }
    }

    public function darBajaCategoria($idcategoria){
        include ("../modelo/conexionPDO.php");
        $sentencia= $mbd->prepare("SELECT  COUNT(*) as categoria FROM categorias_proveedores WHERE idcategoria= :idcategoriaP;");
        $sentencia->bindParam(':idcategoriaP',$idParam);
        $idParam= $idcategoria; 
        $sentencia->execute();
        $datos= $sentencia->fetch(PDO::FETCH_OBJ);
        if($datos->categoria == 0){
            $sentencia1 = $mbd->prepare("DELETE FROM categorias WHERE idcategoria= :idcategoriaP;");
            $sentencia1->bindParam(':idcategoriaP',$idParam);
            $idParam= $idcategoria; 
        if( $sentencia1->execute()){
            return True;
        }
        else{
              return False;
        }
    }else{
            return False;
        }
    }

    public function persistirCategoriaNueva(){
        include ("../modelo/conexionPDO.php");
/*  
        Observacion en el registro de categorias se verifica que no se carguen dos categorias con el mismo nombre 
        para eso se realiza la siguiente sentencia
        */
        $sentencia = $mbd->prepare("SELECT COUNT(*) FROM categorias where nombre= :nombreC");
        $sentencia->bindParam(':nombreC', $nombreParam);
        $nombreParam=$this->getCategoria()->getNombre();   
        $sentencia->execute();
        $numeroFilas =$sentencia->fetchColumn();
        if($numeroFilas > 0){//el nombre ya esta en uso
            echo "<script> alert('Categoria NO registrada con exito: $nombreParam NO esta disponible'); window.location='../vistas/listadoCategorias.php' </script>";
        }
        else if ($numeroFilas == 0)
        {
        $sentencia = $mbd->prepare("INSERT INTO categorias(nombre) values(:nombreP)");
        $sentencia->bindParam(':nombreP',$nombreParam);
            
        $nombreParam=$this->getCategoria()->getNombre();
        
        if($sentencia->execute()){
            return True;
        }
        else{
            return False;
        }
    }
    }
}


?>