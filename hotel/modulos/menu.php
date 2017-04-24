<?php 
    include_once ("funciones.php");   
?>
<!-- Navbar Start -->
            <div class="navbar-custom">
                <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu active">
                            <a href="../principal/"><i class="md md-dashboard"></i>Inicio</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="md md-person"></i>Clientes</a>
                            <ul class="submenu">
                                <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Clientes','1')==true){
                                            echo '  <li><a tabindex="-1" href="../cliente/consultar.php">Administrar Cliente</a></li>';                                           
                                        }                                       
                                    ?>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="md md-markunread-mailbox"></i>Habitaciones</a>
                            <ul class="submenu">                       
                                <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Habitaciones','1')==true){
                                            echo '  <li><a tabindex="-1" href="../habitacion/consultar.php">Administrar Habitaciones</a></li>';                      
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Habitaciones','2')==true){
                                            echo '  <li><a tabindex="-1" href="../habitacion/control.php">Control de Habitaciones</a></li>';
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Habitaciones','3')==true){
                                            echo '  <li class="divider"></li>
                                                    <li><a tabindex="-1" href="../habitacion/categoria.php">Administrar Categorias</a></li>';
                                        }                                       
                                    ?>                                
                            </ul>
                        </li>

                         <li class="has-submenu">
                        <a href="#"><i class="md  md-storage"></i> Informes</a>
                        <ul class="submenu">
                            <?php 
                                                               
                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','1')==true){
                                    echo '  <li><a tabindex="-1" href="../venta/consultar.php">Consultar Facturas</a></li>';
                                }
                                 if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','2')==true){
                                    echo '  <li><a tabindex="-1" href="../reportes/financiero.php">Reporte Financiero</a></li>';
                                }
                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','3')==true){
                                    echo '  <li><a tabindex="-1" href="../reportes/kardex_cliente.php">Kardex de Clientes</a></li>';
                                }
                                 if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Informe','3')==true){
                                    echo '  <li><a tabindex="-1" href="../reportes/kardex_hab.php">Kardex de Habitaciones</a></li>';
                                }
                            ?>
                        </ul>
                    </li>

                        <li class="has-submenu">
                            <a href="#"><i class="md md-settings"></i>Administración</a>
                            <ul class="submenu">
                                <li class="has-submenu">
                                    <a href="#">Usuarios</a>
                                   <ul class="submenu">                           
                                        <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','1')==true){
                                           
                                            echo '  <li><a tabindex="-1" href="../usuario/consultar.php">Administrar Usuarios</a></li>';          
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Usuarios','2')==true){
                                            echo '  <li><a tabindex="-1" href="../usuario/cambiar_contra.php">Administrar Contraseñas</a></li>';
                                        }
                                    ?>
                                    </ul>
                                </li>

                                <li class="has-submenu">
                                    <a href="#">Sucursales</a>
                                    <ul class="submenu">                                        
                                        <?php 
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sucursales','1')==true){
                                            echo '  <li><a tabindex="-1" href="../sucursal/consultar.php">Administrar Sucursales</a></li>';
                                            
                                        }
                                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Sucursales','2')==true){
                                            echo '  <li class="divider"></li>
                                                    <li><a tabindex="-1" href="../sucursal/imagen.php">Imagen de Presentacion</a></li>';
                                        }                                       
                                    ?>                            
                                    </ul>
                                </li>                           
                            </ul>
                        </li>                       
                        <?php                        
                        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){
                            echo '  <li class="has-submenu">
                                        <a href="#"><i class="md md-add-shopping-cart"></i>Recepción</a>
                                        <ul class="submenu">
                                           <!-- <li><a href="../venta/admin.php?x=sin">Cliente sin Registro</a></li>-->                               
                                            <li><a href="../venta/">Registrar Cliente</a></li>                               
                                        </ul>
                                    </li>';
                        }
                       ?>
                    </ul>
                    <!-- End navigation menu -->
                </div>
            </div>
            </div>