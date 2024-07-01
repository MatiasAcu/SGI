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
            <h3><i class='fa fa-angle-right'></i> Listado de Proveedores </h3>

            <hr>

            <div class="row mt">
                <div class="col-lg-8">
                    <div class="form-panel">
                        <h4 style="margin-bottom: -20px"><i class="fa fa-angle-right"></i> Buscar por Nombre</h4>
                        <?php 
                    include ("../modelo/proveedor.php");
                    if(isset($_GET["proveedor"])){
                        $idproveedor=$_GET["proveedor"];
                    
                    }else{
                        
                        $idproveedor=NULL;
                    }
                
                ?>
                        <form class="row g-3" role="form" method="GET" action="../vistas/listadoProveedores.php">
                            <div class="col-lg-7">
                                <span class="help-block">&nbsp</span>
                                <td colspan="2"><input class="form-control form-control-lg" type="search"
                                        name="proveedor" list="listaProveedores" required></td>
                                <datalist id="listaProveedores">
                                    </option>
                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM proveedores;");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                    <option value="<?=$datos->nombre_proveedor?>"><?=$datos->idproveedor?> :
                                        <?=$datos->nombre_proveedor?></option>
                                    <?php 
                                }
                                ?>
                                </datalist>
                            </div>


                            <div class="col-lg-3">
                                <span class="help-block">&nbsp</span>
                                <button type="sumbit" class="btn btn-danger" name=""><i class="fa fa-code"></i>&nbsp
                                    Filtrar &nbsp</button>
                            </div>

                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4><i class="fa fa-angle-right"></i> Proveedores Cargados en el Sistema<img
                                class="img-responsive" style="display:inline;" src="../assets/img/listado.png"
                                width="8%"><i class="fa fa"></i></h4>
                        <section id="unseen">
                            <form class="row g-3" role="form" method="GET" action="../vistas/listadoProveedores.php">
                                <div class="col-lg-12">
                                <?php
                            echo '<a onclick="generarPDF(\'' . "../vistas/listadoParaImprimirProv.php". '\')" class="btn btn-pdf" > <i class="fa fa-print"></i>&nbsp Generar PDF</a>'
                            
                            ?>
                                    <button type="sumbit" class="btn btn-success" name=""><i class="fa fa-eye"></i>&nbsp
                                        Ver Todos los Proveedores&nbsp</button>

                                </div>
                            </form>

                            </br>
                            <table class="table table-bordered table-striped table-condensed" style="max-height: 750px;
    overflow: auto;">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Numero de Contacto</th>
                                        <th>Email</th>

                                        <th>Cuit</th>
                                        <th>Contacto</th>
                                        <th>Forma de Pago</th>
<th>Categorias</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                if($idproveedor!=NULL){
                                    $sentencia = $mbd->prepare("SELECT * FROM proveedores WHERE nombre_proveedor=:idproveedorP ORDER BY(idproveedor)");
                                    $sentencia->bindParam(':idproveedorP',$idproveedor);
                                }else{
                                    $sentencia = $mbd->prepare("SELECT * FROM proveedores ORDER BY(idproveedor)");
                                }
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                     $sentencia1 = $mbd->prepare("SELECT * FROM categorias as c INNER JOIN categorias_proveedores as a ON c.idcategoria=a.idcategoria where a.idproveedor=:idproveedorP ORDER BY c.nombre;");
                                    $sentencia1->bindParam(':idproveedorP',$idParam);
                                    $idParam= $datos->idproveedor; 
                                    $sentencia1->execute();         
                                    ?>
                                    <tr>
                                        <!--listado de usuarios dinamico-->
                                        <td><?= $datos->nombre_proveedor?></td>
                                        <td><?= $datos->domicilio ?></td>
                                        <td><?= $datos->numero_telefono?></td>
                                        <td><?= $datos->email?></td>
                                        <td><?= $datos->numero_cuit?></td>
                                        <td><?= $datos->persona_contacto?></td>
                                        <td><?= $datos->forma_pago?></td>
 <td>  <select name="categoria" id="categoria" class="form-control" required>
                                        <option selected value="" disabled> Categorías</option>
                                        //conexion con la BD
                                <?php while($datos1= $sentencia1->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                        <option value="<?= $datos1->idcategoria?>"><?= $datos1->nombre?></option>
                                        <?php 
                                }
                                ?>
                                    </select></td>
                                        <td>
                                            <div class="pull">
                                                <a href="../vistas/modificarProveedor.php?idproveedor=<?= $datos->idproveedor?>&nombre=<?= $datos->nombre_proveedor ?>&direccion=<?= $datos->domicilio?>&numero_telefono=<?= $datos->numero_telefono?>&email=<?= $datos->email?>&numero_cuit=<?= $datos->numero_cuit?>&persona_contacto=<?= $datos->persona_contacto?>&forma_pago=<?= $datos->forma_pago?>"
                                                    class="btn btn-primary btn-xs" name="btnModificarCuenta"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a onclick="return eliminar()"
                                                    href="../controlador/controladorDeProveedores.php?idproveedor=<?= $datos->idproveedor?>&BTNEC=1"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
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
    <script>
    function eliminar() {
        var respuesta = confirm("¿ESTA SEGURO DE DAR DE BAJA ESTE PROVEEDOR?");
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