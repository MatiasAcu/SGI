<?php
include ("../dao/articuloDAO.php");

class Articulo{
    private $nombre;
    private $stock;
    private $precio_unitario;
    private $categoria;
    private $codigo;
    private $stockMinimo;
    private $proveedor;
    private $unidadReferencia;
    private $zonaDeposito;

    public function __construct(){
       
    }
       public function constructConParametros( $nombre,  $stock,  $precio_unitario,  $categoria,  $codigo,  $stockMinimo,  $proveedor,  $unidadReferencia,  $zonaDeposito){
        $this->nombre = $nombre;
        $this->stock = $stock;
        $this->precio_unitario = $precio_unitario;
        $this->categoria = $categoria;
        $this->codigo = $codigo;
        $this->stockMinimo = $stockMinimo;
        $this->proveedor = $proveedor;
        $this->unidadReferencia = $unidadReferencia;
        $this->zonaDeposito = $zonaDeposito;
        return $this;
    }
    public function constructConParametrosModificación( $nombre,  $stock,  $precio_unitario,  $categoria,  $codigo,  $stockMinimo,  $proveedor,  $unidadReferencia,  $zonaDeposito){
        $this->nombre = $nombre;
        $this->stock = $stock;
        $this->precio_unitario = $precio_unitario;
        $this->categoria = $categoria;
        $this->codigo = $codigo;
        $this->stockMinimo = $stockMinimo;
        $this->proveedor = $proveedor;
        $this->unidadReferencia = $unidadReferencia;
        $this->zonaDeposito = $zonaDeposito;
        return $this;
    }
    public function getNombre() {return $this->nombre;}

	public function getStock() {return $this->stock;}

	public function getPrecioUnitario() {return $this->precio_unitario;}

	public function getCategoria() {return $this->categoria;}

	public function getCodigo() {return $this->codigo;}

	public function getStockMinimo() {return $this->stockMinimo;}

	public function getProveedor() {return $this->proveedor;}

	public function getUnidadReferencia() {return $this->unidadReferencia;}

	public function getZonaDeposito() {return $this->zonaDeposito;}

	public function setNombre( $nombre): void {$this->nombre = $nombre;}

	public function setStock( $stock): void {$this->stock = $stock;}

	public function setPrecioUnitario( $precio_unitario): void {$this->precio_unitario = $precio_unitario;}

	public function setCategoria( $categoria): void {$this->categoria = $categoria;}

	public function setCodigo( $codigo): void {$this->codigo = $codigo;}

	public function setStockMinimo( $stockMinimo): void {$this->stockMinimo = $stockMinimo;}

	public function setProveedor( $proveedor): void {$this->proveedor = $proveedor;}

	public function setUnidadReferencia( $unidadReferencia): void {$this->unidadReferencia = $unidadReferencia;}

	public function setZonaDeposito( $zonaDeposito): void {$this->zonaDeposito = $zonaDeposito;}


		
    public function articuloPorCodigo($codigo){
        $resultado= False;
        $articuloDAO= new ArticuloDAO($this);
        $resultado= $articuloDAO->buscarPorCodigo($codigo);
        return $resultado;
    
    }
    //Dar de alta un Articulo
    public function cargarArticulo(){
        $resultado= False;
        $articuloDAO= new ArticuloDAO($this);
        $resultado= $articuloDAO->persistirArticulo();
        return $resultado;
}
    //Modificar un Articulo
    public function modificarProducto($idarticulo){
        $resultado= False;
        $articuloDAO= new ArticuloDAO($this);
        $resultado=$articuloDAO->modificarArticulo($idarticulo);
        return $resultado;
        }
    //Dar de baja un Articulo
    public function eliminarArticulo($idarticulo){
        $resultado= False;
        $articuloDAO= new ArticuloDAO($this);
        $resultado=$articuloDAO->darBajaArticulo($idarticulo);
        return $resultado;
    }
    //Avisos de Alertas de Stock
    public function numeroDeAlertas(){
        $articuloDAO= new ArticuloDAO($this);
        $numeroDeAlertas= $articuloDAO->alertasActivas();   
        return  $numeroDeAlertas;
    }
}

