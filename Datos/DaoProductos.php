<?php
require_once 'Conexion.php'; /*importa Conexion.php*/
require_once '../Pojos/PojoProductos.php';


class DaoProductos
{
  private $conexion; /*Crea una variable conexion*/
  private function conectar()
  {
    try{
     $this->conexion = Conexion::abrirConexion(); /*inicializa la variable conexion, llamando a la funcion abrirConexion(); de la clase Conexion por medio de una instancia*/
   }
   catch(Exception $e)
   {
     die($e->getMessage()); /*Si la conexion no se establece se cortara el flujo enviando un mensaje con el error*/
   }
 }
 public function registrarProductos(PojoProductos $obj)
 {
  $clave=0;
  try 
  {
   $sql = "INSERT INTO productos(id_producto, id_proveedor, id_categoria, nombre, descripcion, estatus) values(?, ?, ?, ?, ?, ?)";

   $this->conectar();
   $this->conexion->prepare($sql)
   ->execute(
    array(
     $obj->id_producto,
     $obj->id_proveedor,
     $obj->id_categoria,
     $obj->nombre,
     $obj->descripción,
     $obj->estatus
   )
  );
   $clave=$this->conexion->lastInsertId();
   return $clave;
 } catch (Exception $e) 
 {
   return $clave;
 }finally{
    /*
    En caso de que se necesite manejar transacciones, no deberá desconectarse mientras la transacción deba persistir
    */
    Conexion::cerrarConexion();
  }
}
  public function eliminarProductos($id)
  {
   try 
    {
      $this->conectar();    
      $sentenciaSQL = $this->conexion->prepare("DELETE FROM productos WHERE id_producto = ?");                             
      $sentenciaSQL->execute([$id]);
      return true;
    } catch (Exception $e) 
    {
      return false;
    }finally{
      Conexion::cerrarConexion();
    }
  }

  public function getIdProductos($id)
  {
   //$idSucursal = 0;
   try
   {
      $this->conectar();
    
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_producto from productos WHERE nombre = ? AND estatus='1'"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoProductos();
        $obj->id_producto = $fila->id_producto;
      }
    return $obj->id_producto;
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    } finally {
      Conexion::cerrarConexion();
    }
  }
    
  public function getDatosProductos()
  {
    try{
      $this->conectar();
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_producto, id_proveedor, id_categoria, nombre, descripcion, estatus FROM productos "); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoProductos();
        $obj->id_producto = $fila->id_producto;
        $obj->id_proveedor = $fila->id_proveedor;
        $obj->id_categoria = $fila->id_categoria;
        $obj->nombre = $fila->nombre;
        $obj->descripcion = $fila->descripcion;
        $obj->estatus = $fila->estatus;
        $lista[] = $obj;
    }
    return $lista;
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    }finally {
      Conexion::cerrarConexion();
    }
  }
  public function editarPojoProductos(PojoProductos $obj)
  {
    $sql = "UPDATE productos SET 
    id_proveedor= ?,
    id_categoria= ?,
    descripcion= ?,
    nombre = ?,
    estatus= ?
    WHERE id_producto = ?";
    $this->conectar();
    $sentenciaSQL = $this->conexion->prepare($sql); 
    $sentenciaSQL->execute(
    array(
      $obj->id_proveedor,
      $obj->id_categoria,
      $obj->descripcion,
      $obj->nombre,
      $obj->estatus,
      $obj->id_producto
      ));
    return true;
    Conexion::cerrarConexion();
  }

  public function obtenerEstatus($id)
  {
    try
    {
      $this->conectar();
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT estatus FROM productos WHERE id_producto = ?"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoProductos();
        $obj->estatus = $fila->estatus;
        $lista[] = $obj;
      }
        return $lista;
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    }finally {
      Conexion::cerrarConexion();
    }
  }
}