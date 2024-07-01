<?php

class PedidoDAO{
   private $pedido;

  
    public function __construct($pedido){
        $this->pedido=$pedido;
        
    }

	
public function getPedido() {return $this->pedido;}

public function setPedido( $pedido): void {$this->pedido = $pedido;}

	


    public function persistirPedido(){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("INSERT INTO pedidos(proveedor, descripcion, articulo, cantidad, estado, fecha) 
        values(:proveedorP, :descripcionP, :articuloP, :cantidadP, :estadoP, :fechaP)");
        $sentencia->bindParam(':proveedorP',$proveedorParam);
        $sentencia->bindParam(':descripcionP',$descripcionParam);
        $sentencia->bindParam(':articuloP', $articuloParam);
        $sentencia->bindParam(':cantidadP', $cantidadParam);
        $sentencia->bindParam(':estadoP',  $estadoParam);
        $sentencia->bindParam(':fechaP',  $fechaParam);
        
        
        $proveedorParam=$this->getPedido()->getProveedor();
        $descripcionParam=$this->getPedido()->getReferencia();
        $articuloParam=$this->getPedido()->getArticulo();
        $cantidadParam=$this->getPedido()->getCantidad();
        $estadoParam=$this->getPedido()->getEstado();
        $fechaParam=$this->getPedido()->getFecha();
      

        if($sentencia->execute()){
            return True;
        }
        else{
            return False;
        }
    }

    public function darBajaPedido($idpedido){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("DELETE FROM pedidos WHERE idpedido= :idPedidoP;");
        $sentencia->bindParam(':idPedidoP',$idParam);
        
        $idParam= $idpedido; 
        if($sentencia->execute()){
            return True;
        }
        else{
            return False;
        }
    }
    public function modificarPedido($idpedido){
        include ("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("UPDATE pedidos SET cantidad= :cantidadP, estado= :estadoP, fecha=:fechaP, descripcion=:descripcionP WHERE idpedido=:idpedidoP;");
       $sentencia->bindParam(':cantidadP',$cantidadParamParam);
       $sentencia->bindParam(':estadoP',$estadoParam);
       $sentencia->bindParam(':fechaP', $fechaParam);
       $sentencia->bindParam(':descripcionP', $descripcionParam);
       $sentencia->bindParam(':idpedidoP',  $idpedido);
    
       
       $cantidadParamParam=$this->getPedido()->getCantidad();
       $estadoParam=$this->getPedido()->getEstado();
       $fechaParam=$this->getPedido()->getFecha();
       $descripcionParam=$this->getPedido()->getReferencia();
       
        if($sentencia->execute()){
            return True;
        }
        else{
            return False;
        }
    }
}