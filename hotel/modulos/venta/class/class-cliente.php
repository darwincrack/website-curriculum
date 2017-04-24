<?php
class Proceso_Nuevo{
	var $id;	
	var $documento;
	var $nombre;
    var $direccion;			
	var $telefono;		
	var $celular;		
	

	var $estado;
	var $sucursal;
	
	function __construct($id, $documento,$nombre,$direccion,$telefono,$celular,$estado,$sucursal){
		$this->id=$id;		
		$this->documento=$documento;		
		$this->nombre=$nombre;		
		$this->direccion=$direccion;	
		$this->telefono=$telefono;
		$this->celular=$celular;
	

		$this->estado=$estado;	
		$this->sucursal=$sucursal;	
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
					VALUES ('$documento','$nombre','$direccion','$telefono','$celular','','','2','$estado')");
	}
	
	function actualizar(){
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
										sucursal='2',
										estado='$estado'
									WHERE id='$id'");
}
}
?>