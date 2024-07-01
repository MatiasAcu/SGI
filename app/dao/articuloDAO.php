<?php

class ArticuloDAO{
   private $articulo;

  
    public function __construct( $articulo){$this->articulo = $articulo;}
	
    public function getArticulo() {return $this->articulo;}

	public function setArticulo( $articulo): void {$this->articulo = $articulo;}

	public function buscarPorCodigo($codigo){
        include("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT COUNT(*), idarticulo FROM articulos WHERE codigo=:codigoParam");
        $sentencia->bindParam(':codigoParam', $codigo);
        if(!$sentencia->execute()){
            return False;
        }
        $datos = $sentencia->fetch(PDO::FETCH_OBJ);
        $idarticulo=$datos->idarticulo;
        return $idarticulo;
    }
  public function persistirArticulo(){
        include ("../modelo/conexionPDO.php");
        $mbd->beginTransaction();
        $sentencia = $mbd->prepare("INSERT INTO articulos(nombre_articulo, stock, precio_unitario, categoria, codigo, stock_minimo, zona_deposito, proveedor, unidad_referencia) 
        values(:nombreP, :stockP, :precio_unitarioP, :categoriaP, :codigoP, :stock_minimoP, :zona_depositoP, :proveedorP, :unidad_referenciaP)");
        $sentencia->bindParam(':nombreP',$nombreParam);
        $sentencia->bindParam(':stockP',$stockParam);
        $sentencia->bindParam(':precio_unitarioP', $precio_unitarioParam);
        $sentencia->bindParam(':categoriaP', $categoriaParam);
        $sentencia->bindParam(':codigoP',  $codigoParam);
        $sentencia->bindParam(':stock_minimoP',  $stockMinimoParam);
        $sentencia->bindParam(':zona_depositoP',  $zonaDepositoParam);
        $sentencia->bindParam(':proveedorP',  $proveedorParam);
        $sentencia->bindParam(':unidad_referenciaP',  $unidadReferenciaParam);

        $nombreParam=$this->getArticulo()->getNombre();
        $stockParam=$this->getArticulo()->getStock();
        $precio_unitarioParam=$this->getArticulo()->getPrecioUnitario();
        $categoriaParam=$this->getArticulo()->getCategoria();
        $codigoParam=$this->getArticulo()->getCodigo();
        $stockMinimoParam=$this->getArticulo()->getStockMinimo();
        $zonaDepositoParam=$this->getArticulo()->getZonaDeposito();
        $proveedorParam=$this->getArticulo()->getProveedor();
        $unidadReferenciaParam=$this->getArticulo()->getUnidadReferencia();
        if(!$sentencia->execute() ){
            $mbd->rollBack(); //Si por algun motivo sugiera un problema en la carga de las categorias realizamos un ROLLBACK, al estado previo de la BD
            return FALSE;      
         }
    $mbd->commit();
    return TRUE;
}
    
    
    public function modificarArticulo($idarticulo){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("UPDATE articulos SET nombre_articulo= :nombreP, stock= :stockP, categoria=:categoriaP, precio_unitario=:precioP,
        stock_minimo=:stock_minimoP, zona_deposito=:zona_depositoP, proveedor=:proveedorP,  unidad_referencia=:unidad_referenciaP WHERE idarticulo= :idarticuloP;");
       $sentencia->bindParam(':nombreP',$nombreParam);
       $sentencia->bindParam(':stockP',$stockParam);
       $sentencia->bindParam(':categoriaP', $categoriaParam);
       $sentencia->bindParam(':precioP', $precioParam);
       $sentencia->bindParam(':idarticuloP',  $idarticulo);
       $sentencia->bindParam(':stock_minimoP',  $stockMinimoParam);
       $sentencia->bindParam(':zona_depositoP',  $zonaDepositoParam);
       $sentencia->bindParam(':proveedorP',  $proveedorParam);
       $sentencia->bindParam(':unidad_referenciaP',  $unidadReferenciaParam);
       
       
       $nombreParam=$this->getArticulo()->getNombre();
       $stockParam=$this->getArticulo()->getStock();
       $categoriaParam=$this->getArticulo()->getCategoria();
       $precioParam=$this->getArticulo()->getPrecioUnitario();
       $stockMinimoParam=$this->getArticulo()->getStockMinimo();
       $zonaDepositoParam=$this->getArticulo()->getZonaDeposito();
       $proveedorParam=$this->getArticulo()->getProveedor();
       $unidadReferenciaParam=$this->getArticulo()->getUnidadReferencia();

        if($sentencia->execute()){
            return True;
        }
        else{
            return False;
        }
    }
    public function darBajaArticulo($idarticulo){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("DELETE FROM articulos WHERE idarticulo= :idarticuloP;");
        $sentencia->bindParam(':idarticuloP',$idParam);
        $idParam= $idarticulo; 
        if( $sentencia->execute()){
            return True;
        }
        else{
            return False;
        }
    }
    public function alertasActivas(){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT COUNT(*) as alertas FROM articulos WHERE stock<= stock_minimo;");
        if( $sentencia->execute()){
            $datos = $sentencia->fetch(PDO::FETCH_OBJ);
            return $datos->alertas;
        }
        else{
            return 0;
        }
    }

}