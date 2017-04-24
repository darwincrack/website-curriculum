<?php 
  error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
    //session_start();
    include_once "modulos/php_conexion.php";
    include_once "modulos/funciones.php";
    include_once "/class/class.php";
    include_once "/class/class-cliente.php";

    if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='u'){
        if(permisos($_SESSION['seguridad'.$_SESSION['cod_user']],'Recepción','1')==true){
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
        <title> -Listado de Clientes</title>
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">N° Documento:</label>
                                                        <input type="text" name="cedula"  required  class="form-control" autocomplete="off" maxlength="13" onkeypress="return Numeros(event);">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Apellidos y Nombres:</label>
                                                        <input type="text" name="cliente"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Dirección:</label>
                                                        <input type="text" name="dir"  required class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Telefono Conv:</label>
                                                        <input type="text" name="tel"  required class="form-control" onkeypress="return Numeros(event);" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Celular:</label>
                                                        <input type="text" name="cel"  required class="form-control" onkeypress="return Numeros(event);" autocomplete="off">
                                                    </div>
                                                </div>
                                              <!-- sucursales 
                                             
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-6" class="control-label">Sucursal:</label>
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
                                                </div>  -->  

                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Estado del Cliente:</label>
                                                        <select class="form-control select2" name="estado" required>                                               
                                                                <option value="s">Activo</option>
                                                                 <option value="n">Inactivo</option>                                                    
                                                            </select>
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






                            <div id="nuevoregistro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <form action="" name="form1" method="post" enctype="multipart/form-data">
                <input type="hidden" name="registro" value="si">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" align="center">Nuevo Registro de Hospedaje</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">N° Identificacion:</label>
                                                        

                                                        <input type="text" name="cod" id="cod" class="form-control" onkeypress="return Numeros(event);" onChange="CedulaOnChange()" required>
                                                        <input type="hidden" name="nomhospedado" id="nomhospedado" class="form-control" autocomplete="off">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Hospedado:</label>
                                                        
                                                        <select class="form-control select2" name="nom" id="nom" onChange="HospedadoOnChange(this)" required>
                                                                <option value="">Seleccionar</option>
                                                                <?php 

                                                                    $ss=mysql_query("SELECT nom,nit FROM cliente ORDER BY nom");

                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                            echo '<option value="'.$rr['nit'].'">'.$rr['nom'].'</option>';
                                                                       
                                                                            
                                                                    }


                                                                       
                                                                ?>                                                          
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                         
                                            <div class="row">

                                                     <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Habitacion:</label>
                                                        
                                                        <select class="form-control select2" name="hab" required>
                                                                <option value="">Seleccionar</option>
                                                                  <?php 
                                                                    $ss=mysql_query("SELECT nombre,status FROM producto WHERE nombre LIKE 'HAB%' and estado='s' and status='DISPONIBLE' or status='PENDIENTE LIMPIEZA' ORDER BY nombre");
                                                                    
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                            echo '<option value="'.$rr['nombre'].'">'.$rr['nombre'].' - '.$rr['status'].'</option>';
                                                                       
                                                                        
                                                                    }





                                                                ?>               
                                                 
                                             
                                                            </select>
                                                    </div>
                                                </div>




                                               
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Tipo Cliente:</label>
                                                        <div id="Cliente" style="display:none;">
                                                         <input type="text" name="tipoc" id="tipoc" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboCliente" style="display:;">
                                                          <select class="form-control select2" name="tipo" onChange="ClienteOnChange(this)" required >   
                                                                <option value="">Seleccionar</option>                                           
                                                                <option value="PERSONAL">PERSONAL</option>
                                                                <option value="CONVENIO">CONVENIO</option>   
                                                                <option value="OPERADOR TURISTICO">OPERADOR TURISTICO</option>
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                    </div>
                                                </div>

                                                    <div class="col-md-4">
                                                    <div class="form-group">
                                                         <div id="Companias" style="display:none;">
                                                        <label for="field-4" class="control-label">Compañia:</label>
                                                         <select class="form-control select2" name="compania">
                                                                <option value="">Seleccionar</option>
                                                                <?php 

                                                                    $ss=mysql_query("SELECT nombre FROM compania ORDER BY nombre");
                                                                    
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                            echo '<option value="'.$rr['nombre'].'">'.$rr['nombre'].'</option>';
                                                                       
                                                                        
                                                                    }
                                                                ?>                                                          
                                                            </select>
                                                            </div>
                                                    </div>
                                                </div>


                                                     
                                                 <div class="row">
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                          <div id="Documento" style="display:none;">

                                                        <label for="field-4" class="control-label">N° Documento:</label>
                                                        <input type="text" name="doc" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                </div>

                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Lineas" style="display:none;">

                                                        <label for="field-4" class="control-label">Linea:</label>
                                                        <div id="Linea" style="display:none;">  
                                                         <input type="text" name="line" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboLinea" style="display:;">
                                                          <select class="form-control select2" name="lin" onChange="LineaOnChange(this)"> 
                                                                <option value="">Seleccionar</option>                                              
                                                                <option value="ATL">ATL</option>
                                                                <option value="BDT">BDT</option>   
                                                                <option value="CPS">CPS</option>
                                                                <option value="OFS">OFS</option>
                                                                <option value="SMIS">SMIS</option>   
                                                                <option value="WL">WL</option>
                                                                <option value="WS">WS</option>   
                                                                <option value="TST">TST</option>
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                             </div>
                                                    </div>
                                                </div>

                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Centros" style="display:none;">
                                                        <label for="field-4" class="control-label">Centro Costo:</label>
                                                       <div id="Centro" style="display:none;">
                                                         <input type="text" name="cent" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboCentro" style="display:;">
                                                        <select class="form-control select2" name="cen" onChange="CentroOnChange(this)"> 
                                                                <option value="">Seleccionar</option>                                             
                                                                <option value="EC100002">EC100002</option>
                                                                <option value="EC100006">EC100006</option>   
                                                                <option value="EC100012">EC100012</option>
                                                                <option value="EC100014">EC100014</option>
                                                                <option value="EC100046">EC100046</option>   
                                                                <option value="EC100049">EC100049</option>

                                                                <option value="EC100050">EC100050</option>
                                                                <option value="EC100080">EC100080</option>
                                                                <option value="EC100087">EC100087</option>   
                                                                <option value="EC100090">EC100090</option>

                                                                <option value="EC100091">EC100091</option>
                                                                <option value="EC100096">EC100096</option>
                                                                <option value="EC100114">EC100114</option>   
                                                                <option value="EC100124">EC100124</option>
                                                                <option value="EC100136">EC100136</option>
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                    </div>
                                                     </div>
                                                </div>

                                                </div>

                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Cuentas" style="display:none;">
                                                        <label for="field-4" class="control-label">Cuenta Contable:</label>
                                                        <div id="Cuenta" style="display:none;">
                                                         <input type="text" name="cuen" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboCuenta" style="display:;">
                                                         <select class="form-control select2" name="cue" onChange="CuentaOnChange(this)"> 
                                                            
                                                                <option value="">Seleccionar</option>                                             
                                                                
                                                                <option value="SG001300">SG001300</option>   
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div>



