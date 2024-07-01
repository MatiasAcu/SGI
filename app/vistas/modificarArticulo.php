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
        <h3><i class='fa fa-angle-right'></i> Modificar Artículo </h3>
        
            <hr>

            <div class="row mt">
          <div class="col-lg-8">
              <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Modifique los Datos del Artículo &nbsp&nbsp<img class="img-responsive" style="display:inline;" src="../assets/img/update.png" width="5%"></h4>




                  <form class="form-horizontal style-form" role="form" action="../controlador/controladorDeProductos.php"
                                method="POST">
                    <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Codigo de Artículo</label>
                          <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name=""
                                    value=" <?=$_GET["codigo"]?>" disabled>
                                    <input type="text" class="form-control" placeholder="" name="idarticulo"
                                    value="<?=$_GET["idarticulo"]?>" style="display:none;">
                                    <input type="text" class="form-control" placeholder="" name="codigoArtículo"
                                    value="<?=$_GET["codigo"]?>" style="display:none;">
                          </div>
                      </div>
                            
                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Nombre del Artículo</label>
                          <div class="col-sm-8">
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="<?=$_GET["nombre"]?>" 
                            value="<?=$_GET["nombre"]?>" required >
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label">Stock</label>
                                <div class="col-sm-8">
                                    <input type="number" min="0" class="form-control" name="stock" id="stock"
                                        placeholder="<?=$_GET["stock"]?>" value="<?=$_GET["stock"]?>"requiered>
                                </div>
                        </div>
                  <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label"> Precio Unitario</label>
                    <div class="col-sm-8">
                      <input type="number" step="0.0001" min="0" class="form-control" name="precio_unitario" id="precio_unitario" placeholder="Precio unitario" 
                      value="<?=$_GET["precio"]?>" required >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Stock Mínimo</label>
                    <div class="col-sm-8">
                                    <input type="number" min="0" class="form-control" name="stockMinimo" id="stockMinimo"
                                    placeholder="<?=$_GET["stockMin"]?>" value="<?=$_GET["stockMin"]?>" requiered>
                                </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Zona de Depósito</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="<?=$_GET["zonaDep"]?>" value="<?=$_GET["zonaDep"]?>"
                                        name="zonaDeposito" requiered>
                                </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Unidad de Referencia</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="<?=$_GET["unidadRef"]?>" value="<?=$_GET["unidadRef"]?>"
                                        name="unidadReferencia" requiered>
                                </div>
                </div>
               <div class="form-group">
                      <label class="col-sm-3 col-sm-3 control-label">Proveedor</label>
                      <div class="col-sm-8">
                                    <select name="proveedor" id="proveedor" class="form-control" required>
                                        <option selected value="<?=$_GET["idproveedor"]?>"> <?=$_GET["proveedor"]?></option>
                                        <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM proveedores ORDER BY nombre_proveedor;");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                        <option value="<?= $datos->idproveedor?>"><?= $datos->nombre_proveedor?></option>
                                        <?php 
                                }
                                ?>
                                    </select>
                                </div>
                  </div>
                <div class="form-group">
                      <label class="col-sm-3 col-sm-3 control-label">Categoria</label>
                      <div class="col-sm-8">
                                    <select name="categoria" id="categoria" class="form-control" required>
                                        <option selected value="<?=$_GET["idcategoria"]?>"> <?=$_GET["categoria"]?></option>
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
                  </div>
               
        <div class="form-group">
          <div>&nbsp</div>
          <div class="btn-group btnRegis col-sm-6">
          <button type="submit" name="btnModificarProducto" class="btn btn-primary "><i
                                            class="fa fa-pencil"></i>&nbsp Modificar Artículo &nbsp</button>
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