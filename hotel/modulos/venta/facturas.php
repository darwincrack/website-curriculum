<?php 
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
	if(!empty($_GET['i'])){
		$id_factura=get(limpiar($_GET['i']),'factura','id');
		$usuario=$_SESSION['cod_user'];
		$id_sucursal=consultar('sucursal','username'," usu='$usuario'");
		$tama=consultar('tama','sucursal'," id='$id_sucursal'");
		$letra=consultar('letra','sucursal'," id='$id_sucursal'");
		$ss=mysql_query("SELECT * FROM factura WHERE id='$id_factura'");
		if($factura=mysql_fetch_array($ss)){
		}

        $hosp=mysql_query("SELECT * FROM hospedaje WHERE id=45");
        if($hospedaje=mysql_fetch_array($hosp)){
        }

         $client=mysql_query("SELECT * FROM cliente WHERE id=18");
        if($cliente=mysql_fetch_array($client)){
        }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento# <?php echo formato_factura($id_factura); ?></title>
</head>
<style type="text/css" media="print">
#Imprime {
	height: 491px;
	width: 794px;
	margin: 20px;
	padding: 0px;
	float: left;
	font-family: "Comic Sans MS", cursive;
	font-size: 7px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000;
}
@page{
   margin: 20px;
}
</style>
<body>
<div id="Imprime">
<table align="center">
    <tr>
        <td>
              <table width="95%" style="font-size:<?php echo 11; ?>px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif">
                 <tr>
                    <td colspan="4">                                                
                    
                   
                    
                     <tr>
                        
                        <td align="left"></td>
                        <td></td>
                        <td></td>
                        <td align="right"><div><strong></strong><?php echo $hospedaje['nombre']; ?></div></td>
                       
                        </tr>  

                          <tr>
                        
                        <td align="left"></td>
                        <td></td>
                        <td></td>
                        <td align="right"> <div align="right"><strong></strong><?php echo $cliente['nit']; ?><br></div></td>
                       
                        </tr>    

                         <tr>
                        
                        <td align="left">  </td>
                        <td></td>   
                        <td></td>
                        <td align="right"> <div align="right"><strong></strong><?php echo $cliente['dir']; ?></div></td>
                       
                        </tr>                                          
                                                                    
                
                   
                   
                    
                         <tr>
                        
                        <td align="left">   <div align="left"><strong></strong><?php echo $factura['fecha'].' '.$factura['hora']; ?></div> </td>
                        <td></td>
                        <td></td>
                        <td align="right">  <div align="right"><strong></strong><?php echo $cliente['tel'].$cliente['cel']; ?></div></td>
                       
                        </tr>       
                   

                    
                      
                    </td>

                    


                    </tr>     
                    <tr>
                        <td colspan="4"><center></center></td>
                    </tr>
                        <tr>
                        <td align="left"></td>
                        <td align="left"></td>
                        <td></td>
                        <td align="center"></td>
                        </tr>
                    <tr>
                        <td colspan="4"><center></center></td>
                    </tr>
                            
                           <?php
                                 $tur=0;$t_impuestos=0; $iva_factura=0; 
                                $ss=mysql_query("SELECT * FROM factura_detalle WHERE factura=80");
                                while($rr=mysql_fetch_array($ss)){
                                    //$tur=$factura['subtotal']*15/100;
                                    $iva_factura=10;
                                    $t_impuestos=$iva_factura;
                            ?>
                        <tr>
                            <td><div align="left"><?php echo $rr['cant']; ?><div></td>                                                                                              
                            <td align="left"><?php echo $rr['nom']; ?></td>
                            <td ><div align="left"><?php echo $s.formato($rr['val']); ?></div></td>                                            
                            <td><div align="center"><?php echo $s.formato($rr['val']*$rr['cant']); ?></div></td>
                        </tr>
                           <?php } ?>                 
                        <tr>
                            <td colspan="4" align="right"></td>
                        </tr>                                                  
                        <!--<tr>
                            <td colspan="4">
                                <div align="right">SUB TOTAL: <?php echo $s.formato($factura['subtotal']-$t_impuestos); ?></div>                                                           
                            </td>
                        </tr><br>-->
                       
                         
                         <tr>
                            <td colspan="4">
							<div align="right"> <?php echo $s.formato($factura['subtotal']); ?></div>  
                               <!--<div align="right"> TOTAL IMPUESTOS: <?php echo $s.formato($t_impuestos); ?></div>-->                                                             
                            </td>
                        </tr><br>

                          <tr>
                            <td colspan="4">
                               <div align="right"> <?php echo $s.formato($t_impuestos); ?></div>                                                             
                            </td>
                        </tr><br>
                        <tr>
                            <td colspan="4">
                               <div align="right"><strong> <?php echo $s.formato($factura['neto']); ?></strong><br></div>                                                              
                            </td>
                        </tr>
                       
                        <tr>
                            <td colspan="4"><center></center></td>
                        </tr>
                        <!--<tr>                                                
                            <td colspan="4"><center><strong> PAGO CONTADO: </strong></center></td>                                             
                        </tr>
                        <tr>                                                
                            <td colspan="4"><center><strong> CAMBIO: $ </strong></center></td>
                        </tr>     
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>-->
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><center></center></td>
                        </tr><br>
                                          
                     </table>
          </td>
       </tr>
    </table>

</body>
</html>