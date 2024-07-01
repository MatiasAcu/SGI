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
            <h3><i class="fa fa-angle-right"></i> Manejo de Categorías </h3>
            <hr>
            <!--Tabla de Usuarios-->
            <div class="row mt">
                <div class="col-lg-7">
                    <div class="form-panel">
                        <h4><i class="fa fa-angle-right"></i> Categorías Cargadas en el Sistema<img class="img-responsive" style="display:inline;" src="../assets/img/listado.png" width="8%"><i class="fa fa"></i>
                        </h4>
                        <section id="unseen">
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal"
                                        style="margin-bottom: 10px;"><i class="fa fa-plus"></i>&nbsp Nueva Categoria
                                    </button>
                            <table class="table table-bordered table-striped table-condensed" style="max-height: 749px;
    overflow: auto;">
                                <thead>
                                    <tr>
                                        <th>Número Categoría</th>
                                        <th>Nombre de la Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //conexion con la BD
                               include ("../modelo/conexionPDO.php");
                               $sentencia = $mbd->prepare("SELECT * FROM categorias ORDER BY idcategoria");
                               $sentencia->execute();
                               while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                             
                                    ?>
                                    <tr>
                                        <!--listado de usuarios dinamico-->
                                        <td><?= $datos->idcategoria?></td>
                                        <td><?= $datos->nombre?></td>
                                        <td>
                                            <div class="pull">
                                                <a onclick="return eliminar()"
                                                    href="../controlador/controladorDeCategorias.php?idcategoriaElim=<?=$datos->idcategoria?>"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a> 
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>
                
                                </tbody>
                            </table>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-4 -->
            </div><!-- /row -->

        </section>
    </section><!-- /MAIN CONTENT -->

    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background:#516CE5;">
                                    <h5 class="modal-title" id="ModalLabel">Agregar Categoria</h5>

                                </div>
                                <div class="modal-body">
                                    <form action="../controlador/controladorDeCategorias.php?nuevaCategoria=1" method="POST"
                                        role=form>

                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Nombre de la
                                                Categoria:</label>
                                            <textarea class="form-control" id="categoria" name="categoria"
                                                requiere></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary"
                                            name="btnCargarCategoria">Guardar</button>
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
var respuesta = confirm("¿ESTA SEGURO DE DAR DE BAJA ESTA CATEGORIA?");
return respuesta;
}
</script>
</body>

</html>