<?php

class ProveedorDAO{
   private $proveedor;

  
    public function __construct($proveedor){
        $this->proveedor=$proveedor;
        
    }
    public function getProveedor() {return $this->proveedor;}

	public function setProveedor( $proveedor): void {$this->proveedor = $proveedor;}


    public function obtenerUltimoNumeroProveedor(){ 
        $numeroUltimoProveedor= 0;
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT `AUTO_INCREMENT` as nroUltimoProveedor FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'sistema_gestion_inventario' AND TABLE_NAME = 'proveedores'
");
       
        $sentencia->execute();
        $row = $sentencia->fetch(PDO::FETCH_OBJ);
        $numeroUltimoProveedor= $row->nroUltimoProveedor;
        return  $numeroUltimoProveedor;    
    }


    public function persistirProveedor(){
        include ("../modelo/conexionPDO.php");
         /*  
        Observacion en el registro de proveedores se verifica que no se carguen dos proveedores con el mismo nombre 
        para eso se realiza la siguiente sentencia
        */
        $sentencia = $mbd->prepare("SELECT COUNT(*) FROM proveedores where nombre_proveedor= :nombreP");
        $sentencia->bindParam(':nombreP', $nombreParam);
        $nombreParam=$this->getProveedor()->getNombre();   
        $sentencia->execute();
        $numeroFilas =$sentencia->fetchColumn();
        if($numeroFilas > 0){//el Nombre de proveedor ya esta en uso
            echo "<script> alert('Proveedor NO registrado con exito: $nombreParam NO esta disponible'); window.location='../vistas/cargarProveedor.php' </script>";
        }
        else if ($numeroFilas == 0)
        {
        $mbd->beginTransaction();
        $sentencia = $mbd->prepare("INSERT INTO proveedores(nombre_proveedor, domicilio, numero_telefono, email, numero_cuit, persona_contacto, forma_pago) 
        values(:nombreP, :domicilioP, :numero_telefonoP, :emailP,  :numero_cuitP, :persona_contactoP, :forma_pagoP)");
        $sentencia->bindParam(':nombreP',$nombreParam);
        $sentencia->bindParam(':domicilioP',$domicilioParam);
        $sentencia->bindParam(':numero_telefonoP',  $numero_telefonoParam);
        $sentencia->bindParam(':emailP',  $emailParam);
        $sentencia->bindParam(':numero_cuitP',  $numero_cuitParam);
        $sentencia->bindParam(':persona_contactoP',  $contactoParam);
        $sentencia->bindParam(':forma_pagoP',  $pagoParam);
        
        $nombreParam=$this->getProveedor()->getNombre();
        $domicilioParam=$this->getProveedor()->getDireccion();
        $numero_telefonoParam=$this->getProveedor()->getNumeroTelefono();
        $emailParam=$this->getProveedor()->getEmail();
        $numero_cuitParam=$this->getProveedor()->getCuit();
        $contactoParam=$this->getProveedor()->getPersonaContacto();
        $pagoParam=$this->getProveedor()->getFormaPago();
        $sentencia->execute();

        $categoriasApersistir= $this->getProveedor()->getCategorias();
        if(!isset($categoriasApersistir)){return FAlSE;}
        $longitud= sizeof($categoriasApersistir);
        $sentencia2 = $mbd->prepare("INSERT INTO categorias_proveedores(idproveedor, idcategoria) 
        values(:idproveedorP, :idcategoriaP)");
        for($i=0;$i<$longitud;$i++){
            $sentencia2->bindParam(':idproveedorP',$idproveedorParam);
            $sentencia2->bindParam(':idcategoriaP',$idcategoriaParam);

            $idproveedorParam=$this->getProveedor()->getCodigo();
            $idcategoriaParam=$categoriasApersistir[$i];

            if(!$sentencia2->execute() ){
                $mbd->rollBack(); //Si por algun motivo sugiera un problema en la carga de las categorias realizamos un ROLLBACK, al estado previo de la BD
                BREAK;
             }

        }
        $mbd->commit();
        return TRUE;
    }
    }
    public function verificarProveedorAEliminar($idproveedor){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT  COUNT(*) as articulos FROM articulos WHERE proveedor= :idProveedorP;");
        $sentencia->bindParam(':idProveedorP',$idParam);
        $idParam= $idproveedor; 
        $sentencia->execute();
        $datos= $sentencia->fetch(PDO::FETCH_OBJ);
        if($datos->articulos > 0){
            return False;
        }else{
            return True;
        }
   }

    public function darBajaProveedor($idproveedor){
        include ("../modelo/conexionPDO.php");
        if($this->verificarProveedorAEliminar($idproveedor)){
            $mbd->beginTransaction();
            $sentencia1 = $mbd->prepare("DELETE from categorias_proveedores WHERE (idproveedor=:idProveedorP)");
            $sentencia = $mbd->prepare("DELETE FROM proveedores WHERE idproveedor= :idProveedorP;");
            $sentencia1->bindParam(':idProveedorP',$idParam);
            $sentencia->bindParam(':idProveedorP',$idParam); 
            $idParam= $idproveedor; 
            if(!$sentencia1->execute() || !$sentencia->execute() ){
                $mbd->rollBack(); //Si por algun motivo sugiera un problema en la baja realizamos un ROLLBACK, al estado previo de la BD
                return FALSE;
            }
            $mbd->commit();
            return TRUE;
         }else{
        return False;
    }
}
    public function ModificarProveedor($idproveedor){
       include ("../modelo/conexionPDO.php");
       $mbd->beginTransaction();
       $sentencia = $mbd->prepare("UPDATE proveedores SET  domicilio= :domicilioP, numero_telefono=:numero_telefonoP, email=:emailP, numero_cuit=:numero_cuitP, persona_contacto=:contactoP, forma_pago=:formaPagoP WHERE idproveedor= :idproveedorP;");
       
       $sentencia->bindParam(':domicilioP',$domicilioParam);
       $sentencia->bindParam(':numero_telefonoP',  $numero_telefonoParam);
       $sentencia->bindParam(':emailP',  $emailParam);
       $sentencia->bindParam(':numero_cuitP',  $numero_cuitParam);
       $sentencia->bindParam(':idproveedorP',  $idproveedor);
       $sentencia->bindParam(':contactoP',  $contactoParam);
       $sentencia->bindParam(':formaPagoP',  $formaPagoParam);
       
       
       
       $domicilioParam=$this->getProveedor()->getDireccion();
       $numero_telefonoParam=$this->getProveedor()->getNumeroTelefono();
       $emailParam=$this->getProveedor()->getEmail();
       $numero_cuitParam=$this->getProveedor()->getCuit();
       $contactoParam=$this->getProveedor()->getPersonaContacto();
       $formaPagoParam=$this->getProveedor()->getFormaPago();
       $sentencia->execute();
       $sentencia2 = $mbd->prepare("DELETE from categorias_proveedores WHERE (idproveedor=:idproveedorP)");
       $sentencia2->bindParam(':idproveedorP',  $idproveedor);
       if(!$sentencia2->execute() ){
        $mbd->rollBack(); //Si por algun motivo sugiera un problema realizamos un ROLLBACK, al estado previo de la BD
        }
        $categoriasApersistir= $this->getProveedor()->getCategorias();
        if(!isset($categoriasApersistir)){return FAlSE;}
        $longitud= sizeof($categoriasApersistir);
        $sentencia3 = $mbd->prepare("INSERT INTO categorias_proveedores(idproveedor, idcategoria) 
        values(:idproveedorP, :idcategoriaP)");
        for($i=0;$i<$longitud;$i++){
            $sentencia3->bindParam(':idproveedorP',$idproveedorParam);
            $sentencia3->bindParam(':idcategoriaP',$idcategoriaParam);
            $idproveedorParam=$this->getProveedor()->getCodigo();
            $idcategoriaParam=$categoriasApersistir[$i];

            if(!$sentencia3->execute() ){
                $mbd->rollBack(); //Si por algun motivo sugiera un problema realizamos un ROLLBACK, al estado previo de la BD
                BREAK;
             }

        }
        $mbd->commit();
        return TRUE;
    
    }

    public function obtenerProveedorSegunCodigoDAO($idproveedor, $proveedor){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT * FROM proveedores WHERE idproveedor=:idproveedorP;");
        $sentencia->bindParam(':idproveedorP',$idproveedor);
        
        $sentencia->execute();
        $datos= $sentencia->fetch(PDO::FETCH_OBJ);
       
        $proveedor= $proveedor->constructConParametros( $datos->nombre, $datos->domicilio, $datos->localidad, $datos->provincia, $datos->codigo_postal, $datos->numero_telefono, $datos->email, $datos->tipo_iva, $datos->numero_cuit, $datos->ingresos_brutos);
        return $proveedor;
    
    }
}

    ?>