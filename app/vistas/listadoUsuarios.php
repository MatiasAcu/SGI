<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
    if($_SESSION['rol']!="ADMINISTRADOR"){
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
            <h3><i class="fa fa-angle-right"></i> Listado de Usuarios </h3>
            <hr>
            <!--Tabla de Usuarios-->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4><i class="fa fa-angle-right"></i> Usuarios Cargados en el Sistema<img class="img-responsive" style="display:inline;" src="../assets/img/listado.png" width="8%"><i class="fa fa"></i>
                        </h4>
                        <section id="unseen">
                        <form class="row g-3" role="form"><div class="col-lg-12">
                                <?php
                            echo '<a onclick="generarPDF(\'' . "../vistas/listadoParaImprimirUsu.php". '\')" class="btn btn-pdf" > <i class="fa fa-print"></i>&nbsp Generar PDF</a>'
                            
                            ?>
                                </div></form></br>
                            <table class="table table-bordered table-striped table-condensed" style="max-height: 749px;
    overflow: auto;">
                                <thead>
                                    <tr>
                                        <th>Número de Usuario</th>
                                        <th>Avatar</th>
                                        <th>Nombre de Usuario</th>
                                        <th>Teléfono</th>
                                        <th>Correo Electrónico</th>
                                        <th>Rol dentro del Sistema</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //conexion con la BD
                               include ("../modelo/conexionPDO.php");
                               $sentencia = $mbd->prepare("SELECT * FROM usuarios ORDER BY nombre_de_usuario");
                               $sentencia->execute();
                               while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                             
                                    //Seleccion del Rol
                                    if($datos->rol==1){
                                        $rol='Administrador';
                                       } elseif($datos->rol==2){
                                        $rol='Usuario Estandar';
                                       }
                                    ?>
                                    <tr>
                                        <!--listado de usuarios dinamico-->
                                        <td><?= $datos->idusuario?></td>
                                        <td><?= "<img src='../assets/img/$datos->avatar.jpg' class='img-rectangle' width='30'>"; ?>
                                        </td>
                                        <td><?= $datos->nombre_de_usuario?></td>
                                        <td><?= $datos->telefono?></td>
                                        <td><?= $datos->email?></td>
                                        <td><?= $rol?></td>

                                        <td>
                                            <div class="pull">
                                            <a href="../vistas/modificarUsuario.php?idUsuario=<?= $datos->idusuario?>&nombre=<?=$datos->nombre_de_usuario?>&direccion=<?=$datos->domicilio?>&rol=<?=$rol?>&email=<?=$datos->email?>&telefono=<?=$datos->telefono?>"
                                                    class="btn btn-primary btn-xs" name="btnModificarCuenta"><i
                                                        class="fa fa-pencil"></i></a>
                                            <?php if($datos->rol!=3){   ?>
                                                <a onclick="return eliminar()"
                                                    href="../controlador/controladorDeUsuario.php?usuarioEleg=<?=$datos->nombre_de_usuario?>&usuarioAc=<?=$nombreUsuario?>"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a> 
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php }
                                ?>

                                </tbody>
                            </table>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-4 -->
            </div><!-- /row -->

        </section>
    </section><!-- /MAIN CONTENT -->



     <!--Final del contenido principal-->
     <section>

<?php include 'footer.php';  ?>

</section>

<?php include 'seccionFinal.php';  ?>
<script>
function eliminar() {
var respuesta = confirm("¿ESTA SEGURO DE DAR DE BAJA ESTE USUARIO?");
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