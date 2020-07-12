<?php
	/**
	* 
	*/
	class PojoProductoVariante
	{
		//Definiendo atributos
		public $id_producto_variante;
		public $id_producto;
		public $codigo_barras;


		function __construct1(){}

		function __construct2($id_producto_variante,$id_producto,$codigo_barras)
		{
			$this->id_producto_variante=$id_producto_variante;
			$this->id_producto=$id_producto;
			$this->codigo_barras=$codigo_barras;
		}
	}
?>