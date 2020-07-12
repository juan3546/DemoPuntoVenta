<?php
require_once 'Conexion.php'; /*importa Conexion.php*/
require_once '../Pojos/PojoListaPrecio.php';


class DaoListaPrecio
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
 public function registrarListaPrecio(PojoListaPrecio $obj)
 {
  $clave=0;
  try 
  {
   $sql = "INSERT INTO nombre_precio (id_nombre_precio, nombre, estatus) values(?, ?, ?)";

   $this->conectar();
   $this->conexion->prepare($sql)
   ->execute(
    array(
     $obj->id_nombre_precio,
     $obj->nombre,
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
  public function eliminarListaPrecio($id)
  {
   try 
    {
      $this->conectar();    
      $sentenciaSQL = $this->conexion->prepare("DELETE FROM nombre_precio WHERE id_nombre_precio = ?");                             
      $sentenciaSQL->execute([$id]);
      return true;
    } catch (Exception $e) 
    {
      return false;
    }finally{
      Conexion::cerrarConexion();
    }
  }

  public function getIdListaPrecio($id)
  {
   //$idCategoria = 0;
   try
   {
      $this->conectar();
    
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_nombre_precio from nombre_precio WHERE nombre = ? AND estatus='1'"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoListaPrecio();
        $obj->id_nombre_precio = $fila->id_nombre_precio;
      }
    return $obj->id_nombre_precio;
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    } finally {
      Conexion::cerrarConexion();
    }
  }
    
  public function getDatosListaPrecio()
  {
    try{
      $this->conectar();
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_nombre_precio, nombre, estatus FROM nombre_precio"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoListaPrecio();
        $obj->id_nombre_precio = $fila->id_nombre_precio;
        $obj->nombre = $fila->nombre;
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
  public function editarListaPrecio(PojoListaPrecio $obj)
  {
    $sql = "UPDATE nombre_precio SET 
    nombre= ?,
    estatus= ?
    WHERE id_nombre_precio = ?";
    $this->conectar();
    $sentenciaSQL = $this->conexion->prepare($sql); 
    $sentenciaSQL->execute(
    array(
      $obj->nombre,
      $obj->estatus,
      $obj->id_nombre_precio
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
      $sentenciaSQL = $this->conexion->prepare("SELECT estatus FROM nombre_precio WHERE id_nombre_precio = ?"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoListaPrecio();
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