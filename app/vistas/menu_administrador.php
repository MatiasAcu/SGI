<!-- MENÚ PRINCIPAL DE LA BARRA LATERAL -->
        <!--Comienzo de la Barra lateral-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- Comienzo del Menú de la Barra Lateral-->
                <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered">
                        <?php
            
                    $avatar = $_SESSION['avatar'];
                    $nombreUsuario= $_SESSION['nombredelusuario'];
                    echo "<img src='../assets/img/$avatar.jpg' class='img-circle' width='60'>";
                    ?>
                    </p>

                    <li class="mt">
                        <a class="active sub-menu" href="../vistas/panelPrincipal.php">

                            <span>Menú de Acciones</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="../vistas/panelPrincipal.php">
                       <i class="fa fa-home"></i>
                            <span>Inicio</span>
                        </a>

                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-user"></i>
                            <span>Gestión de Usuarios</span>
                        </a>
                        <ul class="sub">
                            <li><a href="../vistas/cargarUsuario.php">Registrar Nuevo Usuario</a></li>
                            <li><a href="../vistas/listadoUsuarios.php">Listado de Usuarios</a></li>
                        
                        </ul>
                    </li>
                
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-users"></i>
                            <span>Gestión de Proveedores</span>
                        </a>
                        <ul class="sub">
                        <li><a href="../vistas/cargarProveedor.php">Cargar Nuevo Proveedor</a></li>
                            <li><a href="../vistas/listadoProveedores.php">Listado de Proveedores</a></li>
                            <li><a href="../vistas/listadoCategorias.php">Manejo de Categorías</a></li>
                        
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-list"></i>
                            <span>Gestión de Almacén</span>
                        </a>
                        <ul class="sub">
                        <li><a href="../vistas/cargarProducto.php">Cargar Nuevo Articulo</a></li>
                            <li><a href="../vistas/listadoArticulos.php">Listado de Articulos</a></li>
                            <li><a href="../vistas/alertasStock.php">Ver alertas de Stock</a></li>
                            
                        </ul>
                    </li>

                
                    <li class="sub-menu">
                        <a href="https://drive.google.com/file/d/1kbS7Bn2e3YqZuP8qWVlPZJn__n9W0ESW/view?usp=drive_link">
                            <i class="li_bulb"></i>
                            <span>Ayuda</span>
                        </a>
                        </li>
                </ul>
                <!-- Final del menú de la barra lateral-->
            </div>
        </aside>
        <!--Final de la Barra lateral-->