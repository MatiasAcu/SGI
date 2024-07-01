<?php

class LoteDAO{
   private $lote;

   public function __construct( $lote){$this->lote = $lote;}
	public function getLote() {return $this->lote;}

	public function setLote( $lote): void {$this->lote = $lote;}

	


public function persistirLote(){
    include ("../modelo/conexionPDO.php");
    $mbd->beginTransaction();
    $sentencia = $mbd->prepare("INSERT INTO lotes(codigo_articulo, descripcion, fecha_lote) 
    values(:codigo_articuloP, :descripcionP, :fecha_loteP)");
    $sentencia->bindParam(':codigo_articuloP',  $codigoParam);
    $sentencia->bindParam(':fecha_loteP',  $fechaParam);
    $sentencia->bindParam(':descripcionP',  $descripcionParam);
    $codigoParam=$this->getLote()->getCodigoArticulo();
    $fechaParam=$this->getLote()->getFechaLote();
    $descripcionParam=$this->getLote()->getDescripcion();
    if(!$sentencia->execute() ){
        $mbd->rollBack(); 
    return FALSE;      
     }
$mbd->commit();
return TRUE;
}
public function modificarLote($idLote){
    include ("../modelo/conexionPDO.php");
    $mbd->beginTransaction();
    $sentencia = $mbd->prepare("UPDATE lotes SET descripcion=:descripcionP, fecha_lote=:fecha_loteP WHERE id_lote=:idloteP;");
    $sentencia->bindParam(':idloteP',  $idLote);
    $sentencia->bindParam(':fecha_loteP',  $fechaParam);
    $sentencia->bindParam(':descripcionP',  $descripcionParam);
    $fechaParam=$this->getLote()->getFechaLote();
    $descripcionParam=$this->getLote()->getDescripcion();
    if(!$sentencia->execute() ){
        $mbd->rollBack(); 
    return FALSE;      
     }
$mbd->commit();
return TRUE;
}
public function eliminarLote($idLote){
    include ("../modelo/conexionPDO.php");
    $mbd->beginTransaction();
    $sentencia = $mbd->prepare("DELETE FROM lotes WHERE id_lote=:idloteP;");
    $sentencia->bindParam(':idloteP',  $idLote);
   
    if(!$sentencia->execute() ){
        $mbd->rollBack(); 
    return FALSE;      
     }
$mbd->commit();
return TRUE;
}


}
?>