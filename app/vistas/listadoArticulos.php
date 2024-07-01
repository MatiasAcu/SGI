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
            <h3><i class='fa fa-angle-right'></i> Listado de Artículos</h3>

            <hr>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <?php 
                    include ("../modelo/proveedor.php");
                    if(isset($_GET["articulo"])){
                        $idarticulo=$_GET["articulo"];
                    
                    }else{
                        
                        $idarticulo=NULL;
                    }
                
                ?>
                                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                if($idarticulo!=NULL){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor
                                                                                        WHERE idarticulo=:articuloP ORDER BY(idarticulo)");
                                    $sentencia->bindParam(':articuloP',$idarticulo);
                                    $opcionParaImprimir="articulo=".$idarticulo;
                                }elseif(isset($_POST["categoria"])){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor
                                                                                        WHERE categoria=:idcategoriaP ORDER BY(idarticulo)");
                                    $sentencia->bindParam(':idcategoriaP', $_POST["categoria"]);
                                    $opcionParaImprimir="categoria=".$_POST["categoria"];
                                }elseif(isset($_POST["proveedor"])){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor
                                                                                        WHERE proveedor=:idproveedorP ORDER BY(idarticulo)");
                                    $sentencia->bindParam(':idproveedorP', $_POST["proveedor"]);
                                    $opcionParaImprimir="proveedor=".$_POST["proveedor"];
                                }elseif(isset($_GET["diferencia"])){
                                    $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                        INNER JOIN proveedores ON proveedor=idproveedor 
                                                                                        WHERE stock-stock_minimo<=:diferenciaP ORDER BY(idarticulo);");
                                    $sentencia->bindParam(':diferenciaP', $_GET["diferencia"]);
                                    $opcionParaImprimir="diferencia=".$_GET["diferencia"];
                                }else{   
                                $sentencia = $mbd->prepare("SELECT * FROM articulos INNER JOIN categorias ON categoria=idcategoria 
                                                                                    INNER JOIN proveedores ON proveedor=idproveedor
                                                                                    ORDER BY(idarticulo)");
                                 $opcionParaImprimir="";
                                }?>
                        <h4><i class="fa fa-angle-right"></i> Artículos Cargados en el Sistema<img
                                class="img-responsive" style="display:inline;" src="../assets/img/listado.png"
                                width="8%"><i class="fa fa"></i></h4>
                        <section id="unseen">
                            <button class="btn btn-danger" style="margin-bottom: 10px;" data-toggle="modal"
                                data-target="#Modal">
                                <i class="fa fa-code"></i>&nbsp Filtrar
                            </button>
                            <?php
                            echo '<a onclick="generarPDF(\'' . "../vistas/listadoParaImprimirArt.php?$opcionParaImprimir" . '\')" class="btn btn-pdf" style="margin-bottom: 10px;"  > <i class="fa fa-print"></i>&nbsp Generar PDF</a>'
                            
                            ?>

                            </br>
                            <table class="table table-bordered table-striped table-condensed"
                                style="max-height: 650px; overflow: auto;">
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
                                        <th>Lotes</th>
                                        <th>Precio Unitario</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {     
                                    ?>
                                    <form class="row g-3" role="form" method="post"
                                        action="../controlador/controladorDeProductos.php">
                                        <tr>
                                            <!--listado de usuarios dinamico-->
                                            <td><input style='display: none !important;' value="<?= $datos->codigo?>"
                                                    name="codigoArtículo" required>
                                                    <input style='display: none !important;' value="<?= $datos->idarticulo?>"
                                                    name="idarticulo" required><?= $datos->codigo?></td>
                                            <td><input style='display: none !important;' value="<?= $datos->nombre_articulo ?>"
                                                    name="nombre" required><?= $datos->nombre_articulo ?></td>
                                            <?php if(isset($_GET["diferencia"])){ ?>
                                            <td><span class="badge bg-important"><?= $datos->stock?></span></td>
                                            <td><span class="badge bg-info"><?= $datos->stock_minimo?></span></td>
                                            <input type='number' min="0" class='inputArticulos' value="<?= $datos->stock?>" name="stock"
                                                        required style="display:none;">
                                                        <input type='number' min="0" class='inputArticulos' value="<?= $datos->stock_minimo?>"
                                                        name="stockMinimo" required style="display:none;">
                                                    <?php }else{?>
                                                        <td><input type='number' min="0" class='inputArticulos' value="<?= $datos->stock?>" name="stock"
                                                        required></td>
                                                        <td><input type='number' min="0" class='inputArticulos' value="<?= $datos->stock_minimo?>"
                                                        name="stockMinimo" required></td> <?php } ?>
                                            <td><input style='display: none !important;'  value="<?= $datos->categoria?>"
                                                    name="categoria" required><?= $datos->nombre?></td>
                                            <td><input style='display: none !important;' value="<?= $datos->proveedor?>"
                                                    name="proveedor" required><?= $datos->nombre_proveedor?></td>
                                            <td><input class='inputArticulos' value="<?= $datos->zona_deposito?>"
                                                    name="zonaDeposito" required></td>
                                            <td><input class='inputArticulos' value="<?= $datos->unidad_referencia?>"
                                                    name="unidadReferencia" required></td>
                                            <td><div class="pull" style="display: flex;">
                                            <a href="../vistas/listadoDeLotes.php?articulo=<?=$datos->codigo?>"
                                                        class="btn btn-success btn-xs" style="margin: 1px;" name="btnVerLotes"><i
                                                            class="fa fa-eye"></i></a>
                                            </div></td>
                                            <td><input type="number" step="0.0001" min="0" class='inputArticulos' value="<?= $datos->precio_unitario?>"
                                                    name="precio_unitario" required></td>

                                            <td>
                                                <div class="pull" style="display: flex;">
                                                    <a href="../vistas/modificarArticulo.php?idarticulo=<?= $datos->idarticulo?>&nombre=<?= $datos->nombre_articulo?>&stockMin=<?= $datos->stock_minimo?>&stock=<?= $datos->stock?>&precio=<?= $datos->precio_unitario?>&categoria=<?= $datos->nombre?>&idcategoria=<?= $datos->categoria?>&codigo=<?= $datos->codigo?>&proveedor=<?= $datos->nombre_proveedor?>&idproveedor=<?= $datos->proveedor?>&unidadRef=<?= $datos->unidad_referencia?>&zonaDep=<?= $datos->zona_deposito?>"
                                                        class="btn btn-primary btn-xs" style="margin: 1px;" name="btnModificarArticulo"><i
                                                            class="fa fa-pencil"></i></a>

                                                    <button onclick="return actualizar()" type="sumbit"
                                                        class="btn btn-pdf btn-xs" style="margin: 1px;" name="btnModificarProducto"><i
                                                            class="fa fa-save"></i></button>
                                                    <a onclick="return eliminar()"
                                                        href="../controlador/controladorDeProductos.php?idarticulo=<?= $datos->idarticulo?>&BTNEC=1"
                                                        class="btn btn-danger btn-xs" style="margin: 1px;"><i class="fa fa-trash-o "></i></a>
                                                </div>

                                            </td>
                                        </tr>
                                        </form>
                                        <?php 
                                }
                                ?>
                                    
                                </tbody>
                            </table>
                        </section>

                        <?php include 'modalFiltros.php';  ?>
                      

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
    <script>
    function eliminar() {
        var respuesta = confirm("¿ESTA SEGURO DE DAR DE BAJA ESTE ARTÍCULO?");
        return respuesta;
    }
    </script>
     <script>
    function actualizar() {
        var respuesta = confirm("¿ESTA SEGURO DE MODIFICAR ESTE ARTÍCULO?");
        return respuesta;
    }
    </script>
    <script type="text/javascript">
    function generarPDF(url) {
        window.open(url, '_blank').focus();
    }
    </script>
</body>

</html>