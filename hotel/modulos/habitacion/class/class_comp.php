<?php
class Proceso_Compania{
	var $id;	
	
	var $nombre;
    var $tarifa_ind;			
	#var $proveedor;		
	#var $inventario;		
	var $tarifa_dob;
	var $tarifa_tri;
	var $tarifa_mat;
	var $tarifa_sui;
	var $tarifa_men;
	
	function __construct($id,$nombre,$tarifa_ind,$tarifa_dob,$tarifa_tri,$tarifa_mat,$tarifa_sui,$tarifa_men){
		$this->id=$id;		
	
		$this->nombre=$nombre;		
		$this->tarifa_ind=$tarifa_ind;	
			
		$this->tarifa_dob=$tarifa_dob;	
		$this->tarifa_tri=$tarifa_tri;	
		$this->tarifa_mat=$tarifa_mat;	
		$this->tarifa_sui=$tarifa_sui;	
		$this->tarifa_men=$tarifa_men;	
	}
	
	function crear(){
		$id=$this->id;		
		
		$nombre=$this->nombre;		
		$tarifa_ind=$this->tarifa_ind;	
		#$proveedor=$this->proveedor;	
		#$inventario=$this->inventario;		
		$tarifa_dob=$this->tarifa_dob;	
		$tarifa_tri=$this->tarifa_tri;	
		$tarifa_mat=$this->tarifa_mat;	
		$tarifa_sui=$this->tarifa_sui;	
		$tarifa_men=$this->tarifa_men;	
							
		mysql_query("INSERT INTO compania (nombre, tarifa_ind, tarifa_dob, tarifa_tri, tarifa_mat, tarifa_sui, tarifa_men) 
					                VALUES ('$nombre','$tarifa_ind','$tarifa_dob','$tarifa_tri','$tarifa_mat','$tarifa_sui','$tarifa_men')");
	}
	
	function actualizar(){
		$id=$this->id;		
			
		$nombre=$this->nombre;		
		$tarifa_ind=$this->tarifa_ind;	
		#$proveedor=$this->proveedor;	
		#$inventario=$this->inventario;		
		$tarifa_dob=$this->tarifa_dob;	
		$tarifa_tri=$this->tarifa_tri;	
		$tarifa_mat=$this->tarifa_mat;	
		$tarifa_sui=$this->tarifa_sui;
		$tarifa_men=$this->tarifa_men;
		
		mysql_query("UPDATE compania SET nombre='$nombre',
										tarifa_ind='$tarifa_ind',
										tarifa_dob='$tarifa_dob',
										tarifa_tri='$tarifa_tri',																			
										tarifa_mat='$tarifa_mat',
										tarifa_sui='$tarifa_sui',
										tarifa_men='$tarifa_men'
										
									WHERE id=$id");
}
}
?>