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
            <?php
                $usuarioingresado = $_SESSION['nombredelusuario'];
                echo "  <h3><i class='fa fa-angle-right'></i> Pagina en Construcción- No Disponible por el momento </h3>";
            ?>
        
            <hr>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-sm-2">
        </div>
        <div class="col-md-auto">
            <img src="../assets/img/logoSGISinFondoExpandido.png" class="img-responsive" alt="...">
        </div>
     
       
        <div class="col col-sm-2">

        </div>
    </div>
</div>

        </section>
    </section>

    <!--Final del contenido principal-->
    <section>

        <?php include 'footer.php';  ?>

    </section>

    <?php include 'seccionFinal.php';  ?>
</body>

</html>