<script type="text/javascript">

function HospedadoOnChange(sel) {
       

        $codhospedad = sel.value;
        document.getElementById("cod").value = $codhospedad; 

       var combo = document.getElementById("nom");
        var $nomhospedad = combo.options[combo.selectedIndex].text;
        document.getElementById("nomhospedado").value = $nomhospedad;

                                                                  
      
     
}

function CedulaOnChange() {
       

       
       $cedulah = document.getElementById("cod").value; 

       
           

        var combo = document.getElementById("nom");
        combo.options[combo.selectedIndex].text = $cedulah;
      

      

                                                                  
      
     
}

    
   function CuentaOnChange(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Cuenta");
           divC.style.display = "";

           divT = document.getElementById("ComboCuenta");
           divT.style.display = "none";

      }
}


function ClienteOnChange(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Cliente");
           divC.style.display = "";
          

           divT = document.getElementById("ComboCliente");
           divT.style.display = "none";
            
            


      }else if (sel.value=="CONVENIO"){

         //document.getElementById("colectivo").disabled = true;
         divC = document.getElementById("Companias");
           divC.style.display = "";

           divD = document.getElementById("Documento");
           divD.style.display = "";

           divL = document.getElementById("Lineas");
           divL.style.display = "";


           divCe = document.getElementById("Centros");
           divCe.style.display = "";

             divCu = document.getElementById("Cuentas");
           divCu.style.display = "";

           divP = document.getElementById("Personas");
           divP.style.display = "";

           divFu = document.getElementById("Funciones");
           divFu.style.display = "";

           divMe = document.getElementById("Meses");
           divMe.style.display = "";

           divAc1 = document.getElementById("Acomp1");
           divAc1.style.display = "";

            divAc2 = document.getElementById("Acomp2");
           divAc2.style.display = "";


           

        }else{

            divC = document.getElementById("Companias");
           divC.style.display = "none";


           divD = document.getElementById("Documento");
           divD.style.display = "none";

            divL = document.getElementById("Lineas");
           divL.style.display = "none";



           divCe = document.getElementById("Centros");
           divCe.style.display = "none";

             divCu = document.getElementById("Cuentas");
           divCu.style.display = "none ";

           divP = document.getElementById("Personas");
           divP.style.display = "none";

           divFu = document.getElementById("Funciones");
           divFu.style.display = "none";

           divMe = document.getElementById("Meses");
           divMe.style.display = "none";

            divAc1 = document.getElementById("Acomp1");
           divAc1.style.display = "none";

            divAc2 = document.getElementById("Acomp2");
           divAc2.style.display = "none";



           
            }
}

