<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
    if($_SESSION['rol']!="ADMINISTRADOR" && $_SESSION['rol']!="USUARIO ESTANDAR"){
        printf("NO TIENE PERMISO"); die;
    }?>

<head>
    <?php include 'encabezado.php';  ?>
</head>

<body>

    <section id="container">
    <?php 
                    include ("../modelo/proveedor.php");
                    if(isset($_GET["articulo"])){
                        $idarticulo=$_GET["articulo"];
                    
                    }else{
                        
                        $idarticulo=NULL;
                    }
                
                ?> 

    </section>
    <div class="row mt">
        <div class="col-lg-8">
            <div class="form-panel">
                <section id="unseen">
                <table class="table table-bordered table-striped table-condensed"
                                style="max-height: 650px; overflow: auto;">
                                <thead>
                                <tr>
                                <th> <img src="../assets/img/logoSGISinFondo.png" style="width: 90px;" class="img-responsive"
                            alt="Logo Sistema Gestión de Inventario"></th>
                            <th colspan="9" >Listado de Artículos</th>
</tr>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Stock Mínimo</th>
                                        <th>Categoría</th>
                                        <th>Proveedor</th>
                                        <th>Zona Deposito</th>
                                        <th>Unidad de Referencia</th>
                                        <th>Precio Unitario</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                if($idarticulo!=NULL){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor
                                                                                        WHERE idarticulo=:articuloP ORDER BY(idarticulo)");
                                    $sentencia->bindParam(':articuloP',$idarticulo);
                                }elseif(isset($_GET["categoria"])){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor
                                                                                        WHERE categoria=:idcategoriaP ORDER BY(idarticulo)");
                                    $sentencia->bindParam(':idcategoriaP', $_GET["categoria"]);
                                }elseif(isset($_GET["proveedor"])){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor
                                                                                        WHERE proveedor=:idproveedorP ORDER BY(idarticulo)");
                                    $sentencia->bindParam(':idproveedorP', $_GET["proveedor"]);
                                }elseif(isset($_GET["diferencia"])){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor 
                                                                                        WHERE stock-stock_minimo<=:diferenciaP ORDER BY(idarticulo);");
                                    $sentencia->bindParam(':diferenciaP', $_GET["diferencia"]);
                                }else{
                                $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                    INNER JOIN proveedores ON proveedor=idproveedor
                                                                                    ORDER BY(idarticulo)");
                                }
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {     
                                    ?>
                                    <tr>
                                        <!--listado de usuarios dinamico-->
                                        <td><?= $datos->codigo?></td>
                                        <td><?= $datos->nombre_articulo ?></td>
                                        <td><?= $datos->stock?></td>
                                        <td><?= $datos->stock_minimo?></td>
                                        <td><?= $datos->nombre?></td>
                                        <td><?= $datos->nombre_proveedor?></td>
                                        <td><?= $datos->zona_deposito?></td>
                                        <td><?= $datos->unidad_referencia?></td>
                                        <td><?= $datos->precio_unitario?></td>

                                    </tr>
                                    <?php 
                                }
                                ?>



                                </tbody>
                            </table>
                </section>
            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->



<?php include 'seccionFinal.php';  ?>

<script>
function generatePDF() {
print();
}
generatePDF();
</script>

</body>

</html>