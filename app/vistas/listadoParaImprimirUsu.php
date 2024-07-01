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


    </section>
    <div class="row mt">
        <div class="col-lg-8">
            <div class="form-panel">
                <section id="unseen">
                <table class="table table-bordered table-striped table-condensed" style="max-height: 749px;
    overflow: auto;">
                                <thead>
                                <tr>
                                <th> <img src="../assets/img/logoSGISinFondo.png" style="width: 90px;" class="img-responsive"
                            alt="Logo Sistema Gestión de Inventario"></th>
                            <th colspan="6" >Listado de Usuarios</th>
</tr>
                                    <tr>
                                        <th>Número de Usuario</th>
                                        <th>Avatar</th>
                                        <th>Nombre de Usuario</th>
                                        <th>Teléfono</th>
                                        <th>Correo Electrónico</th>
                                        <th>Rol dentro del Sistema</th>
                                        
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

                                    </tr>
                                    <?php }
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