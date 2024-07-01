     <!-- CONTENIDO DE LA BARRA SUPERIOR Y NOTIFICACIONES -->
        <!--Encabezado de inicio -->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="MENU DE NAVEGACIÓN"></div>
            </div>
        
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../modelo/cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-bell"></i>
                            <?php
               include ("../controlador/controladorDeProductos.php");
                $controladorDeArticulos= new ControladorDeArticulos();
                $alertas= $controladorDeArticulos->determinarAlertas();
                if($alertas>0){ ?> 
                    <span class="badge bg-important"><?=$alertas?></span>
                <?php  } ?>
                            <span class="badge bg-important"></span>
                                
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">Tiene <?=$alertas?> alerta de Stock</p>
                            </li>
                            <li class="external">
                                <a href="../vistas/alertasStock.php">Ver todas las alertas</a>
                            </li>
                        </ul>
    </div>
        </header>
        <!-- Final del Encabezado -->