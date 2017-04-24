<?php 
  error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    //session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
    include_once "/class/class_cons.php";
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


        <title> Consumos De Servicios</title>
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
                <input type="hidden" name="consumomodal" value="SI">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" align="center">Nuevo Consumo</h4>
                                        </div>
                                        <div class="modal-body">

                                                <div class="row">
                                                 <div class="col-md-5">
                                                    <div class="form-group">
                                                         <label for="field-2" class="control-label">Tipo Consumo:</label>
                                                        
                                                        <select class="form-control select2" name="hosp" id="hosp" onChange="ConsumoOnChange(this)" required>
                                                                <option>Seleccionar</option>
                                                                <option value="SI">Cliente Hospedado</option>
                                                                <option value="NO">Sin hospedaje</option>

                                                                  </select>
                                                    </div>
                                                </div>

                                                    <div id="Habit" style="display:none;">
                                                     <div class="col-md-4">

                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Habitacion:</label>
                                                        
                                                        <select class="form-control select2" name="habitacion" id="habitacion" onChange="HabitacionOnChange(this)">
                                                                <option value="">Seleccionar</option>
                                                                  <?php 
                                                                    $ss=mysql_query("SELECT nombre,status FROM producto WHERE nombre LIKE 'HAB%' and estado='s' and status='OCUPADA' ORDER BY nombre");
                                                                    
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                            echo '<option value="'.$rr['nombre'].'">'.$rr['nombre'].'</option>';
                                                                       
                                                                        
                                                                    }





                                                                ?>               
                                                 
                                             
                                                            </select>
                                                    </div>
                                                    <div id="recargado">Mi texto sin recargar</div>
        <p align="center">
            <a href="#" onclick="javascript:enviar();">recargar</a>
            </p>
                                                </div>
                                                </div>
                                                </div>
                                                        <div class="row">
                                                    <div id="ClienteSinhospedaje" style="display:none;">
                                                   <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Cliente:</label>
                                                        
                                                        <select class="form-control select2" name="cliesinhosp" id="cliesinhosp" required>
                                                                <option>Seleccionar</option>
                                                                <?php 

                                                                    $ss=mysql_query("SELECT nom,nit FROM cliente ORDER BY nom");

                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                            echo '<option value="'.$rr['nom'].'">'.$rr['nom'].'</option>';
                                                                       
                                                                            
                                                                    }


                                                                       
                                                                ?>                                                          
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>

                                                 <div id="ClienteConhospedaje" style="display:none;">
                                                   <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Cliente Hospedado:</label>
                                                        
                                                        <select class="form-control select2" name="clieconhosp" id="clieconhosp" required>
                                                                <option>Seleccionar</option>
                                                                <?php 

                                                                if(!empty($_GET['consumomodal'])){

                                                                    $habtmp=get(limpiar($_GET['habitacion']));

                                                                     }
                                                                     $habtmp="HABITACION 10";
                                                               
                                                                    $ss=mysql_query("SELECT * FROM hospedaje WHERE habitacion='$habtmp' and facturado='NO' ORDER BY nombre");

                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                            echo '<option value="'.$rr['nombre'].'">'.$rr['nombre'].'</option>';
                                                                            if (!empty($rr['acompanante1'])) {
                                                                                echo '<option value="'.$rr['acompanante1'].'">'.$rr['acompanante1'].'</option>';
                                                                            }

                                                                            if (!empty($rr['acompanante2'])) {
                                                                            
                                                                            echo '<option value="'.$rr['acompanante2'].'">'.$rr['acompanante2'].'</option>';
                                                                             }
                                                                            
                                                                    }


                                                                       
                                                                ?>                                                          
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>


                                        
                                          
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">N° Documento:</label>
                                                        <input type="text" name="documento" id="documento" required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                 </div>


                                                 <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Servicio:</label>
                                                        
                                                        <select class="form-control select2" name="servicio" id="servicio" required>
                                                                <option value="">Seleccionar</option>
                                                                <?php 

                                                                    $ss=mysql_query("SELECT *,p.nombre as servicio FROM producto p inner join confi c on p.categoria=c.id WHERE c.nombre='SERVICIOS' ORDER BY servicio");

                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                            echo '<option value="'.$rr['servicio'].'">'.$rr['servicio'].'</option>';
                                                                       
                                                                            
                                                                    }


                                                                       
                                                                ?>                                                          
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Cant:</label>
                                                        <input type="text" name="cant" required class="form-control" autocomplete="off" onkeypress="return SoloEnteros(event, this);">
                                                    </div>
                                                </div>
                                           
                                            
                                               
                                               
                                             
                                                 <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">V. Total:</label>
                                                        <input type="text" name="total" id="total" required class="form-control" autocomplete="off" onkeypress="return Numeros(event, this);">
                                                    </div>
                                                </div>

                                                </div>
                                           

                                              
                                                <div class="row">
                                                 <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Observaciones:</label>
                                                        <input type="text" name="observaciones" maxlength="255" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
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



<script type="text/javascript">

function HospedadoOnChange(sel) {
       

        $codhospedad = sel.value;
        document.getElementById("cod").value = $codhospedad; 

       var combo = document.getElementById("nom");
        var $nomhospedad = combo.options[combo.selectedIndex].text;
        document.getElementById("nomhospedado").value = $nomhospedad;

                                                                  
      
     
}


function HabitacionOnChange(sel) {
       

        $codhospedad = sel.value;
        document.getElementById("cod").value = $codhospedad; 

       var combo = document.getElementById("nom");
        var $nomhospedad = combo.options[combo.selectedIndex].text;
        document.getElementById("nomhospedado").value = $nomhospedad;

                                                                  
      
     
}

