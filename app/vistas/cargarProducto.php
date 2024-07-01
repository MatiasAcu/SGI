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
            <h3><i class='fa fa-angle-right'></i> Carga de Artículos</h3>
            <hr>

            <div class="row mt">
                <div class="col-lg-8">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Ingrese los datos del Artículo
                            <img class="img-responsive" style="display:inline;" src="../assets/img/nuevo.png"
                                width="10%">
                        </h4>



                        <form class="form-horizontal style-form" role="form"
                            action="../controlador/controladorDeProductos.php" method="POST">
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Codigo del artículo</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Codigo" name="codigoArtículo"
                                        requiered>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Ingrese el nombre/descripción del
                                    artículo</label>
                                <div class="col-sm-8">
                                    <textarea type="text" name="nombre" class="form-control" id="nombre"
                                        placeholder="Nombre" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Ingrese el stock actual del
                                    artículo</label>
                                <div class="col-sm-8">
                                    <input type="number" min="0" class="form-control" name="stock" id="stock"
                                        placeholder="Stock actual" requiered>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Ingrese el Precio por unidad</label>
                                <div class="col-sm-8">
                                    <input type="number" step="0.0001" min="0" class="form-control" name="precio_unitario"
                                        id="precio_unitario" placeholder="Precio unitario" requiered>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Ingrese el stock mínimo del
                                    artículo</label>
                                <div class="col-sm-8">
                                    <input type="number" min="0" class="form-control" name="stockMinimo" id="stockMinimo"
                                        placeholder="Stock mínimo" requiered>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Ingrese la zona de depósito</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Zona de depósito"
                                        name="zonaDeposito" requiered>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Ingrese la unidad de referencia</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Unidad de referencia"
                                        name="unidadReferencia" requiered>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Seleccione un proveedor</label>
                                <div class="col-sm-8">
                                    <select name="proveedor" id="proveedor" class="form-control" required>
                                        <option selected value="" disabled> Proveedores</option>
                                        <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM proveedores ORDER BY nombre_proveedor;");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                        <option value="<?= $datos->idproveedor?>"><?= $datos->nombre_proveedor?></option>
                                        <?php 
                                }
                                ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Seleccione una categoría</label>
                                <div class="col-sm-8">
                                    <select name="categoria" id="categoria" class="form-control" required>
                                        <option selected value="" disabled> Categorías</option>
                                        <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM categorias ORDER BY nombre;");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                        <option value="<?= $datos->idcategoria?>"><?= $datos->nombre?></option>
                                        <?php 
                                }
                                ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>&nbsp</div>
                                <div class="btn-group btnRegis col-sm-6">
                                    <button type="submit" name="btnCargarArticulo" class="btn btn-danger"><i
                                            class="fa fa-check"></i>&nbsp Agregar artículo &nbsp</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div><!-- col-lg-12-->
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