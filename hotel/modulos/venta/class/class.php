<?php
class Proceso_Cliente{
	var $id;	
	var $codigo;
	var $nombre;
    var $habitacion;			
	var $documento;		
	var $tipo_cliente;	
	var $compania;		
	var $linea;
	var $centro_costo;
	var $cuenta_contable;
    var $persona_aut;			
	var $cargo;		
	var $mes;	
	var $acom1;		
	var $acom2;	
	

	
	function __construct($id, $codigo,$nombre,$habitacion,$documento,$tipo_cliente,$compania,$linea,$centro_costo,$cuenta_contable,$persona_aut,$cargo,$mes,$acom1,$acom2){
		$this->id=$id;		
		$this->codigo=$codigo;		
		$this->nombre=$nombre;		
		$this->habitacion=$habitacion;	
		$this->documento=$documento;
		$this->tipo_cliente=$tipo_cliente;
		$this->compania=$compania;				
		$this->linea=$linea;	
		$this->centro_costo=$centro_costo;

		$this->cuenta_contable=$cuenta_contable;		
		$this->persona_aut=$persona_aut;	
		$this->cargo=$cargo;
		$this->mes=$mes;
		$this->acom1=$acom1;
		$this->acom2=$acom2;			
	}
	
	function crear(){
		$id=$this->id;		
		$documento=$this->documento;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$celular=$this->celular;		
		$estado=$this->estado;	
		$sucursal=$this->sucursal;	
							
		mysql_query("INSERT INTO cliente (nit, nom, dir, tel, cel, descuento, lcredito, sucursal, estado) 
					VALUES ('$documento','$nombre','$direccion','$telefono','$celular','','','$sucursal','$estado')");
	}


		function crear_hospedaje(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$habitacion=$this->habitacion;	
		$documento=$this->documento;	
		$tipo_cliente=$this->tipo_cliente;
		$compania=$this->compania;		
		$linea=$this->linea;	
		$centro_costo=$this->centro_costo;	

		$cuenta_contable=$this->cuenta_contable;		
		$persona_aut=$this->persona_aut;	
		$cargo=$this->cargo;	
		$mes=$this->mes;
		$acom1=$this->acom1;	
		$acom2=$this->acom2;



                                                                         $ss=mysql_query("SELECT nit FROM cliente WHERE nom='$nombre'");
                                                                    
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                       
                                                                           
                                                                           
                                                                        $cedulahosp = $rr['nit'];
                                                                      
                                                                    }



                                                                  


		mysql_query("INSERT INTO hospedaje (id, codigo, nombre, habitacion, documento, tipo_cliente, compania, linea, centro_costo, cuenta_contable, persona_aut, cargo, fecha, mes_facturar, acompanante1, acompanante2) VALUES (NULL, '$cedulahosp', '$nombre', '$habitacion', '$documento', '$tipo_cliente', '$compania', '$linea', '$centro_costo', '$cuenta_contable', '$persona_aut', '$cargo', NOW(), '$mes', '$acom1', '$acom2')");

																		
                                                                
                                                                    $ss=mysql_query("SELECT c.nombre as categorias,p.nombre as nombres FROM confi c inner join producto p on c.id=p.categoria WHERE p.nombre='$habitacion'");
                                                                    
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                        $cat = $rr['categorias'];
                                                                             
                                                                        
                                                                    }
                                                                           //PARA CAMBIAR LA HABITACION A ESTADO OCUPADO

                                                                          $hab=mysql_query("SELECT id FROM producto WHERE nombre='$habitacion'");
                                                                    
                                                                    while($res=mysql_fetch_array($hab)){
                                                                       
                                                                           
                                                                           
                                                                        $idhabitacion = $res['id'];
                                                                      
                                                                    }


                                                                     mysql_query("UPDATE producto SET status='OCUPADA', limpiada=' ', cliente_tmp='$nombre' WHERE id=$idhabitacion");
                                                                     	

                                                                     	////


                                                                     $ss=mysql_query("SELECT c.id, c.nombre as nombre, c.tarifa_ind as INDIVIDUAL, c.tarifa_dob as DOBLE, c.tarifa_tri as TRIPLE, c.tarifa_mat as MATRIMONIAL, c.tarifa_sui as SUITE, c.tarifa_men as MENSUAL FROM compania c WHERE c.nombre='$compania'");
                                                                        
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                        $temp = $rr['nombre'];
                                                                        