function LineaOnChange(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Linea");
           divC.style.display = "";

           divT = document.getElementById("ComboLinea");
           divT.style.display = "none";

      }
}
function CentroOnChange(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Centro");
           divC.style.display = "";

           divT = document.getElementById("ComboCentro");
           divT.style.display = "none";

      }
}

function Numeros(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }



</script>
                                       
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                         <div id="Personas" style="display:none;">
                                                        <label for="field-4" class="control-label">Persona Autoriza:</label>
                                                        <input type="text" name="per" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                </div>

                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Funciones" style="display:none;">
                                                        <label for="field-4" class="control-label">Funcion/Cargo:</label>
                                                        <input type="text" name="fun" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                 </div>


                                                 <div id="Acomp1" style="display:none;">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Acompañante 1:</label>
                                                        
                                                        <select class="form-control select2" name="acom1" id="acom1">
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


                                                    <div id="Acomp2" style="display:none;">
                                                   <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Acompañante 2:</label>
                                                        
                                                        <select class="form-control select2" name="acom2" id="acom2">
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


                                                 
                                               
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div id="Meses" style="display:none;">
                                                        <label for="field-4" class="control-label">Mes a Facturar:</label>
                                                        <input style="width:180px;" style="font-size: 1rem" type="month" id="mes"/>
                                                         
                                                    </div>
                                                </div>
                                                </div>
                                        
                                            </div>





                                           
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Asignar Imagen</label>
                                                        <input type="file" name="imagen" class="form-control">
                                                    </div>
                                                </div>-->
                                                                                      
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
                                    if(!empty($_POST['cliente'])){ 
                                        $documento=limpiar($_POST['cedula']);       
                                        $nombre=limpiar($_POST['cliente']);      
                                        $direccion=limpiar($_POST['dir']);
                                        $telefono=limpiar($_POST['tel']);
                                        $celular=limpiar($_POST['cel']);
                                       

                                        $estado=limpiar($_POST['estado']);
                                        $sucursal=1;
                                        //limpiar($_POST['sucursal']);                                      
                                                                    
                                        if(empty($_POST['id'])){
                                            $oPaciente=new Proceso_Nuevo('',$documento,$nombre,$direccion,$telefono,$celular,$estado,$sucursal);
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

                                            echo mensajes('El Cliente "'.$nombre.'" fue guardado con Exito, con el codigo '.cb($id),'verde'); 
                                                }
                                           
                                           
                                        }else{
                                            $id=limpiar($_POST['id']);
                                            $oPaciente=new Proceso_Nuevo($id,$documento,$nombre,$direccion,$telefono,$celular,$estado,$sucursal);
                                            $oPaciente->actualizar();
                                            echo mensajes('Cliente "'.$nombre.'" Actualizado con Exito, con la ID de '.cb($id),'verde');
                                        }
                        
                                    }            
                            ?>                     











                   <?php

                           



                                   if(!empty($_POST['registro'])){ 

                                        $codigo=limpiar($_POST['cod']);       
                                        $nombre=limpiar($_POST['nomhospedado']);      
                                        $habitacion=limpiar($_POST['hab']);
                                        $documento=limpiar($_POST['doc']);
                                         if($_POST['tipo']=='OTRO'){
                                           $tipo_cliente=limpiar($_POST['tipoc']);        
                                        }else{

                                              $tipo_cliente=limpiar($_POST['tipo']);
                                            }  
                                            if($_POST['tipo']=='CONVENIO'){

                                                 $compania=limpiar($_POST['compania']);

                                             }                                                                            
                                       
                                       

                                         if($_POST['lin']=='OTRO'){
                                          $linea=limpiar($_POST['line']);         
                                        }else{

                                             $linea=limpiar($_POST['lin']);
                                            }                                                                                  
                                       

                                         if($_POST['cen']=='OTRO'){
                                         $centro_costo=limpiar($_POST['cent']);         
                                        }else{

                                            $centro_costo=limpiar($_POST['cen']);
                                            }
                                        
                                        if($_POST['cue']=='OTRO'){
                                         $cuenta_contable=limpiar($_POST['cuen']);         
                                        }else{

                                            $cuenta_contable=limpiar($_POST['cue']); 
                                            }
                                             
                                        $persona_aut=limpiar($_POST['per']);      
                                        $cargo=limpiar($_POST['fun']);
                                      //  $fecha=limpiar($_POST['fecha']);
                                        $mes=limpiar($_POST['mes']); 
                                        $acom1=limpiar($_POST['acom1']);
                                        $acom2=limpiar($_POST['acom2']);     

                                        
                                            $oPaciente=new Proceso_Cliente('',$codigo,$nombre,$habitacion,$documento,$tipo_cliente,$compania,$linea,$centro_costo,$cuenta_contable,$persona_aut,$cargo,$mes,$acom1,$acom2);
                                            $oPaciente->crear_hospedaje();
                                            echo mensajes('Registro de Hospedaje creado con Exito.','verde'); 

                                        
                                    }elseif (!empty($_POST['idregistro'])) {
                                            $id=limpiar($_POST['idregistro']);
                                                 $codigo=limpiar($_POST['codedit']);       
                                        $nombre=limpiar($_POST['nomhospedadoedit']);      
                                        $habitacion=limpiar($_POST['hab']);
                                        $documento=limpiar($_POST['doc']);
                                         if($_POST['tipo']=='OTRO'){
                                           $tipo_cliente=limpiar($_POST['tipoc']);        
                                        }else{

                                              $tipo_cliente=limpiar($_POST['tipo']);
                                            }  
                                            if($_POST['tipo']=='CONVENIO'){

                                                 $compania=limpiar($_POST['compania']);

                                             }                                                                            
                                       
                                       

                                         if($_POST['lin']=='OTRO'){
                                          $linea=limpiar($_POST['line']);         
                                        }else{

                                             $linea=limpiar($_POST['lin']);
                                            }                                                                                  
                                       

                                         if($_POST['cen']=='OTRO'){
                                         $centro_costo=limpiar($_POST['cent']);         
                                        }else{

                                            $centro_costo=limpiar($_POST['cen']);
                                            }
                                        
                                        if($_POST['cue']=='OTRO'){
                                         $cuenta_contable=limpiar($_POST['cuen']);         
                                        }else{

                                            $cuenta_contable=limpiar($_POST['cue']); 
                                            }
                                             
                                        $persona_aut=limpiar($_POST['per']);      
                                        $cargo=limpiar($_POST['fun']);
                                      //  $fecha=limpiar($_POST['fecha']);
                                        $mes=limpiar($_POST['mes']);      

                                            $EditarRegistro=new Proceso_Cliente($id,$codigo,$nombre,$habitacion,$documento,$tipo_cliente,$compania,$linea,$centro_costo,$cuenta_contable,$persona_aut,$cargo,$mes);
                                            $EditarRegistro->actualizar();
                                            echo mensajes('Registro de Hospedaje de "'.$nombre.'" fue Actualizado con Exito, con el Doc. N° '.$codigo,'verde'); 
                                    }

                                            

                                              
                            ?>       


                                                 
            <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h1 class="m-t-0 header-title" align="center"><b>REGISTRO DE ENTRADA - CHECK IN</b></h1>


                            <tr>
                                <td>
                            <div align="center"><button class="btn btn-icon waves-effect waves-light btn-success m-b-5"  data-toggle="modal"  data-target="#nuevo" > <i class="fa fa-user-plus"  ></i> Nuevo Cliente </button></div>							
                                </td>
                                <td>
                            <div align="center"><button class="btn btn-icon waves-effect waves-light btn-primary m-b-5"  data-toggle="modal"  data-target="#nuevoregistro" > <i class="fa fa-bed"  ></i> Nuevo Hospedaje </button></div>                            
                                </td>
                            </tr>
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Fecha</th>
                                        <th>N° Ident.</th>
                                        <th>Hospedado</th>
                                        <th>Habitacion</th>
                                                                              
                                        <th>Tipo Cliente</th> 
                                        <th></th>
                                        <th></th>
                                         <th></th>
                                         <th>N° Doc</th> 
                                        <th>Compañia</th>  
                                        
                                                                             
                                        <th>Linea</th>                                                                              
                                        <th>Centro Costo</th>
                                        <th>Cuenta Cont.</th>
                                        <th>Persona Aut.</th>                                       
                                        <th>Funcion/Cargo</th>                                                                                                                
                                        <th>Mes a Facturar</th>
                                        <th>Acompañante1</th>
                                        <th>Acompañante2</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        $ss=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d-%m-%Y %T') as fechaorder FROM hospedaje ORDER BY fecha DESC");
                                        $i = 0;
                                        while($rr=mysql_fetch_array($ss)){
                                            $estado=$rr['estado'];
                                             $sucu=$rr['sucursal'];
                                             
                                             $i++; 
                                          $nomhabitacion = $rr['habitacion'];
                                          

                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rr['fechaorder']; ?></td>
                                        <td><?php echo $rr['codigo']; ?></td>
                                        <td><?php echo $rr['nombre']; ?></td>
                                        <td><?php echo $rr['habitacion']; ?></td>
                                        
                                        <td><?php echo $rr['tipo_cliente']; ?></td>
                                        
                                     <!--
                                        <?php

                                        
                                         $cadena = $rr['habitacion'];
                                        if(stristr($cadena,'HAB')) {

                                            echo "SI HAY ";
                                            echo stristr($cadena,'HAB');

                                        }else{
                                                echo "NO HAY ";
                                                echo stristr($cadena,'HAB');
                                                
                                            }

                                        ?>   -->
                                         <?php 
                                            
                                        
                                        $cons=mysql_query("SELECT * FROM producto WHERE nombre='$nomhabitacion'");
                                        
                                        while($resul=mysql_fetch_array($cons)){
                                            $categoriahab=$resul['categoria'];
                                             $idhab=$resul['id'];
                                             
                                            
                                             }
                                             $_SESSION['nomhabitacion'] = "HABITACION 16";
                                             $_SESSION['categoria'] = 2;
                                             $_SESSION['idhosp'] = 45; 
                                             $_SESSION['idhab'] = 22; 
                                             $_SESSION['tipocliente'] = "CONVENIO";



                                     

                                         ?>



                                        
                                        

                                        <td align="center" >
                                          
                                                                                 
                                               
                                                 <div  class="btn-group btn-group m-b-10">
                                                 <a href="Consumos.php" class="btn btn-purple btn-sm waves-effect waves-light"><i class="glyphicon glyphicon-cutlery" ></i> Consumos</a>
                                                    
                                                </div>
                                                                                        
                                        </td>
                                         <td align="center" >
                                          
                                                                                 
                                               
                                                 <div  class="btn-group btn-group m-b-10">
                                                
                                                    <a href="DetalleRecepcion.php?c=<?php echo claves($categoriahab).'&p='.claves($idhab); ?>" class="btn btn-success btn-sm waves-effect waves-light"><i class="glyphicon glyphicon-shopping-cart" ></i> Facturar</a>
                                                    
                                                </div>
                                                                                        
                                        </td>
                                         <td align="center" >
                                          
                                                                                 
                                               
                                                 <div  class="btn-group btn-group m-b-10">
                                                
                                                    <a href="#editar<?php echo $rr['id']; ?>" class="btn btn-primary btn-sm waves-effect waves-light" role="button" data-toggle="modal"> <i class="fa  fa-pencil-square-o"></i> Editar</a>
                                                </div>
                                                                                        
                                        </td>

                                        <td><?php echo $rr['documento']; ?></td>
                                        <td><?php echo $rr['compania']; ?></td>

                                      
                                       
                                        
                                                
                                                                                        
                                        </td>
                                        <td><?php echo $rr['linea']; ?></td>
                                        <td><?php echo $rr['centro_costo']; ?></td>
                                        <td><?php echo $rr['cuenta_contable']; ?></td>
                                        <td><?php echo $rr['persona_aut']; ?></td>
                                        <td><?php echo $rr['cargo']; ?></td>
                                        <td><?php echo $rr['mes_facturar']; ?></td>
                                        <td><?php echo $rr['acompanante1']; ?></td>
                                        <td><?php echo $rr['acompanante2']; ?></td>
                                        
                                          
                                    </tr>
                                      



                                   <div id="editar<?php echo $rr['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <form action="" name="form1" method="post">
                                    <input type="hidden" name="idregistro" value="<?php echo $rr['id']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" align="center">Editar Registro de Hospedaje</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                 
                                                    <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-1" class="control-label">N° Identificacion:</label>
                                                        

                                                        <input type="text" name="codigoedit" id="codigoedit" class="form-control" disabled>
                                                        <input type="hidden" name="codedit" id="codedit" value="<?php echo $rr['codigo']; ?>" class="form-control">
                                                        <input type="hidden" name="nomhospedadoedit" id="nomhospedadoedit" value="<?php echo $rr['nombre']; ?>" class="form-control" autocomplete="off">
                                                        
                                                    </div>
                                                </div>
                                                           <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="field-2" class="control-label">Hospedado:</label>
                                                        
                                                        <select class="form-control select2" name="nomedit" id="nomedit" onChange="HospedadoOnChanges(this)" required>
                                                                
                                                                             <?php 
                                                                             echo '<option value="'.$rr['nombre'].'">'.$rr['nombre'].'</option>';
                                                                    $mysql=mysql_query("SELECT nom,nit FROM cliente ORDER BY nom");

                                                                    while($res=mysql_fetch_array($mysql)){
                                                                       
                                                                            echo '<option value="'.$res['nit'].'">'.$res['nom'].'</option>';
                                                                       
                                                                            
                                                                    }


                                                                       
                                                                ?>                               
                                                            </select>
                                                    </div>
                                                </div>


                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Habitacion:</label>
                                                        
                                                        <select class="form-control select2" name="hab" required>

                                                                  <?php 
                                                                  echo '<option value="'.$rr['habitacion'].'">'.$rr['habitacion'].'</option>';
                                                                    $mysql=mysql_query("SELECT nombre,status FROM producto WHERE nombre LIKE 'HAB%' and estado='s' and status='DISPONIBLE' or status='PENDIENTE LIMPIEZA' ORDER BY nombre");
                                                                    
                                                                    while($res=mysql_fetch_array($mysql)){
                                                                       
                                                                            echo '<option value="'.$res['nombre'].'">'.$res['nombre'].' - '.$res['status'].'</option>';
                                                                       
                                                                        
                                                                    }





                                                                ?>               
                                                 
                                             
                                                            </select>
                                                    </div>
                                                </div>
                                               
                                               <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="field-4" class="control-label">Tipo Cliente:</label>
                                                        <div id="Clienteedit" style="display:none;">
                                                         <input type="text" name="tipoc" id="tipoc" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboClienteedit" style="display:;">
                                                          <select class="form-control select2" name="tipo" onChange="ClienteOnChanges(this)" required >   
                                                          <!-- Generales<?php
                                                            if ($rr['tipo_cliente']=="PERSONAL") {
                                                                ?> 
                                                                <script type="text/javascript"> 
                                                                    TipoClienteDesactivar(); 
                                                                </script> 
                                                             <?php  
                                                              }else{
                                                                ?>

                                                                <script type="text/javascript"> 
                                                                    TipoClienteActivar(); 
                                                                </script> 

                                                                <?php
                                                            }
                                                              echo '<option value="'.$rr['tipo_cliente'].'">'.$rr['tipo_cliente'].'</option>';
                                                              

                                                             ?>       -->  
                                                                <option>Seleccionar</option>                                   
                                                                <option value="PERSONAL">PERSONAL</option>
                                                                <option value="CONVENIO">CONVENIO</option>   
                                                                <option value="ADMINISTRADOR TURISTICO">ADMINISTRADOR TURISTICO</option>
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                    </div>
                                                </div>



                                                    <div class="col-md-4">
                                                    <div class="form-group">
                                                         <div id="Companiasedit" style="display:none;">
                                                        <label for="field-4" class="control-label">Compañia:</label>
                                                         <select class="form-control select2" name="compania">
                                                               
                                                                     <?php 
                                                                      echo '<option value="'.$rr['compania'].'">'.$rr['compania'].'</option>';
                                                                    $mysql=mysql_query("SELECT nombre FROM compania ORDER BY nombre");
                                                                    
                                                                    while($res=mysql_fetch_array($mysql)){
                                                                       
                                                                            echo '<option value="'.$res['nombre'].'">'.$res['nombre'].'</option>';
                                                                       
                                                                        
                                                                    }
                                                                ?>                                                      
                                                            </select>
                                                            </div>
                                                    </div>
                                                </div>
                                                                                                 <div class="row">
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                          <div id="Documentoedit" style="display:none;">

                                                        <label for="field-4" class="control-label">N° Documento:</label>
                                                        <input type="text" name="doc" class="form-control" autocomplete="off" value="<?php echo $rr['documento']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                </div>

                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Lineasedit" style="display:none;">

                                                        <label for="field-4" class="control-label">Linea:</label>
                                                        <div id="Lineaedit" style="display:none;">  
                                                         <input type="text" name="line" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboLineaedit" style="display:;">
                                                          <select class="form-control select2" name="lin" onChange="LineaOnChanges(this)"> 
                                                              <?php    echo '<option value="'.$rr['linea'].'">'.$rr['linea'].'</option>';   ?>                                            
                                                                <option value="ATL">ATL</option>
                                                                <option value="BDT">BDT</option>   
                                                                <option value="CPS">CPS</option>
                                                                <option value="OFS">OFS</option>
                                                                <option value="SMIS">SMIS</option>   
                                                                <option value="WL">WL</option>
                                                                <option value="WS">WS</option>   
                                                                <option value="TST">TST</option>
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                             </div>
                                                    </div>
                                                </div>

                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Centrosedit" style="display:none;">
                                                        <label for="field-4" class="control-label">Centro Costo:</label>
                                                       <div id="Centroedit" style="display:none;">
                                                         <input type="text" name="cent" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboCentroedit" style="display:;">
                                                        <select class="form-control select2" name="cen" onChange="CentroOnChanges(this)"> 
                                                                <?php    echo '<option value="'.$rr['centro_costo'].'">'.$rr['centro_costo'].'</option>';   ?>                                             
                                                                <option value="EC100002">EC100002</option>
                                                                <option value="EC100006">EC100006</option>   
                                                                <option value="EC100012">EC100012</option>
                                                                <option value="EC100014">EC100014</option>
                                                                <option value="EC100046">EC100046</option>   
                                                                <option value="EC100049">EC100049</option>

                                                                <option value="EC100050">EC100050</option>
                                                                <option value="EC100080">EC100080</option>
                                                                <option value="EC100087">EC100087</option>   
                                                                <option value="EC100090">EC100090</option>

                                                                <option value="EC100091">EC100091</option>
                                                                <option value="EC100096">EC100096</option>
                                                                <option value="EC100114">EC100114</option>   
                                                                <option value="EC100124">EC100124</option>
                                                                <option value="EC100136">EC100136</option>
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                    </div>
                                                     </div>
                                                </div>

                                                </div>


                                                    <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Cuentasedit" style="display:none;">
                                                        <label for="field-4" class="control-label">Cuenta Contable:</label>
                                                        <div id="Cuentaedit" style="display:none;">
                                                         <input type="text" name="cuen" class="form-control" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();">
                                                                 </div>
                                                                  <div id="ComboCuentaedit" style="display:;">
                                                         <select class="form-control select2" name="cue" onChange="CuentaOnChanges(this)"> 
                                                            
                                                                <?php    echo '<option value="'.$rr['cuenta_contable'].'">'.$rr['cuenta_contable'].'</option>';   ?>                                              
                                                                
                                                                <option value="SG001300">SG001300</option>   
                                                                <option value="OTRO">OTRO</option>    
                                                                                                  
                                                            </select>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div>


<script type="text/javascript">

function HospedadoOnChanges(sel) {
       

        $codhospedad = sel.value;
        document.getElementById("codigoedit").value = $codhospedad; 
        document.getElementById("codedit").value = $codhospedad; 

       var combo = document.getElementById("nomedit");
        var $nomhospedad = combo.options[combo.selectedIndex].text;
        document.getElementById("nomhospedadoedit").value = $nomhospedad;

                                                                  
      
     
}


function TipoClienteActivar() {
       

       

         divC = document.getElementById("Companiasedit");
           divC.style.display = "";

           divD = document.getElementById("Documentoedit");
           divD.style.display = "";

           divL = document.getElementById("Lineasedit");
           divL.style.display = "";


           divCe = document.getElementById("Centrosedit");
           divCe.style.display = "";

             divCu = document.getElementById("Cuentasedit");
           divCu.style.display = "";

           divP = document.getElementById("Personasedit");
           divP.style.display = "";

           divFu = document.getElementById("Funcionesedit");
           divFu.style.display = "";

           divMe = document.getElementById("Mesesedit");
           divMe.style.display = "";
                                                                  
      
     
}


function TipoClienteDesactivar() {
       

       

         divComp = document.getElementById("Companiasedit");
           divComp.style.display = "none";

           divDocum = document.getElementById("Documentoedit");
           divDocum.style.display = "none";

           divLin = document.getElementById("Lineasedit");
           divLin.style.display = "none";


           divCent = document.getElementById("Centrosedit");
           divCent.style.display = "none";

             divCuen = document.getElementById("Cuentasedit");
           divCuen.style.display = "none";

           divPers = document.getElementById("Personasedit");
           divPers.style.display = "none";

           divFunc = document.getElementById("Funcionesedit");
           divFunc.style.display = "none";

           divMes = document.getElementById("Mesesedit");
           divMes.style.display = "none";
                                                                  
      
     
}


    
   function CuentaOnChanges(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Cuentaedit");
           divC.style.display = "";

           divT = document.getElementById("ComboCuentaedit");
           divT.style.display = "none";

      }
}


