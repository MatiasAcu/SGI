<?php
include ("../dao/loteDAO.php");

class Lote{

private $codigoArticulo;
private $fechaLote;
private $descripcion;

public function constructorConParametros( $codigoArticulo,  $fechaLote,  $descripcion){
    $this->codigoArticulo = $codigoArticulo;
    $this->fechaLote = $fechaLote;
    $this->descripcion = $descripcion;
return $this;}
	
public function getCodigoArticulo() {return $this->codigoArticulo;}

	public function getFechaLote() {return $this->fechaLote;}

	public function getDescripcion() {return $this->descripcion;}

	public function setCodigoArticulo( $codigoArticulo): void {$this->codigoArticulo = $codigoArticulo;}

	public function setFechaLote( $fechaLote): void {$this->fechaLote = $fechaLote;}

	public function setDescripcion( $descripcion): void {$this->descripcion = $descripcion;}

	

//Dar de alta un Lote
public function cargarLote(){
    $resultado= False;
    $loteDAO= new LoteDAO($this);
    $resultado= $loteDAO->persistirLote();
    return $resultado;
}

//Modificar un Lote
public function modificarLote($idLote){
    $resultado= False;
    $loteDAO= new LoteDAO($this);
    $resultado= $loteDAO->modificarLote($idLote);
    return $resultado;
}
//Eliminar un Lote
public function eliminarLote($idLote){
    $resultado= False;
    $loteDAO= new LoteDAO($this);
    $resultado= $loteDAO->eliminarLote($idLote);
    return $resultado;
}
}



?>