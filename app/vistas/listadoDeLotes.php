<?php
    session_start();?>
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
            <h3><i class='fa fa-angle-right'></i> Lotes del artículo codigo: <?=$_GET["articulo"]?> </h3>

            <hr>

            <div class="row mt">
                <div class="col-lg-8">
                    <div class="form-panel">
                        <h4 style="margin-bottom: -20px"><i class="fa fa-angle-right"></i> Filtrar por Fecha de Caducidad</h4>
                  
                
                        <form class="row g-3" role="form" method="GET" action="../vistas/listadoDeLotes.php">
                            <div class="col-lg-7">
                                <span class="help-block">&nbsp</span>
                                <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Ingrese la fecha por la cual desea filtrar </label>
                                <div class="col-sm-8">
                                    <input type="date"  class="form-control" placeholder="Fecha de Caducidad"
                                        name="fechaCaducidad" requiered>
                                        <input value="<?=$_GET["articulo"]?>" class="form-control" style="display:none;"
                                        name="articulo" requiered>
                                </div>
                            </div>
                               
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
                        <h4><i class="fa fa-angle-right"></i> Lotes Cargados en el Sistema para este artículo<img
                                class="img-responsive" style="display:inline;" src="../assets/img/listado.png"
                                width="8%"><i class="fa fa"></i></h4>
                        <section id="unseen">
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal"
                                        style="margin-bottom: 10px;"><i class="fa fa-plus"></i>&nbsp Nuevo Lote
                                    </button>

                            <form class="row g-3" role="form" method="GET" action="../vistas/listadoDeLotes.php">
                            <input value="<?=$_GET["articulo"]?>" class="form-control" style="display:none;"
                            name="articulo" requiered>
                                <div class="col-lg-12">
                                    <button type="sumbit" class="btn btn-success btn-sm" name=""><i class="fa fa-eye"></i>&nbsp
                                        Ver Todos los Lotes&nbsp</button>

                                </div>
                            </form>
                        

                            </br>
                            <table class="table table-bordered table-striped table-condensed" style="max-height: 750px;
    overflow: auto;">
                                <thead>
                                    <tr>
                                        <th>Referencia Número</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Caducidad del Lote</th>
                                       <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                if(isset($_GET["fechaCaducidad"])){
                                    $sentencia = $mbd->prepare("SELECT * FROM lotes WHERE codigo_articulo=:codigoP AND fecha_lote<=:fechaP ORDER BY(id_lote)");
                                    $sentencia->bindParam(':codigoP',  $codigoParam);
                                    $sentencia->bindParam(':fechaP',  $fechaParam);
                                    $codigoParam=$_GET["articulo"];
                                    $fechaParam=$_GET["fechaCaducidad"];
                                   
                                }else{
                                    $sentencia = $mbd->prepare("SELECT * FROM lotes WHERE codigo_articulo=:codigoP ORDER BY(id_lote)");
                                    $sentencia->bindParam(':codigoP',  $codigoParam);
                                    $codigoParam=$_GET["articulo"];
                                }
                                $sentencia->execute();

                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                    <tr>
                                    <form class="row g-3" role="form" method="post"
                                    action="../controlador/controladorDeLotes.php">
                                        <!--listado de usuarios dinamico-->
                                        <td><input class='inputArticulos' value="<?=$datos->id_lote?>"
                                        name="idLote" required style="display:none;">
                                        <input value="<?=$_GET["articulo"]?>" name="codigoArtículo"class="form-control" style="display:none;">
                                        <?=$datos->id_lote?></td>
                                        <td><input class='inputArticulos' value="<?=$datos->descripcion ?>"
                                        name="descripcion" required></td>
                                        <td><input type="date" class='inputArticulos' value="<?=$datos->fecha_lote?>"
                                        name="fechaLote" required></td>
                                        
                                        <td>
                                            <div class="pull">
                                               <button onclick="return actualizar()" type="sumbit"
                                                    class="btn btn-pdf btn-xs" name="btnModificarLote"><i
                                                        class="fa fa-save"></i></button>
                                                <a onclick="return eliminar()"
                                                        href="../controlador/controladorDeLotes.php?idlote=<?= $datos->id_lote?>&articulo=<?=$_GET["articulo"]?>&BTNEC=1"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                            </div>

                                        </td>
                                        </form>
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
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background:#516CE5;">
                                    <h5 class="modal-title" id="ModalLabel">Agregar Lote</h5>

                                </div>
                                <div class="modal-body">
                                    <form action="../controlador/controladorDeLotes.php?" method="POST"
                                        role=form>
                                        <label for="message-text" class="col-form-label">Fecha de Caducidad:</label>
                                        <input type="date"  class="form-control" placeholder="Fecha de Caducidad"
                                        name="fechaLote"  min="<?=date("Y-m-d")?>"  requiered>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Descripción:</label>
                                            <textarea class="form-control" id="descripcion" name="descripcion"
                                                 requiered></textarea>
                                        </div>
                                        <input value="<?=$_GET["articulo"]?>" class="form-control" style="display:none;"
                                        name="codigoArtículo" requiered>
                                        <button type="submit" class="btn btn-primary"
                                            name="btnCargarLote">Guardar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>


    <!--Final del contenido principal-->
    <section>

        <?php include 'footer.php';  ?>

    </section>

    <?php include 'seccionFinal.php';  ?>
    <script>
    function eliminar() {
        var respuesta = confirm("¿ESTA SEGURO DE DAR DE BAJA ESTE LOTE?");
        return respuesta;
    }
    </script>
         <script>
    function actualizar() {
        var respuesta = confirm("¿ESTA SEGURO DE MODIFICAR ESTE LOTE?");
        return respuesta;
    }
    </script>

</body>

</html>