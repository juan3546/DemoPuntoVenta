<?php
	/**
	* 
	*/
    class PojoProductos
	{
		//Definiendo atributos
        public $id_producto;
        public $id_proveedor;
        public $id_categoria;
        public $nombre;
        public $descripcion;
        public $estatus;


		function __construct1(){}

		function __construct2($id_producto, $id_proveedor, $id_categoria, $nombre , $descripcion, $estatus)
		{
            $this->id_producto=$id_producto;
            $this->id_proveedor = $id_proveedor;
            $this->id_categoria=$id_categoria;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->estatus=$estatus;
            
		}
	}
?>