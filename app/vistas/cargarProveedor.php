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
            <h3><i class='fa fa-angle-right'></i> Carga de Proveedores</h3>
            <hr>

            <div class="row mt">
                <div class="col-lg-9">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Ingrese los datos del nuevo proveedor
                            <img class="img-responsive" style="display:inline;" src="../assets/img/nuevo.png"
                                width="8%">
                        </h4>


                        <?php 
                include ("../controlador/controladorDeProveedores.php");
                $controladorDeProveedores= new ControladorDeProveedores();
                $numeroProveedor= $controladorDeProveedores->numeroDeProveedorParaCargar();
                
               
                ?>

                        <form class="form-horizontal style-form" role="form"
                            action="../controlador/controladorDeProveedores.php" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Codigo de Proveedor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="" name="numeroProveedor"
                                        value=" <?=$numeroProveedor?>" disabled>
                                    <input type="text" name="codigo" class="form-control" id="codigo"
                                        value="<?=$numeroProveedor?>" style="display: none;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Ingrese el nombre del proveedor</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nombre" class="form-control" id="nombre"
                                        placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Ingrese la dirección del
                                    proveedor</label>
                                <div class="col-sm-10">
                                    <input type="text" name="direccion" class="form-control" id="direccion"
                                        placeholder="Dirección" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Telefono</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" name="telefono" id="telefono"
                                        placeholder="Número de telefono" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Ingrese Email del proveedor</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Cuit</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" name="cuit" id="cuit"
                                        placeholder="Numero de Cuit" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Ingrese la Persona de Contacto del
                                    proveedor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="personaContacto" id="personaContacto"
                                        placeholder="Persona de Contacto" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Ingrese la Forma de Pago del
                                    proveedor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="formaPago" id="formaPago"
                                        placeholder="Forma de Pago" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Seleccione las Categorias del
                                    proveedor</label>
                                <div class="col-sm-10">
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal"
                                        style="margin-bottom: 10px;"><i class="fa fa-plus"></i>&nbsp Nueva Categoria
                                    </button>
                                </div>
                                <div class="col-sm-10">
                                    <select multiple="multiple" name="categorias[]" id="categorias" class="form-control"
                                        required>
                                       
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
                                <label class="col-sm-10 col-sm-10 control-label"> <p>Para seleccionar más de una categoría presionar Ctrl y seleccionarlas</p></label>
                               
                            </div>

                    


                    <div class="form-group">
                        <div>&nbsp</div>
                        <div class="btn-group btnRegis col-sm-6">
                            <button type="submit" name="btnCargarProveedor" class="btn btn-danger "><i
                                    class="fa fa-check"></i>&nbsp Agregar Proveedor &nbsp</button>
                        </div>
                    </div>

                    </form>



                    <?php include 'modalCategoria.php';  ?>



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