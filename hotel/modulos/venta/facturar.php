<?php 
    error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    session_start();
    include_once "../php_conexion.php";
    include_once "../funciones.php";
    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){
        }else{
            header('Location: ../error500.php');
        }
    }else{
        header('Location: ../error500.php');
    }
    $id_metodopago='';
    $usuario=$_SESSION['cod_user'];
    $id_sucursal=consultar('sucursal','username',"usu='$usuario'");
    $por_iva=consultar('val_imp','sucursal',"id='$id_sucursal'");
    $nom_iva=consultar('nom_imp','sucursal',"id='$id_sucursal'");
    $ss=mysql_query("SELECT * FROM venta_info_tmp WHERE usu='$usuario'");
    if($tmp=mysql_fetch_array($ss)){
    }else{
        
    }
    if(!empty($_GET['m'])){
        $id_metodopago=get(limpiar($_GET['m']),'metodopago','id');
        $tipo=consultar('tipo','metodopago',"id='$id_metodopago'");
        $ss=mysql_query("SELECT id FROM venta_pago_tmp WHERE metodopago='$id_metodopago' and usuario='$usuario'");
        if($rr=mysql_fetch_array($ss)){
            mysql_query("DELETE FROM venta_pago_tmp WHERE metodopago='$id_metodopago' and usuario='$usuario'");
        }else{
            mysql_query("INSERT INTO venta_pago_tmp (metodopago,valor,usuario,tipo) VALUES ('$id_metodopago','0','$usuario','$tipo')"); 
        }
        header('Location: facturar.php');
    }else{
        $id_metodopago='';
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../../assets/images/favicon_1.ico">

        <title>Forma de Pago</title>
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
        <link href="../../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="../../assets/js/modernizr.min.js"></script>
         <script type="text/javascript">
 
            function objetoAjax(){
                var xmlhttp = false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
         
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (E) {
                        xmlhttp = false; }
                }
         
                if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                  xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

        </script>

    </head>


    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                   
                    <!-- End Logo container-->

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
             

        <div class="wrapper">
            <div class="container">
                    <div class="col-lg-3">
                        <div class="panel panel-purple panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">Forma de Pago</h3>                              
                            </div>
                            <div class="panel-body">                          
                            <div class="table-responsive">
                                <table class="table m-0">
                                        <?php 
                                            $n=0;
                                            $ss=mysql_query("SELECT * FROM metodopago ORDER BY tipo,nombre");
                                            while($rr=mysql_fetch_array($ss)){ 
                                                if(consultar('metodopago','venta_pago_tmp',"usuario='$usuario' and metodopago='".$rr[0]."'")<>NULL){
                                                    $class='btn-warning';
                                                }else{
                                                    $class='btn-default';
                                                }



                                        ?>

                                        <tr>
                                            <td>
                                            
                                                <center><a href="facturar.php?m=<?php echo claves($rr[0]); ?>" class="btn btn-block btn-lg  waves-effect waves-light <?php echo $class; ?>" style="width:80%">
                                                <strong><?php echo nelson($rr['tipo']).'<br>'.$rr['nombre']; ?></strong></a></center>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                     
                                    </table>                                 
                            </div>                                       
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="panel panel-success panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">Detalle de la Factura</h3>                                
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                            <tr>
                                                <td colspan="2"><strong>Descripcion</strong></td>
                                                <td><strong><div align="right">Valor Unit.</div></strong></td>
                                                
                                                <td><strong><center>Cant</center></strong></td>
                                                <td width="100"><strong><div align="right">Total</div></strong></td>
                                            </tr>
                                            <?php 
                                                $subtotalhab=0;$total_iva=0;$t_impuestos=0;$impuesto=0;
                                                $ss=mysql_query("SELECT * FROM venta_caja_tmp WHERE usu='$usuario'");
                                                while($rr=mysql_fetch_array($ss)){
                                                    
                                                    if(consultar('iva','producto',"codigo='".$rr['cod']."'")=='n'){
                                                        $valor_iva=0;
                                                    }else{
                                                        $valor_iva=($rr['val']*$rr['cant'])*(($por_iva/100));
                                                    }
                                                    $importe=$rr['val']*$rr['cant'];
                                                    $subtotalhab=$subtotalhab+$importe;
                                                    //$total_iva=$total_iva+$valor_iva;

                                                    $impuesto=$subtotalhab*15/100;
                                                    $t_impuestos=$total_iva+$impuesto;
                                                  
                                            ?>
                                            <tr>
                                                <td colspan="2"><?php echo $rr['nom']; ?></td>
                                                <td><div align="right"><?php echo $s.formato($rr['val']); ?></div></td>
                                                
                                                <td width="100"><center><?php echo $rr['cant']; ?></center></td>
                                                <td width="100"><div align="right"><?php echo $s.formato($importe); ?></div></td>
                                            </tr>
                                            <?php
                                            $nomhabitacion = $_SESSION['nomhabitacion'];
                                             $cons=mysql_query("SELECT *,cant as cantidad FROM consumos WHERE habitacion='$nomhabitacion'");
                                                $subtotalserv=0;
                                                $totalserv=0;

                                                while($res=mysql_fetch_array($cons)){

                                                    $totalserv = $res['valor'];
                                                    $subtotalserv = $subtotalserv + $totalserv;
                                                    

                                                    ?>
                                                    <tr>
                                                <td colspan="2"><?php echo 'SERVICIO DE '.$res['servicio'] ; ?></td>
                                                <td><div align="right"><?php echo ''; ?></div></td>
                                                
                                                <td><center><?php echo $res['cantidad']; ?></center></td>
                                                <td width="100"><div align="right"><?php echo $res['valor']; ?></div></td>
                                            </tr>

                                                <?php
                                                }
                                                ?>
                                                    
                                            <?php } 
                                            
                                            $_SESSION['neto'.$usuario]=$neto;
                                            $subtotal=$subtotalhab+$subtotalserv;
                                            $total_iva=$subtotal*($por_iva/100);
                                            $neto=$subtotalhab+$subtotalserv+$total_iva;
                                            ?>
                                            <tr>
                                                <td colspan="4"><strong><div align="right">SubTotal: </div></strong></td>
                                                <td><div align="right"><strong><?php echo $s.formato($subtotal); ?></strong></div></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong><div align="right">IVA: </div></strong></td>
                                                <td><div align="right"><strong><?php echo $s.formato($total_iva); ?></strong></div></td>
                                            </tr>
                                           
                                            
											<tr>
                                                <td colspan="4"><h3 class="text-success" align="right"><strong>TOTAL: </strong></h3></td>
                                                <td><h3 class="text-success" align="right"><strong><?php echo $s.formato($neto); ?></strong></h3></td>
                                            </tr>
                                        </table>
                                 
                                </div>                                                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-danger panel-border">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">Facturación</h3>                                
                            </div>
                            <div class="panel-body">
                                   <?php 
                                        $ss1=mysql_query("SELECT id FROM venta_pago_tmp WHERE usuario='$usuario'");
                                        if($rrr=mysql_fetch_array($ss1)){
                                    ?>
                                   
                                    <form name="gor" action="proceso.php" method="post">
                                        <input type="hidden" name="neto" value="<?php echo $neto; ?>">
                                        <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                                        <input type="hidden" name="impuesto" value="<?php echo $total_iva; ?>">                       
                                        <table class="table m-0">
                                            <tr>
                                                <td>
                                                    <center>
                                                        <?php if($tmp['cliente']=='cliente' and $tmp['nombre']==''){ ?>
                                                        <strong>Nombre del Cliente</strong><br>
                                                        <input type="text" name="nombre" autocomplete="off" class="form-control" required value="" onKeyUp="this.value=this.value.toUpperCase();"><br>
                                                        <?php }else{ ?>
                                                        <input type="hidden" name="nombre" value="">
                                                        <?php } ?>
                                                        
                                                        <?php 
                                                            $contado=0;$credito=0;$ncontado=0;
                                                            $sql=mysql_query("SELECT * FROM venta_pago_tmp WHERE usuario='$usuario'");
                                                            while($rr=mysql_fetch_array($sql)){
                                                                if($rr['tipo']=='Contado'){
                                                                    $contado=$contado+$rr['valor'];     
                                                                    $ncontado++;
                                                                }elseif($rr['tipo']=='Credito'){
                                                                    $credito=$credito+$rr['valor'];
                                                                }
                                                        ?>
                                                             <script>
                                                                function valor<?php echo $rr['metodopago']; ?>(valor){
                                                                    var url = 'DibujaEstado.php';
                                                                    var pars = ("filtro=" + valor + "&pago=" + <?php echo $rr['metodopago']; ?>);
                                                                    var myAjax = new Ajax.Updater('divEstado', url, { method: 'get', parameters: pars});
                                                                }
                                                            </script>
                                                            <strong><?php echo nelson(consultar('tipo','metodopago',"id='".$rr['metodopago']."'")).' - '.consultar('nombre','metodopago',"id='".$rr['metodopago']."'"); ?></strong><br>
                                                            <input type="number" class="form-control" name="v<?php echo $rr['metodopago']; ?>" autocomplete="off" required min="0" 
                                                            step="any" value="<?php echo $rr['valor']; ?>" onchange="valor<?php echo $rr['metodopago']; ?>(this.value);">
                                                        <?php } ?>
                                                        
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div id="divEstado">
                                                        <?php 
                                                        $prueba1='85,00';
                                                        $prueba2='50,25';
                                                            $prueba=$prueba1-$prueba2;
                                                            $cambio=$contado-$neto;
                                                            $acomulado=$contado+$credito;
                                                            $error='';
                                                            
                                                            if($ncontado>1 and ($neto-$credito)<$contado){
                                                                $estado1=false;
                                                                $error.='<br>El Valor en Efectivo es suficiente pagarlo con un solo Metodo de Pago<br>';
                                                            }else{
                                                                $estado1=true;
                                                            }
                                                            if($acomulado>=$neto){
                                                                $estado_neto=true;
                                                            }else{
                                                                $estado_neto=false;
                                                                #echo mensajes('Valor Ingresado debe superar o igualar el Valor a Pagar','verde');
                                                                $error.='<br>El valor Ingresado debe ser mayor o igual al Valor a Pagar<br>';
                                                            }
                                                            
                                                            if($credito<=$neto){
                                                                $estado_credito=true;
                                                                $class_credito='text-success';
                                                            }else{
                                                                $estado_credito=false;
                                                                $class_credito='text-error';
                                                                $error.='<br>El Valor de la Tarjeta no puede superar el Valor a Pagar<br>';
                                                            }
                                                            if(($credito==$neto and $contado<>0)){
                                                                $estado_contado=false;
                                                                $error.='<br>Si la Tarjeta supera el Total a Pagar no permite Valores al Contado<br>';
                                                            }else{
                                                                $estado_contado=true;
                                                            }
                                                            
                                                            echo '
                                                                <div class="row">
                                                                 <div class="col-sm-6 col-lg-12">
                                                                        <div class="widget-simple text-center card-box bg-danger">
                                                                            <h4 class="text-white counter">CAMBIO</h4>
                                                                            <h1 class="text-white">'.$s.formato($cambio).'</h1>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <input type="hidden" name="cambio" value="'.$cambio.'">
                                                            ';
                                                            
                                                            if($estado_contado==true and $estado_credito==true and $estado_neto==true and $estado1==true){
                                                                echo '<center><button type="submit" class="btn-block btn-lg btn-danger waves-effect waves-light"><i class="fa fa-newspaper-o"></i>
                                                                <strong>Facturar</strong></button></center>';
                                                            }else{
                                                                echo '<center><strong>'.$error.'</strong></center>';
                                                            }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <?php }else{  echo mensajes('Seleccione una forma de pago para Facturar','azul'); } ?>                              
                            </div>
                        </div>
                    </div>

                <!-- Footer -->
                
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
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
             <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/prototype.js"></script>
            <script type="text/javascript" src="js/eventos.js"></script>


    </body>
</html>