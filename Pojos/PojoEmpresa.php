<?php
	/**
	* 
	*/
    class PojoEmpresa
	{
		//Definiendo atributos
		public $id_empresa;
		public $id_nombre_precio;
        public $nombre;
        public $rfc;
        public $estatus;


		function __construct1(){}

		function __construct2($id_empresa,$id_nombre_precio,$nombre, $rfc, $estatus)
		{
			$this->id_empresa=$id_empresa;
			$this->id_nombre_precio=$id_nombre_precio;
            $this->nombre=$nombre;
            $this->rfc=$rfc;
            $this->estatus=$estatus;
            
		}
	}
?>