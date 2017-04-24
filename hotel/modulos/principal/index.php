<?php 
  error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
    
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        
    }else{
        header('Location: modulos/error.php');
    }
    if(consultar('cargo','username'," usu='".$_SESSION['cod_user']."'")=='Administrador'){
        $ncargo='Administrador';
    }else{
        $ncargo=consultar('nombre','cargo',"id='".consultar('cargo','username'," usu='".$_SESSION['cod_user']."'")."'");           
    }
     $usuario=$_SESSION['cod_user'];
     $id_sucursal=consultar('sucursal','username',"usu='$usuario'");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema Hotelero">
        <meta name="author" content="Joseph Ormaza">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">



        
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <!--
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/menu.css" rel="stylesheet" type="text/css" />   -->
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>


    </head>


    <body>


        <!-- Navigation Bar-->
       
        <!-- End Navigation Bar-->


        <!-- =======================
             ===== START PAGE ======
             ======================= -->

        <div align="center">
            <div class="container">

                 <div class="row">
                    <a tabindex="-1" href="Hospedaje.php">
					<div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="md md-account-child text-primary"></i>
                                <div class="wid-icon-info">
                                <?php
                                    // primero conectamos siempre a la base de datos mysql
                                    $sql = "SELECT * FROM hospedaje WHERE facturado='NO'";  // sentencia sql
                                    $result = mysql_query($sql);
                                    $numero = mysql_num_rows($result); // obtenemos el número de filas
                                    
                                    ?>
                                    <p class="text-muted m-b-5 font-13 text-uppercase">Hospedados</p>
                                    <h4 class="m-t-0 m-b-5 counter text-purple counter"><?php echo "$numero" ?></h4>
                                </div>
                            </div>
                        </div>
                    </div></a>
			                    

                    <a tabindex="-1" href="ControlHabitaciones.php"><div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="fa fa-bed text-primary"></i>
                                <div class="wid-icon-info">                              
									 <?php
                                    // primero conectamos siempre a la base de datos mysql
                                    $sql = "SELECT * FROM producto WHERE control='s' and status ='OCUPADA'";  // sentencia sql
                                    $sqlx = "SELECT * FROM producto WHERE control='s' and status ='DISPONIBLE'";  // sentencia sql
                                    $sqllimp = "SELECT * FROM producto WHERE control='s' and status ='PENDIENTE LIMPIEZA'";  // sentencia sql
                                    $result = mysql_query($sql);
                                    $resultx = mysql_query($sqlx);
                                    $resultlimp = mysql_query($sqllimp);
                                    $ocupadas = mysql_num_rows($result); // obtenemos el número de filas
                                    $disponibles = mysql_num_rows($resultx); // obtenemos el número de filas
                                    $limpieza = mysql_num_rows($resultlimp); // obtenemos el número de filas
                                    
                                    ?>
                                    <p class="text-muted m-b-5 font-13 text-uppercase">Hab. Ocupadas</p>
                                    <h4 class="m-t-0 m-b-5 counter text-primary counter"><?php echo "$ocupadas" ?></h4>
                                </div>
                            </div>
                        </div>
                    </div></a>
					 <a tabindex="-1" href="ControlHabitaciones.php"><div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="glyphicon glyphicon-check text-primary"></i>
                                <div class="wid-icon-info">
                                    <p class="text-muted m-b-5 font-13 text-uppercase">Hab.Disponibles</p>
                                    <h4 class="m-t-0 m-b-5 counter text-danger counter"><?php echo "$disponibles" ?></h4>
                                </div>
                            </div>
                        </div></a>


                       
                    </div>
                      <a tabindex="-1" href="ControlHabitaciones.php"><div class="col-sm-6 col-lg-3">
                        <div class="card-box widget-icon">
                            <div>
                                <i class="glyphicon glyphicon-time text-primary"></i>
                                <div class="wid-icon-info">
                                    <p class="text-muted m-b-5 font-13 text-uppercase">Hab.Por Limpiar</p>
                                    <h4 class="m-t-0 m-b-5 counter text-danger counter"><?php echo "$limpieza" ?></h4>
                                </div>
                            </div>
                        </div></a>

                </div>
                <!-- end row -->

                  <div class="row">
                    <div class="col-lg-12" align="center">
                        
                       
                            
                           
                               
                                    
                                        
                                                                              
                                            <img src="img/inicio<?php echo consultar('sucursal','username',"usu='".$_SESSION['cod_user']."'"); ?>.jpg" width="1000" height="450">                              
                                       
                                        
                                   
                               
                           
                       
                        <!--<div class="btn-group btn-group-justified m-b-10">
                                <?php if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){ ?>
                                <a  href="../venta/admin.php?x=sin" class="btn btn-danger waves-effect waves-light" role="button">Recepción Cliente sin Registro</a>
                                <?php }if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){ ?>
                                <a  href="#" class="btn btn-warning waves-effect waves-light" role="button"></a>
                                <?php }if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){ ?>
                                <a href="../venta/" class="btn btn-primary waves-effect waves-light" role="button">Recepción Cliente con Registro</a>
                                 <?php } ?>  
                        </div>-->
                        
                    </div>
                </div>
                 <!-- end row -->



               

            </div> <!-- end container -->
        </div>
        <!-- End wrapper -->



        <!-- jQuery  
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>   -->
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


    </body>
</html>