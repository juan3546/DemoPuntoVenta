<?php
	/**
	* 
	*/
	class PojoCategoria
	{
		//Definiendo atributos
		public $id_categoria;
		public $nombre;
		public $estatus;


		function __construct1(){}

		function __construct2($id_categoria,$nombre,$estatus)
		{
			$this->id_categoria=$id_categoria;
			$this->nombre=$nombre;
			$this->estatus=$estatus;
		}
	}
?>