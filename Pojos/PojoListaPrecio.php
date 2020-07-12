<?php
	/**
	* 
	*/
    class PojoListaPrecio
	{
		//Definiendo atributos
		public $id_nombre_precio;
        public $nombre;
        public $estatus;


		function __construct1(){}

		function __construct2($id_nombre_precio,$nombre, $estatus)
		{
			$this->id_nombre_precio=$id_nombre_precio;
            $this->nombre=$nombre;
            $this->estatus=$estatus;
            
		}
	}
?>