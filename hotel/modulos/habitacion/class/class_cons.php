<?php
class Proceso_Consumo{
	var $id;	
	
	
    var $hosp;			
	#var $proveedor;		
	#var $inventario;		
	var $habitacion;
	var $tipo_consumo;
	var $clientehosp;
	var $documento;
	var $servicio;

	var $cant;
	var $total;
	var $observaciones;

	
	function __construct($id,$hosp,$habitacion,$tipo_consumo,$clientehosp,$documento,$servicio,$cant,$total,$observaciones){
		$this->id=$id;		
	
				
		$this->hosp=$hosp;	
			
		$this->habitacion=$habitacion;	
		$this->tipo_consumo=$tipo_consumo;	
		$this->clientehosp=$clientehosp;	
		$this->documento=$documento;	
		$this->servicio=$servicio;	
		$this->cant=$cant;	
		$this->total=$total;	
		$this->observaciones=$observaciones;	
	}
	
	function crear(){
		$id=$this->id;		
		
		$hosp=$this->hosp;		
		$habitacion=$this->habitacion;	
		
		$tipo_consumo=$this->tipo_consumo;	
		$clientehosp=$this->clientehosp;	
		$documento=$this->documento;	
		$servicio=$this->servicio;	
		$cant=$this->cant;	
		$total=$this->total;	
		$observaciones=$this->observaciones;	

							
		mysql_query("INSERT INTO consumos (hospedado, documento, fecha, servicio, cant, valor, habitacion, cliente, observaciones) 
					                VALUES ('$hosp','$documento', NOW(),'$servicio','$cant','$total','$habitacion','$clientehosp','$observaciones')");
	}
	
	function actualizar(){
		$id=$this->id;		
		
		$hosp=$this->hosp;		
		$habitacion=$this->habitacion;	
		
		$tipo_consumo=$this->tipo_consumo;	
		$clientehosp=$this->clientehosp;	
		$documento=$this->documento;	
		$servicio=$this->servicio;	
		$cant=$this->cant;	
		$total=$this->total;	
		$observaciones=$this->observaciones;	
		
		mysql_query("UPDATE consumos SET hospedado='$hosp',
										documento='$documento',
										servicio='$servicio',
										cant='$cant',																			
										valor='$total',
										habitacion='$habitacion',
										cliente='$clientehosp',
										observaciones='$observaciones'
										
									WHERE id=$id");
}
}
?>