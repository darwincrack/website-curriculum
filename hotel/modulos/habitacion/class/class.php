<?php
class Proceso_Producto{
	var $id;	
	var $codigo;
	var $nombre;
    var $categoria;			
	#var $proveedor;		
	#var $inventario;		
	var $iva;
	var $npersona;
	var $valor;
	var $estado;
	var $control;
	
	function __construct($id,$codigo,$nombre,$categoria,$iva,$npersona,$valor,$estado,$control){
		$this->id=$id;		
		$this->codigo=$codigo;		
		$this->nombre=$nombre;		
		$this->categoria=$categoria;	
		#$this->proveedor=$proveedor;
		#$this->inventario=$inventario;			
		$this->iva=$iva;	
		$this->npersona=$npersona;	
		$this->valor=$valor;	
		$this->estado=$estado;	
		$this->control=$control;	
	}
	
	function crear(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$categoria=$this->categoria;	
		#$proveedor=$this->proveedor;	
		#$inventario=$this->inventario;		
		$iva=$this->iva;	
		$npersona=$this->npersona;	
		$valor=$this->valor;	
		$estado=$this->estado;	
		$control=$this->control;	
							
		mysql_query("INSERT INTO producto (codigo, nombre, categoria, inv, estado, iva, npersona, valor, prov,control) 
					                VALUES ('$codigo','$nombre','$categoria','','$estado','$iva','$npersona','$valor','','$control')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;		
		$nombre=$this->nombre;		
		$categoria=$this->categoria;	
		#$proveedor=$this->proveedor;	
		#$inventario=$this->inventario;		
		$iva=$this->iva;	
		$npersona=$this->npersona;	
		$valor=$this->valor;	
		$estado=$this->estado;
		$control=$this->control;
		
		mysql_query("UPDATE producto SET codigo='$codigo', 
										nombre='$nombre',
										categoria='$categoria',
										inv='',
										estado='$estado',																			
										iva='$iva',
										npersona='$npersona',
										valor='$valor',
										prov='',
										control='$control'
									WHERE id='$id'");
}
}
?>