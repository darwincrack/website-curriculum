<?php 
  error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//session_start();
 
    //session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){
        }else{
header('Location:../error500.php');
        }
    }else{
header('Location:../error500.php');
    }
    $usuario=$_SESSION['cod_user'];
    if(!empty($_GET['x'])){
        mysql_query("DELETE FROM venta_info_tmp WHERE usu='$usuario'");
        mysql_query("DELETE FROM venta_caja_tmp WHERE usu='$usuario'");
        mysql_query("INSERT INTO venta_info_tmp (usu,cliente) VALUES ('$usuario','cliente')");
        header('Location:admin.php');
    }else{
        if(!empty($_GET['i'])){
            $id_cliente=get(limpiar($_GET['i']),'cliente','id');
            mysql_query("DELETE FROM venta_info_tmp WHERE usu='$usuario'");
            mysql_query("DELETE FROM venta_caja_tmp WHERE usu='$usuario' and mesa=''");
            mysql_query("INSERT INTO venta_info_tmp (usu,cliente) VALUES ('$usuario','$id_cliente')");
            header('Location:admin.php');
        }else{
            $ss=mysql_query("SELECT * FROM venta_info_tmp WHERE usu='$usuario'");
            if($tmp=mysql_fetch_array($ss)){
            }else{
header('Location:index.php');  
            }
            if(!empty($_GET['c'])){
                $id_categoria=get(limpiar($_GET['c']),'confi','id');
                if(!empty($_GET['p'])){
                    $cod=get(limpiar($_GET['p']),'producto','id');
                    $nom=consultar('nombre','producto',"id='$cod'");
                    if ($tipo_cliente!='CONVENIO') {
                        $val=consultar('valor','producto',"id='$cod'");
                    }else{
                        $val=consultar('tarifa_dia','hospedaje',"id='$cod'");
                         }
                    
                    $id_hospedado = $_SESSION['idhosp'];
                    $ss=mysql_query("SELECT id FROM venta_caja_tmp WHERE cod='$cod' and usu='$usuario'");
                    if($rr=mysql_fetch_array($ss)){
                        mysql_query("UPDATE venta_caja_tmp SET cant=cant+1 WHERE cod='$cod' and usu='$usuario'");
                    }else{
                        mysql_query("INSERT INTO venta_caja_tmp (cod,id_hospedado,nom,cant,val,usu) VALUES ('$cod','$id_hospedado','$nom','1','$val','$usuario')");
                    }
header('Location:admin.php?c='.claves($id_categoria)); 
                }
            }else{
                $id_categoria='';   
            }
        }
    }    
    if(!empty($_GET['remove'])){
        $id_remove=get(limpiar($_GET['remove']),'venta_caja_tmp','id');
        mysql_query("DELETE FROM venta_caja_tmp WHERE id='$id_remove'");
        if(!empty($_GET['c'])){
            header('Location:admin.php?c='.limpiar($_GET['c']));   
        }else{
            header('Location:admin.php');  
        }        
    } 
