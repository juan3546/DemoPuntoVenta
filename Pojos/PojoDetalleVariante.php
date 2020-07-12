<?php
	/**
	* 
	*/
	class PojoDetalleVariante
	{
		//Definiendo atributos
		public $id_detalle_variante;
		public $nombre;
		public $id_variante;


		function __construct1(){}

		function __construct2($id_detalle_variante,$nombre,$id_variante)
		{
			$this->id_detalle_variante=$id_detalle_variante;
			$this->nombre=$nombre;
			$this->id_variante=$id_variante;
		}
	}
?>