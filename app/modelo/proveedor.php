<?php
include ("../dao/proveedorDAO.php");

class Proveedor{
    private $codigo;
    private $nombre;
    private $direccion;
    private $numeroTelefono;
    private $email;
    private $cuit;
    private $personaContacto;
    private $formaPago;
    private $categorias;

    public function __construct(){
       
    }
public function constructorConParametros( $nombre,  $direccion,  $numeroTelefono,  $email,  $cuit,  $personaContacto,  $formaPago,  $categorias, $codigo)
    {$this->nombre = $nombre;
    $this->direccion = $direccion;
    $this->numeroTelefono = $numeroTelefono;
    $this->email = $email;$this->cuit = $cuit;
    $this->personaContacto = $personaContacto;
    $this->formaPago = $formaPago;
    $this->categorias = $categorias;
    $this->codigo = $codigo;
    return $this;}
	
	
    public function getNombre() {return $this->nombre;}

	public function getDireccion() {return $this->direccion;}

	public function getNumeroTelefono() {return $this->numeroTelefono;}

	public function getEmail() {return $this->email;}

	public function getCuit() {return $this->cuit;}

	public function getPersonaContacto() {return $this->personaContacto;}

	public function getFormaPago() {return $this->formaPago;}

	public function getCategorias() {return $this->categorias;}

	public function setNombre( $nombre): void {$this->nombre = $nombre;}

	public function setDireccion( $direccion): void {$this->direccion = $direccion;}

	public function setNumeroTelefono( $numeroTelefono): void {$this->numeroTelefono = $numeroTelefono;}

	public function setEmail( $email): void {$this->email = $email;}

	public function setCuit( $cuit): void {$this->cuit = $cuit;}

	public function setPersonaContacto( $personaContacto): void {$this->personaContacto = $personaContacto;}

	public function setFormaPago( $formaPago): void {$this->formaPago = $formaPago;}

	public function setCategorias( $categorias): void {$this->categorias = $categorias;}

	public function getCodigo() {return $this->codigo;}

	public function setCodigo( $codigo): void {$this->codigo = $codigo;}

	

	//Dar de alta un Proveedor
    public function cargarProveedor(){
        $resultado= False;
        $proveedorDAO= new ProveedorDAO($this);
        $resultado= $proveedorDAO->persistirProveedor();
        return $resultado;
    
    }
	//Dar de baja un Proveedor
    public function eliminarProveedor($idproveedor){
        $resultado= False;
        $proveedorDAO= new ProveedorDAO($this);
        $resultado=$proveedorDAO->darBajaProveedor($idproveedor);
        return $resultado;}

    //Modificar un Proveedor
    public function modificarProveedor($idproveedor){
        $resultado= False;
        $proveedorDAO= new ProveedorDAO($this);
        $resultado=$proveedorDAO->ModificarProveedor($idproveedor);
        return $resultado;
        }
    //Buscar un proveedor:
    public function obtenerProveedorSegunCodigo($idproveedor){
        $proveedorDAO= new ProveedorDAO($this);
        $datosProveedor= $proveedorDAO->obtenerProveedorSegunCodigoDAO($idproveedor, $this);
        return $datosProveedor;
    }

    
}


?>