<!-- Archivo que permite realizar la conexion a 
la BD -->
<?php
class Conexion
{
    private static $db = 'tpv';
    private static $servidor = 'locahost';
    private static $puerto = '3306';
    private static $usuario = 'root';
    private static $password = 'Angel123*';
    private static $conexion  = null;

    public function __construct() {
        exit('Instancia no permitida');
    }
    
    //Funcion que permite abrir una nueva conexion a la base de datos
    public static function abrirConexion()
    {
        //self permite hacer una referencia al elemento estático
        //Se verifica si ya hay una conexión abierta
        if ( null == self::$conexion )
        {     
            try
            {
                self::$conexion =  new PDO( "mysql:host=".self::$servidor.";"."dbname=".self::$db, self::$usuario, self::$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$conexion;
            }
            catch(PDOException $e)
            {
                exit($e->getMessage()); 
            }
        }
        return self::$conexion;
    }
    
    //Funcion que permite cerrar la conexion a la base de datos 
    public static function cerrarConexion()
    {
        self::$conexion = null;
    }
}
?>