function ClienteOnChanges(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Clienteedit");
           divC.style.display = "";
          

           divT = document.getElementById("ComboClienteedit");
           divT.style.display = "none";
            
            


      }else if (sel.value=="CONVENIO"){

         //document.getElementById("colectivo").disabled = true;
         divC = document.getElementById("Companiasedit");
           divC.style.display = "";

           divD = document.getElementById("Documentoedit");
           divD.style.display = "";

           divL = document.getElementById("Lineasedit");
           divL.style.display = "";


           divCe = document.getElementById("Centrosedit");
           divCe.style.display = "";

             divCu = document.getElementById("Cuentasedit");
           divCu.style.display = "";

           divP = document.getElementById("Personasedit");
           divP.style.display = "";

           divFu = document.getElementById("Funcionesedit");
           divFu.style.display = "";

           divMe = document.getElementById("Mesesedit");
           divMe.style.display = "";

           

        }else{

            divC = document.getElementById("Companiasedit");
           divC.style.display = "none";


           divD = document.getElementById("Documentoedit");
           divD.style.display = "none";

            divL = document.getElementById("Lineasedit");
           divL.style.display = "none";



           divCe = document.getElementById("Centrosedit");
           divCe.style.display = "none";

             divCu = document.getElementById("Cuentasedit");
           divCu.style.display = "none ";

           divP = document.getElementById("Personasedit");
           divP.style.display = "none";

           divFu = document.getElementById("Funcionesedit");
           divFu.style.display = "none";

           divMe = document.getElementById("Mesesedit");
           divMe.style.display = "none";



           
            }
}

