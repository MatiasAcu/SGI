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
                    <table class="table table-bordered table-striped table-condensed"
                        style="max-height: 750px; overflow: auto;">
                        <thead>
                            <tr>
                                <th> <img src="../assets/img/logoSGISinFondo.png" style="width: 90px;" class="img-responsive"
                            alt="Logo Sistema Gestión de Inventario"></th>
                            <th colspan="6" >Listado de Proveedores</th>
</tr>
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Numero de Contacto</th>
                                <th>Email</th>
                                <th>Cuit</th>
                                <th>Contacto</th>
                                <th>Forma de Pago</th>
                            

                            </tr>
                        </thead>
                        <tbody>
                            <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM proveedores ORDER BY(idproveedor)");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
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