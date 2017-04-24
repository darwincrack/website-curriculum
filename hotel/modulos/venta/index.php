<?php 
  error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    //session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
    include_once "/class/class.php";

    
?>
<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema Hotelero">
        <meta name="author" content="Joseph Ormaza">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">
        <title>Listado de Clientes</title>
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
   <!--     <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />   -->
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
                <input type="hidden" name="existe" value="">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" align="center">Nuevo Cliente</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">Documento</label>
                                                        <input type="text" name="cod"  required  class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Nombre</label>
                                                        <input type="text" name="nom"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Dirección</label>
                                                        <input type="text" name="dir"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Telefono</label>
                                                        <input type="text" name="tel"  required class="form-control" data-mask="9999-9999" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Celular</label>
                                                        <input type="text" name="cel"  required class="form-control" data-mask="9999-9999" autocomplete="off">
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-6" class="control-label">Sucursal</label>
                                                        <select class="form-control select2" name="sucursal" required>
                                                                <option>Seleccionar</option>
                                                                <?php 
                                                                    $ss=mysql_query("SELECT id,nom,ciudad FROM sucursal ORDER BY nom");
                                                                    
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                        if($rr['id']==$sucursal){
                                                                            echo '<option value="'.$rr['id'].'" selected>'.$rr['nom'].' - '.$rr['ciudad'].'</option>';
                                                                        }else{
                                                                            echo '<option value="'.$rr['id'].'">'.$rr['nom'].' - '.$rr['ciudad'].'</option>';
                                                                        }
                                                                    }
                                                                ?>                                                          
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Estado</label>
                                                        <select class="form-control select2" name="estado" required>                                               
                                                                <option value="s">Activo</option>
                                                                 <option value="n">No Activo</option>                                                    
                                                            </select>
                                                    </div>
                                                </div>
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Asignar Imagen</label>
                                                        <input type="file" name="imagen" class="form-control">
                                                    </div>
                                                </div>-->
                                                <div class="row">
                                                
                                            </div>
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
                                        $documento=limpiar($_POST['cod']);       
                                        $nombre=limpiar($_POST['nom']);      
                                        $direccion=limpiar($_POST['dir']);
                                        $telefono=limpiar($_POST['tel']);
                                        $celular=limpiar($_POST['cel']);                                                                                           
                                        $estado=limpiar($_POST['estado']);
                                        $sucursal=limpiar($_POST['sucursal']);                                      
                                                                    
                                        if(empty($_POST['id'])){
                                            $oPaciente=new Proceso_Cliente('',$documento,$nombre,$direccion,$telefono,$celular,$estado,$sucursal);
                                            $ssx=mysql_query("SELECT nit, nom FROM cliente WHERE nom='$nombre' or nit='$documento'");
                                                if($rr=mysql_fetch_array($ssx)){
                                                    echo 
                                                    '<div class="alert alert-danger alert-dismissable" align="center">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        No se Permiten Datos Duplicados, el Actual Registro le Pertenece a '.$rr['nom'].' Identificado con el Documento 
                                                            '.$rr['nit'].'
                                                    </div>';
                                                }
                                                else{
                                                    $oPaciente->crear();
                                                     $ss=mysql_query("SELECT MAX(id)as id_maximo FROM cliente");
                                                    if($rr=mysql_fetch_array($ss)){
                                                        $id=$rr['id_maximo'];
                                                    }

                                            echo mensajes('Cliente "'.$nombre.'" Creado con Exito, con codigo '.cb($id),'verde'); 
                                                }
                                           
                                           
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oPaciente=new Proceso_Cliente($id,$documento,$nombre,$direccion,$telefono,$celular,$estado,$sucursal);
                                            $oPaciente->actualizar();
                                            echo mensajes('Cliente "'.$nombre.'" Actualizado con Exito, con la ID de '.cb($id),'verde');
                                        }
                                        //subir la imagen del articulo
                                   /* $nameimagen = $_FILES['imagen']['name'];
                                    $tmpimagen = $_FILES['imagen']['tmp_name'];
                                    $extimagen = pathinfo($nameimagen);
                                    $ext = array("png","jpg");
                                    $urlnueva1 = "../../cliente/".$id.".jpg";   
                                    if(is_uploaded_file($tmpimagen)){
                                        if(array_search($extimagen['extension'],$ext)){
                                            copy($tmpimagen,$urlnueva1);    
                                            echo mensajes("Se ha Actualizado la Imagen de Presentacion con Exito","verde");
                                        }else{
                                            echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                        }
                                    }else{
                                        echo mensajes("Error al Subir la Imagen, solo se acepta JPG","rojo");
                                    }*/
                                    }            
                            ?>                                      
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h1 class="m-t-0 header-title" align="center"><b>Clientes Registrados</b></h1>
                            <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5"  data-toggle="modal"  data-target="#nuevo" > <i class="fa fa-user-plus"  ></i> Nuevo Cliente </button></div>							
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                        <th>Direccion</th>                                       
                                        <th>Telefono</th>                                       
                                        <th>Celular</th>                                                                              
                                        <th>prueba</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM cliente WHERE estado='s' ORDER BY nom");
                                        while($rr=mysql_fetch_array($ss)){
                                            $estado=$rr['estado'];
                                             $sucu=$rr['sucursal'];
                                    ?>
                                    <tr>
                                        <td><?php echo cb($rr[0]); ?></td>
                                        <td><?php echo $rr['nom']; ?></td>
                                        <td><?php echo $rr['nit']; ?></td>
                                        <td><?php echo $rr['dir']; ?></td>
                                        <td><?php echo $rr['tel']; ?></td>
                                        <td><?php echo $rr['cel']; ?></td>
                                          <td align="center">
										  
                                          
                                                <div  class="btn-group btn-group m-b-10">
                                                    <a href="DetalleRecepcion.php?i=<?php echo claves($rr[0]); ?>" class="btn btn-danger btn-sm waves-effect waves-light" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Asignar Habitacion" > <i class="fa  fa-pencil-square-o"></i></a>
                                                </div>
                                            
                                        </td>
                                    </tr>
                                    <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                    <input type="hidden" name="existe" value="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Cliente</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="field-1" class="control-label">Documento</label>
                                                                            <input type="text" name="cod" value="<?php echo $rr['nit']; ?>" required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="field-2" class="control-label">Nombre</label>
                                                                            <input type="text" name="nom" value="<?php echo $rr['nom']; ?>" required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="field-3" class="control-label">Dirección</label>
                                                                            <input type="text" name="dir" value="<?php echo $rr['dir']; ?>" required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="field-4" class="control-label">Telefono</label>
                                                                            <input type="text" name="tel" value="<?php echo $rr['tel']; ?>" required class="form-control" data-mask="9999-9999" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="field-4" class="control-label">Celular</label>
                                                                            <input type="text" name="cel" value="<?php echo $rr['cel']; ?>" required class="form-control" data-mask="9999-9999" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="field-6" class="control-label">Sucursal</label>
                                                                            <select class="form-control select2" name="sucursal" required>
                                                                                    <option>Seleccionar</option>
                                                                                    <?php 
                                                                                        $ssy=mysql_query("SELECT id,nom,ciudad FROM sucursal ORDER BY nom");
                                                                                        
                                                                                        while($rry=mysql_fetch_array($ssy)){
                                                                                            if($rry['id']==$sucu){
                                                                                                echo '<option value="'.$rry['id'].'" selected>'.$rry['nom'].' - '.$rry['ciudad'].'</option>';
                                                                                            }else{
                                                                                                echo '<option value="'.$rry['id'].'">'.$rry['nom'].' - '.$rry['ciudad'].'</option>';
                                                                                            }
                                                                                        }
                                                                                    ?>                                                          
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">                                   
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="field-2" class="control-label">Estado</label>
                                                                            <select class="form-control select2" name="estado" required>                                               
                                                                                    <option value="s" <?php if($estado=='s'){ echo 'selected';} ?>>Activo</option>
                                                                                    <option value="n" <?php if($estado=='n'){ echo 'selected'; } ?>>No Activo</option>                                                  
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                    <div class="col-md-12">
                                                                        
                                                                    </div>
                                                                </div>
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


                <!-- Footer -->
                <?php include_once "../pie.php"; ?>
                <!-- End Footer -->

            </div> <!-- end container -->
  



        <!-- jQuery  -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>
        <script src="../../assets/js/detect.js"></script>
        <script src="../../assets/js/fastclick.js"></script>
        <script src="../../assets/js/jquery.blockUI.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/wow.min.js"></script>
        <script src="../../assets/js/jquery.nicescroll.js"></script>
        <script src="../../assets/js/jquery.scrollTo.min.js"></script>

        <!-- Datatables-->
        <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../../assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../../assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../../assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Validaciones-->
        <script src="../../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="../../text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="../../text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="../../assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="../../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="../../assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>


        <!-- Datatable init js -->
        <script src="../../assets/pages/datatables.init.js"></script>

        <!-- Custom main Js -->
        <script src="../../assets/js/jquery.core.js"></script>
        <script src="../../assets/js/jquery.app.js"></script>     

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../../assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
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


    </body>
</html>