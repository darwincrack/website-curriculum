<?php 
 error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    //session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
    include_once "/class/class.php";
    include_once "modulos/class_buscar.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Habitaciones','2')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema Hotelero">
        <meta name="author" content="Joseph Ormaza">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Control de Habitaciones</title>
         <!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Validaciones-->
        <link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Generales-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
      <!--   <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />    -->
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
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                   
                    <div class="menu-extras">


                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>
            <!-- End topbar -->


            <!-- Navbar Start -->
            <?php include_once "../menu.php"; ?>
        </header>
        <!-- End Navigation Bar-->


        <!-- =======================
             ===== START PAGE ======
             ======================= -->
          

      
            <div class="container">
                         <?php
                                 if(!empty($_POST['id'])){
                                            $id=limpiar($_POST['id']);
                                            $status=limpiar($_POST['status']);
                                            $limpiada=limpiar($_POST['limpiada']);
                                            mysql_query("UPDATE producto SET status='$status',cliente_tmp='',limpiada='$limpiada' WHERE id='$id' ");
                                                                                                                                                                                                                         
                                            echo mensajes('La Habitacion fue modificada con Exito','verde');
                                    }
                            ?>      
                              
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Registro de Salida - CHECK OUT</b></h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>Codigo</th>
                                        <th>Cliente</th>
                                        <th>Descripción</th>                                      
                                        <th>Tipo de Habitación</th>                              
                                        <th>Valor</th>  
                                        <th>Estado</th>  
                                        <th>Opciones</th>                                                                                                               
                                       

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM producto WHERE control='s' and status ='OCUPADA' or status ='DISPONIBLE' or status ='PENDIENTE LIMPIEZA'");
                                        while($rr=mysql_fetch_array($ss)){											
                                            $inv=$rr['inv'];
                                            $estado=$rr['estado'];
                                            $iva=$rr['iva'];
                                            $control=$rr['control'];
                                            $npersona=$rr['npersona'];
                                            $valor=$rr['valor'];
                                            $cat=$rr['categoria'];
                                            $oTipo=new Consultar_Categoria($rr['categoria']);               
                                                        
											?>
																			
									
                                    <tr>                                       
                                        <td><?php echo $rr['codigo']; ?></td>                                        
                                        <td><?php echo $rr['cliente_tmp']; ?></td>										 
                                        <td><?php echo $rr['nombre']; ?></td>
                                        <td><?php echo $oTipo->consultar('nombre');  ?></td>                                       
                               			<td align="center"><strong><?php echo $s.formato($rr['valor']); ?></strong></td> 
                                        <td><?php echo $rr['status']; ?></td>
                                        <td><?php if($rr['status']=="OCUPADA"){ ?> <div  class="btn-group btn-group m-b-10">
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-primary btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> Dar de Alta</a>
                                                </div> <?php 
                                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','4')==true){
                                                    if($rr['inv']==''){
                                                ?>                                       
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-danger btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> <?php echo $rr['status']; ?></a>
                                                </div>
                                            <?php }} ?> 

                                            <?php }elseif ($rr['status']=="PENDIENTE LIMPIEZA") {
                                                
                                             ?><div  class="btn-group btn-group m-b-10">
                                                    <a href="#limpiar<?php echo $rr['id']; ?>" class="btn btn-limpio btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-bed"></i> Limpiar</a>
                                                </div>

                                                 <?php 
                                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','4')==true){
                                                    if($rr['inv']==''){
                                                ?>                                       
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#limpiar<?php echo $rr['id']; ?>" class="btn btn-danger btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-bed"></i> <?php echo $rr['status']; ?></a>
                                                </div>
                                            <?php }} ?>
                                            <?php }else{ }?></td>



                                    </tr>
                                    <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                    <input type="hidden" name="status" value="PENDIENTE LIMPIEZA">
                                     <input type="hidden" name="limpiada" value="SUCIA">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">DAR DE ALTA HABITACION</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                               <div class="row" align="center">                                       
                                                                <div class="alert alert-danger">
                                                                    <h4>¿Esta Seguro de Realizar esta Acción?</h4> 
                                                                </div>                                                                                                                                                                                                                                                                                                                                                                                                                              
                                                            </div>                          
                                                                                                                            
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-info waves-effect waves-light">Proceder</button>
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal -->                

                                                 <div id="limpiar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                    <input type="hidden" name="limpiada" value="LIMPIA">
                                    <input type="hidden" name="status" value="DISPONIBLE">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">LIMPIAR LA HABITACION</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                               <div class="row" align="center">                                       
                                                                <div class="alert alert-danger">
                                                                    <h4>¿Esta Seguro de Realizar esta Acción?</h4> 
                                                                </div>                                                                                                                                                                                                                                                                                                                                                                                                                              
                                                            </div>                          
                                                                                                                            
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-info waves-effect waves-light">Proceder</button>
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal -->                       
                                     <?php } ?>                                                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div> <!-- end container -->
       



        <!-- jQuery  
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>  -->
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Datatables-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Validaciones-->
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>


        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>     

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
         <script>
            jQuery(document).ready(function() {

                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                  maximumSelectionLength: 2
                });

                });               

            </script>   
             <script type="text/javascript">
    
    $('#liRecepcion').addClass("treeview active");
    $('#liControlHabitaciones').addClass("active");

</script>


    </body>
</html>