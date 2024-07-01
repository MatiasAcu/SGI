<?php
include ("../dao/categoriaDAO.php");

class Categoria{
    private $nombre;


    public function __construct(){}

    public function constructorConParametros( $nombre){$this->nombre = $nombre; return $this;}

    public function getNombre() {return $this->nombre;}

	public function setNombre( $nombre): void {$this->nombre = $nombre;}

	//Dar de alta una Categoria
    public function cargarCategoria(){
        $resultado= False;
        $categoriaDAO= new CategoriaDAO($this);
        $resultado= $categoriaDAO->persistirCategoria();
        return $resultado;
    
    }
    public function cargarCategoriaNueva(){
        $resultado= False;
        $categoriaDAO= new CategoriaDAO($this);
        $resultado= $categoriaDAO->persistirCategoriaNueva();
        return $resultado;
    
    }

    //Validar una Categoria
    public function categoriaValida($codigoCategoria, $proveedor){
        $resultado= False;
        $categoriaDAO= new CategoriaDAO($this);
        $resultado= $categoriaDAO->validarCategoria($codigoCategoria,$proveedor);
        return $resultado;
    
    }
      //Dar de baja una Categoría
      public function eliminarCategoria($idcategoria){
        $resultado= False;
        $categoriaDAO= new CategoriaDAO($this);
        $resultado=$categoriaDAO->darBajaCategoria($idcategoria);
        return $resultado;
    }

}



?>