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
        <?php include 'barraSuperior.php';  ?>

        <?php if($_SESSION['rol']=="ADMINISTRADOR"){
            include 'menu_administrador.php'; } ?>
         <?php if($_SESSION['rol']=="USUARIO ESTANDAR"){
            include 'menu_usuario_est.php'; } ?>

    </section>

    <!-- **********************************************************************************************************************************************************
     Contenido Principal
      *********************************************************************************************************************************************************** -->

    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class='fa fa-angle-right'></i> Avisos de Stock</h3>
        
            <hr>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4><i class="fa fa-angle-right"></i> Artículos con Stock menor o igual al Stock mínimo<img class="img-responsive" style="display:inline;" src="../assets/img/listado.png" width="8%"><i class="fa fa"></i></h4>
                        <section id="unseen">
                    
                            <table class="table table-bordered table-striped table-condensed" style="max-height: 650px; overflow: auto;">
                                <thead>
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
                                        
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                    INNER JOIN proveedores ON proveedor=idproveedor WHERE stock<=stock_minimo
                                                                                    ORDER BY(idarticulo)");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {     
                                    ?>
                                    <tr>
                                        <!--listado de usuarios dinamico-->
                                        <td> <span class="badge bg-warning"><?= $datos->codigo?></span></td>
                                        <td><?= $datos->nombre_articulo ?></td>
                                        <td> <span class="badge bg-important"><?= $datos->stock?></span></td>
                                        <td><span class="badge bg-info"><?= $datos->stock_minimo?></span></td>
                                        <td><?= $datos->nombre?></td>
                                        <td><?= $datos->nombre_proveedor?></td>
                                        <td><?= $datos->zona_deposito?></td>
                                        <td><?= $datos->unidad_referencia?></td>
                                        <td><?= $datos->precio_unitario?></td>
                                    
                                        <td>
                                            <div class="pull">
                                                <a href="../vistas/modificarArticulo.php?idarticulo=<?= $datos->idarticulo?>&nombre=<?= $datos->nombre_articulo?>&stockMin=<?= $datos->stock_minimo?>&stock=<?= $datos->stock?>&precio=<?= $datos->precio_unitario?>&categoria=<?= $datos->nombre?>&idcategoria=<?= $datos->categoria?>&codigo=<?= $datos->codigo?>&proveedor=<?= $datos->nombre_proveedor?>&idproveedor=<?= $datos->proveedor?>&unidadRef=<?= $datos->unidad_referencia?>&zonaDep=<?= $datos->zona_deposito?>"
                                                    class="btn btn-primary btn-xs" name="btnModificarArticulo"><i
                                                        class="fa fa-pencil"></i></a>
                                            </div>

                                        </td>
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

        </section>
    </section>

    <!--Final del contenido principal-->
    <section>

        <?php include 'footer.php';  ?>

    </section>

    <?php include 'seccionFinal.php';  ?>
    
</body>

</html>