function ConsumoOnChange(sel) {
        if (sel.value=="SI"){

        
         divC = document.getElementById("ClienteConhospedaje");
           divC.style.display = "";
         
           divD = document.getElementById("ClienteSinhospedaje");

           divD.style.display = "none";

           divH = document.getElementById("Habit");
           divH.style.display = "";

        
           

        }else{

            divC = document.getElementById("ClienteSinhospedaje");
           divC.style.display = "";
         
           divD = document.getElementById("ClienteConhospedaje");
           divD.style.display = "none";
            divH = document.getElementById("Habit");
           divH.style.display = "none";


        

           
            }
}

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

function SoloEnteros(e,field) {
   key = e.keyCode ? e.keyCode : e.which;
    if (key === 8)
        return true;
    if (field.value !== "") {
        if ((field.value.indexOf(",")) > 0) {
            if (key > 47 && key < 58) {
                if (field.value === "")
                    return true;
                regexp = /[0-9]{1,10}[,][0-9]{1,3}$/;
                regexp = /[0-9]{0}$/;
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




</script>                            

     
            <div class="container">
                         <?php
                                   if(!empty($_POST['hosp'])){ 
                                              
                                        $hosp=limpiar($_POST['hosp']);      
                                        $habitacion=limpiar($_POST['habitacion']);
                                        $tipo_consumo=limpiar($_POST['hosp']);
                                        

                                        $clieconhosp=limpiar($_POST['clieconhosp']);
                                        $cliesinhosp=limpiar($_POST['cliesinhosp']);
                                        if ($clieconhosp!="Seleccionar") {
                                            $clientehosp=limpiar($_POST['clieconhosp']);
                                        }else{

                                             $clientehosp=limpiar($_POST['cliesinhosp']);
                                            }

                                        $documento=limpiar($_POST['documento']); 
                                        $servicio=limpiar($_POST['servicio']);                                                                                       
                                        $cant=limpiar($_POST['cant']);                                                                                          
                                        $total=limpiar($_POST['total']); 
                                        $observaciones=limpiar($_POST['observaciones']);                                                                                                                                                                                      
                                                                                                                                                                                                                           
                                                                            
                                                                    
                                        if(empty($_POST['id'])){
                                            $oProducto=new Proceso_Consumo('',$hosp,$habitacion,$tipo_consumo,$clientehosp,$documento,$servicio,$cant,$total,$observaciones);
                                          
                                                    $oProducto->crear();
                                                     $ss=mysql_query("SELECT MAX(id)as id_maximo FROM consumos");
                                                    if($rr=mysql_fetch_array($ss)){
                                                        $id=$rr['id_maximo'];
                                                    }

                                            echo mensajes('Consumo #"'.$documento.'" del cliente'.$cliente.'Registrado con Exito.','verde'); 
                                                
                                           
                                           
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oProducto=new Proceso_Consumo($id,$hosp,$habitacion,$tipo_consumo,$clientehosp,$documento,$servicio,$cant,$total,$observaciones);
                                            $oProducto->actualizar();
                                            echo mensajes('Consumo #"'.$documento.'" Actualizado con Exito, con el Cliente '.$cliente,'verde');
                                        }
                         
                                    }            
                            ?>                                      
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title" align="center"><b>Registro de Consumos</b></h4>
                             <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#nuevo" > <i class="fa fa-user-plus" ></i> Nuevo Consumo</button></div>                       
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                       
                                        <th>ID</th>
                                        <th>Fecha Consumo</th>
                                        <th>N° Documento</th>                                        
                                        <th>Servicio</th>   
                                        <th>Cant</th>   
										<th>Valor Total</th> 										
                                                                              
                                        <th>Habitacion</th> 
                                        <th>Cliente</th>   
                                        <th> </th>   
                                                                                                                                                          
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT * FROM consumos ORDER BY servicio");
                                        while($rr=mysql_fetch_array($ss)){
                                           
                                    ?>
                                    <tr>                                       
                                        <td><?php echo $rr['id']; ?></td>
                                        <td><?php echo $rr['fecha']; ?></td>
                                        <td><?php echo $rr['documento'];  ?></td>
                                        <td><?php echo $rr['servicio']; ?></td>
                                         <td><?php echo $rr['cant']; ?></td>
                                        <td><?php echo $rr['valor'];  ?></td>
                                        <td><?php echo $rr['habitacion']; ?></td>
                                        <td><?php echo $rr['cliente']; ?></td>
                                        <td align="center" >
                                          
                                                                                 
                                                <?php 
                                                if ($rr['habitacion']=="") {

                                                    ?>                                          
                                                
                                                 <div  class="btn-group btn-group m-b-10">
                                                
                                                    <a href="DetalleRecepcion.php?c=<?php echo claves($categoriahab).'&p='.claves($idhab); ?>" class="btn btn-success btn-sm waves-effect waves-light"><i class="glyphicon glyphicon-shopping-cart" ></i> Facturar</a>
                                                    
                                                </div>
                                                <?php    }   ?>
                                                                                        
                                        </td>
                                        
                                        
                                        <!-- end container                 
                                                                           
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
                                        </td>  -->   


                                        <td><?php echo $rr['observaciones']; ?></td>
                                    </tr>
                                    <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="id" value="<?php echo $rr['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Consumo</h4>
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

            <script>
    function enviar()
    {



    var variable_post = document.getElementById("habitacion").value;
    $.post("miscript.php", { variable: variable_post }, function(data){
    $("#recargado").html(data);
    });         
    }
    </script>
        



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
    $('#liConsumos').addClass("active");

</script>


    </body>
</html>