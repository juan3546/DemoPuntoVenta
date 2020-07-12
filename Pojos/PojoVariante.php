<?php
	/**
	* 
	*/
	class PojoVariante
	{
		//Definiendo atributos
		public $id_variante;
		public $nombre;
		public $estatus;


		function __construct1(){}

		function __construct2($id_variante,$nombre,$estatus)
		{
			$this->id_variante=$id_variante;
			$this->nombre=$nombre;
			$this->estatus=$estatus;
		}
	}
?>