?>
<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema Hotelero">
        <meta name="author" content="Joseph Ormaza">


        <link rel="shortcut icon" href="../../assets/images/favicon_1.ico">

        <title>Facturar</title>
         <!-- DataTables -->
        <link href="../../assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Validaciones-->
        <link href="../../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="../../assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="../../assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="../../assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="../../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Generales-->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css" />
      <!--  <link href="../../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/menu.css" rel="stylesheet" type="text/css" /> -->
        <link href="../../assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="../../assets/js/modernizr.min.js"></script>

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
             

        
            <div class="container">
                    <div class="col-lg-3">
                        <div class="panel panel-purple panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">CATEGORIA</h3> 
                                                            
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <?php 

                                    $categoria = $_SESSION['categoria'];
                                        $ss=mysql_query("SELECT * FROM confi WHERE tabla='categoria' and id='$categoria' or nombre='SERVICIOS' ORDER BY nombre");
                                        while($rr=mysql_fetch_array($ss)){
                                            if($id_categoria==$rr[0]){
                                                $class='btn-warning';
                                            }else{
                                                $class='btn-default';   
                                            }
                                    ?>
                                <tr>
                                    <td align="center"><a href="DetalleRecepcion.php?c=<?php echo claves($rr[0]); ?>" class="btn btn-block btn-lg  waves-effect waves-light <?php echo $class; ?>" style="width:90%">
                                    <strong><?php echo $rr['nombre']; ?></strong></a></a></td>
                                </tr>
                                <?php } ?>
                            </table>
                             <?php 

                                        $idhosp= $_SESSION['idhosp'];
                                        $consulta=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y %H:%m') as fechaorder FROM hospedaje WHERE id=$idhosp");
                                       
                                        while($resultado=mysql_fetch_array($consulta)){
                                            $fecha_entrada=$resultado['fechaorder'];
                                            $fecha_salida= date('d/m/Y g:ia');
                                            $tipo_cliente = $resultado['tipo_cliente'];
                                            $vari = $_SESSION['categoria'];
                                            $varia = $_SESSION['idhosp'];
                                             ?>
                                            
                                    
                            </div>

                        </div>

                                             <td> <b>Fecha de Entrada:</b> <?php echo $fecha_entrada; ?></td> 
                                             <td> <b>Fecha de Salida:  &nbsp; &nbsp;</b><?php echo $fecha_salida; ?></td> 

                                             <?php 
                                              }
                                    ?>
                    </div>

                    <div class="col-lg-7">
                        <div class="panel panel-success panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">HABITACIONES / SERVICIOS</h3>                                
                            </div>
                            <div class="panel-body">
                                  <?php if($id_categoria<>''){ ?>
                
                                    <?php 
                                    $idhab = $_SESSION['idhab'];
                                        $n=0;

                                        $hab=mysql_query("SELECT * FROM producto WHERE categoria='$id_categoria' and estado='s' ORDER BY nombre");
                                        while($rr=mysql_fetch_array($hab)){
                                            
                                      
                                            if ($rr['status']=='OCUPADA' and $rr['control']=='s') {
                                                $boton='<a href="#" class="btn btn-block btn-lg btn btn-danger waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br> OCUPADA</strong></a>';
                                            }
                                           
                                             elseif ($rr['status']=='DISPONIBLE' and $rr['control']=='s'){
                                                $boton='<a href="DetalleRecepcion.php?c='.claves($id_categoria).'&p='.claves($rr['id']).'" class="btn btn-block btn-lg btn btn-success waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br>'.$s.formato($rr['valor']).'</strong></a>';
                                            }
                                            elseif ($rr['status']=='' or $rr['control']=='n'){
                                                $boton='<a href="DetalleRecepcion.php?c='.claves($id_categoria).'&p='.claves($rr['id']).'" class="btn btn-block btn-lg btn btn-purple waves-effect w-md waves-light m-b-5">
                                                            <strong>'.$rr['nombre'].'<br>'.$s.formato($rr['valor']).'</strong></a>';
                                            }
                                            $n++;
                                            echo '  <div style="float:left;width:33%">
                                                        <table class="table m-0">
                                                        <tr>
                                                            <td align="center">
                                                            '.$boton.'
                                                            </td>
                                                        </tr>
                                                        </table>
                                                       
                                                    </div>';
                                                    
                                            if($n==3){  $n=0;   echo '<br>';    }
                                        }
                                    ?>
                                    <?php }else{ echo mensajes("Seleccione alguna categoria para visualizar Habitación","azul"); } ?>                               
                            </div><hr>
                             <div class="table-responsive">
                                  <table class="table m-0">
                                            <tr>
                                                <td colspan="5"><strong><center>INFORMACION DE LA VENTA</center></strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Descripcion</strong></td>
                                                <td align="center"><strong>P. Unit</div></strong></td>
                                                <td align="center"><strong>Cant</strong></td>
                                                <td align="center"><strong>Total</strong></td>
                                                <td width="5%"></td>
                                            </tr>
                                            <?php 
                                                $subtotal=0;
                                               
                                                 if ($tipo_cliente!='CONVENIO') {

                                                    $ss=mysql_query("SELECT * FROM venta_caja_tmp WHERE usu='$usuario' and id_hospedado=$idhosp");
                                                while($rr=mysql_fetch_array($ss)){


                                                    $importe=$rr['cant']*$rr['val'];
                                                    $subtotal=$subtotal+$importe;
                                                     
                                                     
                                                        
                                            ?>
                                            <tr>
                                                <td><?php echo $rr['nom']; ?></td>

                                                  
                                                     
                                               <td><div align="center"><?php echo $s.formato($rr['val']); ?></div></td>
                                                  

                                              
                                                <td><center><?php echo $rr['cant']; ?></center></td>
                                                <td><div align="center"><?php echo $s.formato($importe); ?></div></td>
                                                <td align="center">
                                                    
                                                        <?php 
                                                            if(!empty($_GET['c'])){ 
                                                                $url='&c='.limpiar($_GET['c']);
                                                            }else{
                                                                $url='';
                                                            }
                                                        ?>
                                                        <a href="modulos/venta/admin.php?remove=<?php echo claves($rr[0]).$url; ?>" class="btn btn-icon btn-xs waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            <?php }      



                                                 }else{
                                                $ss=mysql_query("SELECT * FROM venta_caja_tmp vc, hospedaje h WHERE vc.usu='$usuario' and h.id=$idhosp  and vc.id_hospedado=$idhosp");
                                                while($rr=mysql_fetch_array($ss)){
                                                    $importe=$rr['cant']*$rr['tarifa_dia'];
                                                    $subtotal=$subtotal+$importe;
                                                     
                                                     
                                                        
                                            ?>
                                            <tr>
                                                <td><?php echo $rr['nom']; ?></td>
                                               
                                                     
                                                <td><div align="center"><?php echo $s.formato($rr['tarifa_dia']); ?></div></td>
                                                  


                                                        
                                              
                                                    
                                                
                                                <td><center><?php echo $rr['cant']; ?></center></td>
                                                <td><div align="center"><?php echo $s.formato($importe); ?></div></td>
                                                <td align="center">
                                                    
                                                        <?php 
                                                            if(!empty($_GET['c'])){ 
                                                                $url='&c='.limpiar($_GET['c']);
                                                            }else{
                                                                $url='';
                                                            }
                                                        ?>
                                                        <a href="modulos/venta/admin.php?remove=<?php echo claves($rr[0]).$url; ?>" class="btn btn-icon btn-xs waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></a>
                                                  
                                                </td>
                                            </tr>
                                            <?php }  } ?>
                                            <tr>
                                                <td colspan="4"><h3 class="text-success" align="right"><?php echo $s.formato($subtotal); ?></h3></td>
                                            </tr>
                                        </table>
                                        </div><br>


                                        <div class="row-fluid">
                                            <div class="span6" align="center">
                                                <?php 
                                                    if($subtotal<>0){

                                                        
                                                        ?> 
                                                            <br><br>
                                                            <?php  
                                                        echo '<a href="modulos/venta/facturar.php" style="width:30%" class="btn btn-primary waves-effect w-md waves-light m-b-5"><strong>LIQUIDAR SERVICIOS</strong></a>';
                                                    }
                                                ?> 
                                            </div>
                                            <br>
                                            <div class="span6" align="center">
                                                <a href="Hospedaje.php" style="width:30%" class="btn btn-default waves-effect w-md waves-light m-b-5"><strong>Cerrar</strong></a>
                                            </div>
                                        </div>  

                        </div>


                    </div>


             
            </div> <!-- end container -->
        
        <!-- End wrapper -->



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

        <!-- Notification js -->
        <script src="../../assets/plugins/notifyjs/dist/notify.min.js"></script>
        <script src="../../assets/plugins/notifications/notify-metro.js"></script>     

        <script type="text/javascript">


      function Numeros(e,field) {
 key = e.keyCode ? e.keyCode : e.which;
    if (key === 8)
        return true;
    if (field.value !== "") {
        if ((field.value.indexOf(",")) > 0) {
            if (key > 47 && key < 58) {
                if (field.value === "")
                    return true;
                regexp = /[0-9]{1,10}[,][0-9]{1,3}$/;
                regexp = /[0-9]{2}$/;
                return !(regexp.test(field.value))
            }
        }
    }
    if (key > 47 && key < 58) {
        if (field.value === "")
            return true;
        regexp = /[0-9]{10}/;
        return !(regexp.test(field.value));
    }
    if (key === 44) {
        if (field.value === "")
            return false;
        regexp = /^[0-9]+$/;
        return regexp.test(field.value);
 
    }
 
    return false;

 
}

function Calcular() {


    }

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