                                                                            if($temp!=NULL){



                                                                            $INDIVIDUAL = $rr['INDIVIDUAL'];
                                                                            $DOBLE = $rr['DOBLE'];
                                                                            $TRIPLE = $rr['TRIPLE'];
                                                                            $MATRIMONIAL = $rr['MATRIMONIAL'];
                                                                            $SUITE = $rr['SUITE'];
                                                                            $MENSUAL = $rr['MENSUAL'];
                                                                            


                                                    $cons=mysql_query("SELECT MAX(id)as id_maximo FROM hospedaje");
                                                    if($rr=mysql_fetch_array($cons)){
                                                        $idhospedado=$rr['id_maximo'];
                                                    }

                                                                       
                                                                        if ($cat=='INDIVIDUAL') {                                                               
                                                                        
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$INDIVIDUAL' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='DOBLE') {
                                                                       mysql_query("UPDATE hospedaje SET tarifa_dia='$DOBLE' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='TRIPLE') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$TRIPLE' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='MATRIMONIAL') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$MATRIMONIAL' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='SUITE') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$SUITE' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='MENSUAL') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$MENSUAL' WHERE id=$idhospedado");
                                                                    }
                                                                         
                                                                         }
                                                                        }
							
	}
	
		

	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$habitacion=$this->habitacion;	
		$documento=$this->documento;	
		$tipo_cliente=$this->tipo_cliente;
		$compania=$this->compania;		
		$linea=$this->linea;	
		$centro_costo=$this->centro_costo;	

		$cuenta_contable=$this->cuenta_contable;		
		$persona_aut=$this->persona_aut;	
		$cargo=$this->cargo;	
		$mes=$this->mes;
		
		mysql_query("UPDATE hospedaje SET codigo='$codigo', 
										nombre='$nombre',
										habitacion='$habitacion',
										documento='$documento',
										tipo_cliente='$tipo_cliente',																			
										compania='$compania',
										linea='$linea',
										centro_costo='$centro_costo',
										cuenta_contable='$cuenta_contable',																			
										persona_aut='$persona_aut',
										cargo='$cargo',
										mes_facturar='$mes'
									WHERE id=$id");



			  $ss=mysql_query("SELECT c.nombre as categorias,p.nombre as nombres FROM confi c inner join producto p on c.id=p.categoria WHERE p.nombre='$habitacion'");
                                                                    
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                        $cat = $rr['categorias'];
                                                                             
                                                                        
                                                                    }
                                                                           //PARA CAMBIAR LA HABITACION A ESTADO OCUPADO

                                                                          $hab=mysql_query("SELECT id FROM producto WHERE nombre='$habitacion'");
                                                                    
                                                                    while($res=mysql_fetch_array($hab)){
                                                                       
                                                                           
                                                                           
                                                                        $idhabitacion = $res['id'];
                                                                      
                                                                    }


                                                                     mysql_query("UPDATE producto SET status='OCUPADA', limpiada=' ', cliente_tmp='$nombre' WHERE id=$idhabitacion");
                                                                     	

                                                                     	////


                                                                     $ss=mysql_query("SELECT c.id, c.nombre as nombre, c.tarifa_ind as INDIVIDUAL, c.tarifa_dob as DOBLE, c.tarifa_tri as TRIPLE, c.tarifa_mat as MATRIMONIAL, c.tarifa_sui as SUITE, c.tarifa_men as MENSUAL FROM compania c WHERE c.nombre='$compania'");
                                                                        
                                                                    while($rr=mysql_fetch_array($ss)){
                                                                        $temp = $rr['nombre'];
                                                                        
                                                                            if($temp!=NULL){



                                                                            $INDIVIDUAL = $rr['INDIVIDUAL'];
                                                                            $DOBLE = $rr['DOBLE'];
                                                                            $TRIPLE = $rr['TRIPLE'];
                                                                            $MATRIMONIAL = $rr['MATRIMONIAL'];
                                                                            $SUITE = $rr['SUITE'];
                                                                            $MENSUAL = $rr['MENSUAL'];
                                                                            


                                                    $cons=mysql_query("SELECT MAX(id)as id_maximo FROM hospedaje");
                                                    if($rr=mysql_fetch_array($cons)){
                                                        $idhospedado=$rr['id_maximo'];
                                                    }

                                                                       
                                                                        if ($cat=='INDIVIDUAL') {                                                               
                                                                        
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$INDIVIDUAL' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='DOBLE') {
                                                                       mysql_query("UPDATE hospedaje SET tarifa_dia='$DOBLE' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='TRIPLE') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$TRIPLE' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='MATRIMONIAL') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$MATRIMONIAL' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='SUITE') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$SUITE' WHERE id=$idhospedado");
                                                                    }elseif ($cat=='MENSUAL') {
                                                                        mysql_query("UPDATE hospedaje SET tarifa_dia='$MENSUAL' WHERE id=$idhospedado");
                                                                    }
                                                                         
                                                                         }
                                                                        }



		}



		function consultar(){
		$id=$this->id;		
		$documento=$this->documento;		
		$nombre=$this->nombre;		
		$direccion=$this->direccion;	
		$telefono=$this->telefono;	
		$celular=$this->celular;		
		$estado=$this->estado;	
		$sucursal=$this->sucursal;
		
		mysql_query("UPDATE cliente SET nit='$documento', 
										nom='$nombre',
										dir='$direccion',
										tel='$telefono',
										cel='$celular',																			
										sucursal='$sucursal',
										estado='$estado'
									WHERE id='$id'");
		}
}
?>