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
        <h3><i class='fa fa-angle-right'></i> Modificar Usuario </h3>
        
            <hr>

            <div class="row mt">
          <div class="col-lg-9">
              <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Modifique los Datos del Usuario &nbsp&nbsp<img class="img-responsive" style="display:inline;" src="../assets/img/update.png" width="5%"></h4>




                  <form class="form-horizontal style-form" role="form" action="../controlador/controladorDeUsuario.php" method="POST">
                    <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Ingrese el nombre y apellido</label>
                          <div class="col-sm-10">
                          <input class="form-control"  name="idusuario" style="display: none;"  value=" <?=$_GET["idUsuario"]?>" >
                          <input type="text" class="form-control" placeholder="Nombre y Apellido" name="usuario" autofocus
                        minlength="4" maxlength="25" value="<?=$_GET["nombre"]?>" required>
                          </div>
                      </div>
                            
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Ingrese la dirección de correo electrónico</label>
                          <div class="col-sm-10">
                          <input type="email" class="form-control" placeholder="Correo electronico" name="correo_electronico" autofocus
                        minlength="4"  value="<?=$_GET["email"]?>" required>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Ingrese la dirección del usuario</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Domicilio" name="domicilio" autofocus
                        minlength="4" value="<?=$_GET["direccion"]?>" required>
                        </div>
                    </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Ingrese el número de teléfono del usuario</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Nmr. de telefono" name="telefono" autofocus
                        minlength="4"  value="<?=$_GET["telefono"]?>" required>
                </div>
            </div>
        
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Seleccionar Rol</label>
            <div class="col-sm-10">
            <select class="form-control form-control-lg" name="rol" value=" <?=$_GET["rol"]?>" required>
                        <option value="<?=$_GET["rol"]?>" style="display:none;"  selected><label><?=$_GET["rol"]?></label></option>
                        <option value="Usuario">Usuario Estandar</option>
                        <option value="Admin">Administrador</option>
                    </select>
            </div>
        </div>
        <div class="form-group">
        <div class="col-sm-10" >
        <div>Seleccionar Avatar</div>
                    <div class="container" >
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="1" name="avatar"> <img
                                        class="img-responsive" src="../assets/img/1.jpg" />
                                </label>
                            </div>
                            <div class="col-sm-1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="2" name="avatar"> <img
                                        class="img-responsive" src="../assets/img/2.jpg" />
                                </label>
                            </div>
                            <div class="col-sm-1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="3" name="avatar"> <img
                                        class="img-responsive" src="../assets/img/3.jpg" />
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="4" name="avatar"> <img
                                        class="img-responsive" src="../assets/img/4.jpg" />
                                </label>
                            </div>
                            <div class="col-sm-1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="5" name="avatar"> <img
                                        class="img-responsive" src="../assets/img/5.jpg" />
                                </label>
                            </div>
                            <div class="col-sm-1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="6" name="avatar"> <img
                                        class="img-responsive" src="../assets/img/6.jpg" />
                                </label>
                            </div>
                        </div>
                    </div>
        </div>
        </div>

        <div class="form-group">
          <div>&nbsp</div>
          <div class="btn-group btnRegis col-sm-6">
          <button type="submit" name="btnModificarUsuario" class="btn btn-primary "><i
                                            class="fa fa-pencil"></i>&nbsp Modificar Usuario &nbsp</button>
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