function LineaOnChanges(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Lineaedit");
           divC.style.display = "";

           divT = document.getElementById("ComboLineaedit");
           divT.style.display = "none";

      }
}
function CentroOnChanges(sel) {
      if (sel.value=="OTRO"){
           divC = document.getElementById("Centroedit");
           divC.style.display = "";

           divT = document.getElementById("ComboCentroedit");
           divT.style.display = "none";

      }
}



</script>


                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                         <div id="Personasedit" style="display:none;">
                                                        <label for="field-4" class="control-label">Persona Autoriza:</label>
                                                        <input type="text" name="per" class="form-control" autocomplete="off" value="<?php echo $rr['persona_aut']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                </div>

                                                         <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div id="Funcionesedit" style="display:none;">
                                                        <label for="field-4" class="control-label">Funcion/Cargo:</label>
                                                        <input type="text" name="fun" class="form-control" autocomplete="off" value="<?php echo $rr['cargo']; ?>" onKeyUp="this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                 </div>

                                                 
                                               
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div id="Mesesedit" style="display:none;">
                                                        <label for="field-4" class="control-label">Mes a Facturar:</label>
                                                        <input style="width:180px;" style="font-size: 1rem" type="month" value="<?php echo $rr['mes_facturar']; ?>" id="mes"/>
                                                         
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
    $('#liHospedaje').addClass("active");

</script>

    </body>
</html>