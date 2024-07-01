<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background:#516CE5;">
                                        <h5 class="modal-title" id="ModalLabel">Filtrar por algún criterio</h5>

                                    </div>
                                    <div class="modal-body">
   <h4 style="margin-bottom: -20px"><i class="fa fa-angle-right"></i> Filtrar por stock</h4>
                                        <form class="row g-3" role="form" method="GET"
                                            action="../vistas/listadoArticulos.php">
                                            <div class="col-lg-7">
                                                <span class="help-block">&nbsp</span>
                                                <td colspan="2"><input class="form-control form-control-lg"
                                                        type="number" min="0" name="diferencia"  required>
                                                </td>
                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <span class="help-block">&nbsp</span>

                                                <button type="sumbit" class="btn btn-danger" name=""><i
                                                        class="fa fa-code"></i>&nbsp
                                                    Filtrar &nbsp</button>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                        </form>

                                        <h4 style="margin-bottom: -20px"><i class="fa fa-angle-right"></i> Buscar por
                                            Codigo</h4>
                                        <form class="row g-3" role="form" method="GET"
                                            action="../vistas/listadoArticulos.php">
                                            <div class="col-lg-7">
                                                <span class="help-block">&nbsp</span>
                                                <td colspan="2"><input class="form-control form-control-lg"
                                                        type="search" name="articulo" list="listarticulos" required>
                                                </td>
                                                <datalist id="listarticulos">
                                                    </option>
                                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM articulos;");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                                    <option value="<?=$datos->codigo?>"><?=$datos->codigo?>                                                    </option>
                                                    <?php 
                                }
                                ?>
                                                </datalist>
                                            </div>


                                            <div class="col-lg-3">
                                                <span class="help-block">&nbsp</span>

                                                <button type="sumbit" class="btn btn-danger" name=""><i
                                                        class="fa fa-code"></i>&nbsp
                                                    Filtrar &nbsp</button>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                        </form>
                                        <h4 style="margin-bottom: -20px"><i class="fa fa-angle-right"></i> Buscar por
                                            Categoría</h4></br>
                                        <form role="form" class="row g-3" method="POST"
                                            action="../vistas/listadoArticulos.php">
                                            <div class="col-lg-7">
                                                <span class="help-block">&nbsp</span>
                                                <select name="categoria" id="categoria" class="form-control" required>
                                                    <option selected value="" disabled> Categorías</option>
                                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM categorias ORDER BY nombre;");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                                    <option value="<?= $datos->idcategoria?>"><?= $datos->nombre?>
                                                    </option>
                                                    <?php 
                                }
                                ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <span class="help-block">&nbsp</span>
                                                <button type="sumbit" class="btn btn-danger" name=""><i
                                                        class="fa fa-code"></i>&nbsp
                                                    Filtrar &nbsp</button>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                        </form>
                                        <h4 style="margin-bottom: -20px"><i class="fa fa-angle-right"></i> Buscar por
                                            Proveedor</h4></br>
                                        <form role="form" class="row g-3" method="POST"
                                            action="../vistas/listadoArticulos.php">
                                            <div class="col-lg-7">
                                                <span class="help-block">&nbsp</span>
                                                <select name="proveedor" id="proveedor" class="form-control" required>
                                                    <option selected value="" disabled> Proveedores</option>
                                                    <?php //conexion con la BD
                                include ("../modelo/conexionPDO.php");
                                $sentencia = $mbd->prepare("SELECT * FROM proveedores ORDER BY nombre_proveedor;");
                                $sentencia->execute();
                                while($datos= $sentencia->fetch(PDO::FETCH_OBJ)) {
                                              
                                    ?>
                                                    <option value="<?= $datos->idproveedor?>">
                                                        <?= $datos->nombre_proveedor?></option>
                                                    <?php 
                                }
                                ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <span class="help-block">&nbsp</span>
                                                <button type="sumbit" class="btn btn-danger" name=""><i
                                                        class="fa fa-code"></i>&nbsp
                                                    Filtrar &nbsp</button>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                        </form>
                                        <form class="row g-3" role="form" method="GET" action="../vistas/listadoArticulos.php">
                                <div class="col-lg-12">
                                    <button type="sumbit" class="btn btn-success" name=""><i class="fa fa-eye"></i>&nbsp
                                        Ver Todos los artículos&nbsp</button>
                                </div>
                            </form> </hr>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>