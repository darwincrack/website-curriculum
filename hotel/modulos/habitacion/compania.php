<?php 
  error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    //session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
    include_once "/class/class_comp.php";
    include_once "modulos/class_buscar.php";

    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Habitaciones','1')==true){
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


        <title> Tarifario de Compañias</title>
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
            
        </header>
        <!-- End Navigation Bar-->


        <!-- =======================
             ===== START PAGE ======
             ======================= -->
              <div id="nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <form action="" name="form1" method="post" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" align="center">Nueva Compañia</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                          
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Nombre Compañia:</label>
                                                        <input type="text" name="nom"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Individual:</label>
                                                        <input type="text" name="tarifa_ind"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Doble:</label>
                                                        <input type="text" name="tarifa_dob"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                               
                                               
                                             
                                                 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Triple:</label>
                                                        <input type="text" name="tarifa_tri"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                           
                                       
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Matrimonial:</label>
                                                        <input type="text" name="tarifa_mat"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                        
                                                 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Suite:</label>
                                                        <input type="text" name="tarifa_sui"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Mensual:</label>
                                                        <input type="text" name="tarifa_men"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                
                                                                                                 
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Registrar</button>
                                        </div>                                  
                                    </div>
                                </div>
                                </form>
                            </div><!-- /.modal -->   

     
            <div class="container">
                         <?php
                                   if(!empty($_POST['nom'])){ 
                                              
                                        $nombre=limpiar($_POST['nom']);      
                                        $tarifa_ind=limpiar($_POST['tarifa_ind']);
                                        $tarifa_dob=limpiar($_POST['tarifa_dob']);                                                                                          
                                        $tarifa_tri=limpiar($_POST['tarifa_tri']); 
                                        $tarifa_mat=limpiar($_POST['tarifa_mat']);                                                                                       
                                        $tarifa_sui=limpiar($_POST['tarifa_sui']);                                                                                          
                                        $tarifa_men=limpiar($_POST['tarifa_men']);                                                                                                                                                                                       
                                                                                                                                                                                                                           
                                                                            
                                                                    
                                        if(empty($_POST['id'])){
                                            $oProducto=new Proceso_Compania('',$nombre,$tarifa_ind,$tarifa_dob,$tarifa_tri,$tarifa_mat,$tarifa_sui,$tarifa_men);
                                            $ssx=mysql_query("SELECT id, nombre FROM compania WHERE nombre='$nombre'");
                                                if($rr=mysql_fetch_array($ssx)){
                                                    echo 
                                                    '<div class="alert alert-danger alert-dismissable" align="center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        No se Permiten Datos Duplicados, el Actual Registro le Pertenece a <strong>'.$rr['nombre'].' </strong> Identificado con el Codigo 
                                                           <strong> '.$rr['id'].' </strong>
                                                    </div>';
                                                }
                                                else{
                                                    $oProducto->crear();
                                                     $ss=mysql_query("SELECT MAX(id)as id_maximo FROM compania");
                                                    if($rr=mysql_fetch_array($ss)){
                                                        $id=$rr['id_maximo'];
                                                    }

                                            echo mensajes('Compañia "'.$nombre.'" Creado con Exito, con codigo '.cb($id),'verde'); 
                                                }
                                           
                                           
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oProducto=new Proceso_Compania($id,$nombre,$tarifa_ind,$tarifa_dob,$tarifa_tri,$tarifa_mat,$tarifa_sui,$tarifa_men);
                                            $oProducto->actualizar();
                                            echo mensajes('Compañia "'.$nombre.'" Actualizado con Exito, con la Codigo '.cb($id),'verde');
                                        }
                         
                                    }            
                            ?>                                      
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Tarifario de Convenios</b></h4>
                             <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#nuevo" > <i class="fa fa-user-plus" ></i> Nuevo</button></div>                       
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>Codigo</th>
                                        <th>Nombre Compañia</th>                                       
                                        <th>T. INDIVIDUAL</th>   
                                        <th>T. DOBLE</th>   
										<th>T. TRIPLE</th> 										
                                                                              
                                        <th>T. MATRIMONIAL</th> 
                                        <th>T. SUITE</th>   
                                        <th>T. MENSUAL</th>                                                                                                                  
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM compania ORDER BY nombre");
                                        while($rr=mysql_fetch_array($ss)){
                                           
                                    ?>
                                    <tr>                                       
                                        <td><?php echo $rr['id']; ?></td>
                                        <td><?php echo $rr['nombre']; ?></td>
                                        <td><?php echo $rr['tarifa_ind'];  ?></td>
                                        <td><?php echo $rr['tarifa_dob']; ?></td>
                                         <td><?php echo $rr['tarifa_tri']; ?></td>
                                        <td><?php echo $rr['tarifa_mat'];  ?></td>
                                        <td><?php echo $rr['tarifa_sui']; ?></td>
                                        <td><?php echo $rr['tarifa_men']; ?></td>
                                        
                                                          
                                                                           
                                        <td align="center">
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-primary btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> Editar</a>
                                                </div>
                                            <?php 
                                                if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Productos','4')==true){
                                                    if($rr['inv']==''){
                                                ?>                                       
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-primary btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> Editar</a>
                                                </div>
                                            <?php }} ?>
                                        </td>
                                    </tr>
                                    <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Compañia</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Nombre Compañia:</label>
                                                        <input type="text" name="nom"  required class="form-control" autocomplete="off" value="<?php echo $rr['nombre']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Individual:</label>
                                                        <input type="text" name="tarifa_ind"  required class="form-control" autocomplete="off" value="<?php echo $rr['tarifa_ind']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Doble:</label>
                                                        <input type="text" name="tarifa_dob"  required class="form-control" autocomplete="off" value="<?php echo $rr['tarifa_dob']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                               
                                               
                                             
                                                 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Triple:</label>
                                                        <input type="text" name="tarifa_tri"  required class="form-control" autocomplete="off" value="<?php echo $rr['tarifa_tri']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                           
                                       
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Matrimonial:</label>
                                                        <input type="text" name="tarifa_mat"  required class="form-control" autocomplete="off" value="<?php echo $rr['tarifa_mat']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                        
                                                 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Suite:</label>
                                                        <input type="text" name="tarifa_sui"  required class="form-control" autocomplete="off" value="<?php echo $rr['tarifa_sui']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Tar. Mensual:</label>
                                                        <input type="text" name="tarifa_men"  required class="form-control" autocomplete="off" value="<?php echo $rr['tarifa_men']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                                                                                            
                                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Actualizar</button>
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
        <script src="assets/js/bootstrap.min.js"></script>   -->
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
    
    $('#liHabitacion').addClass("treeview active");
    $('#liCompanias').addClass("active");

</script>


    </body>
</html>