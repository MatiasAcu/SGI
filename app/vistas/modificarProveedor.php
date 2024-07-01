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
        <h3><i class='fa fa-angle-right'></i> Modificar Proveedor </h3>
        
            <hr>

            <div class="row mt">
          <div class="col-lg-9">
              <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Modifique los Datos del Proveedor &nbsp&nbsp<img class="img-responsive" style="display:inline;" src="../assets/img/update.png" width="5%"></h4>




                  <form class="form-horizontal style-form" role="form" action="../controlador/controladorDeProveedores.php"
                                method="POST">
                    <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Codigo de Proveedor</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="" name="idproveedor"
                                    value="<?=$_GET["idproveedor"]?>" disabled>
                                    <input type="text" class="form-control" placeholder="" name="idproveedor"
                                    value="<?=$_GET["idproveedor"]?>" style="display:none;">
                          </div>
                      </div>
                            
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Nombre del proveedor</label>
                          <div class="col-sm-10">
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" 
                            value="<?=$_GET["nombre"]?>" disabled >
<input type="text" class="form-control" placeholder="" name="nombre"
                                    value="<?=$_GET["nombre"]?>" style="display:none;">
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Dirección del proveedor</label>
                        <div class="col-sm-10">
                          <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección" 
                          value="<?=$_GET["direccion"]?>" required >
                        </div>
                    </div>
                  
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Número de telefono"
                  value="<?=$_GET["numero_telefono"]?>" required >
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Email del proveedor</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" 
                value="<?=$_GET["email"]?>" required >
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Ingrese la Persona de Contacto del proveedor</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="personaContacto"  value="<?=$_GET["persona_contacto"]?>" id="personaContacto" placeholder="Persona de Contacto" required >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Cuit</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="cuit" id="cuit" placeholder="Numero de Cuit"  value="<?=$_GET["numero_cuit"]?>"required >
            </div>
        </div>
      
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Ingrese la Forma de Pago del proveedor</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="formaPago"  value="<?=$_GET["forma_pago"]?>" id="formaPago" placeholder="Forma de Pago" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Seleccione las Categorias del proveedor</label>
            <div class="col-sm-10">
            <select   multiple="multiple" name="categorias[]" id="categorias" class="form-control"  required >
                <option value="" disabled> Categorias</option>
                <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia1 = $mbd->prepare("SELECT * FROM categorias as c INNER JOIN categorias_proveedores as a ON c.idcategoria=a.idcategoria where a.idproveedor=:idproveedorP ORDER BY c.nombre;");
                                $sentencia = $mbd->prepare("SELECT * FROM categorias where idcategoria NOT IN (SELECT idcategoria FROM categorias_proveedores WHERE idproveedor=:idproveedorP);");
                                $sentencia->bindParam(':idproveedorP',$idParam);
                                $sentencia1->bindParam(':idproveedorP',$idParam);
                                $idParam=$_GET["idproveedor"]; 
                                $sentencia1->execute();
                                $sentencia->execute();
                                while($datos1= $sentencia1->fetch(PDO::FETCH_OBJ)) {
                                              
                                  ?>
                                      <option selected value="<?= $datos1->idcategoria?>"><?= $datos1->nombre?></option>
                                      <?php 
                              }
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                    <option value="<?= $datos->idcategoria?>"><?= $datos->nombre?></option>
                                    <?php 
                                }
                                ?>
              </select>
            </div>
            <label class="col-sm-10 col-sm-10 control-label"> <p>Nota: No olvide seleccionar las categorias</p></label>
            <label class="col-sm-10 col-sm-10 control-label"> <p>Para seleccionar más de una categoría presionar Ctrl y seleccionarlas</p></label>
        </div>

        <div class="form-group">
          <div>&nbsp</div>
          <div class="btn-group btnRegis col-sm-6">
          <button type="submit" name="btnModificarProveedor" class="btn btn-primary "><i
                                            class="fa fa-pencil"></i>&nbsp Modificar Proveedor &nbsp</button>
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