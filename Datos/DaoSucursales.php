<?php
require_once 'Conexion.php'; /*importa Conexion.php*/
require_once '../Pojos/PojoSucursales.php';


class DaoSucursales
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
 public function registrarSucursales(PojoSucursales $obj)
 {
  $clave=0;
  try 
  {
   $sql = "INSERT INTO sucursales(id_sucursal, id_nombre_precio, nombre, no_corte, estatus) values(?, ?, ?, ?, ?)";

   $this->conectar();
   $this->conexion->prepare($sql)
   ->execute(
    array(
     $obj->id_sucursal,
     $obj->id_nombre_precio,
     $obj->nombre,
     $obj->no_corte,
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
  public function eliminarSucursales($id)
  {
   try 
    {
      $this->conectar();    
      $sentenciaSQL = $this->conexion->prepare("DELETE FROM sucursales WHERE id_sucursal = ?");                             
      $sentenciaSQL->execute([$id]);
      return true;
    } catch (Exception $e) 
    {
      return false;
    }finally{
      Conexion::cerrarConexion();
    }
  }

  public function getIdSucursales($id)
  {
   //$idSucursal = 0;
   try
   {
      $this->conectar();
    
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_sucursal from sucursales WHERE nombre = ? AND estatus='1'"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoSucursales();
        $obj->id_sucursal = $fila->id_sucursal;
      }
    return $obj->id_sucursal;
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    } finally {
      Conexion::cerrarConexion();
    }
  }
    
  public function getDatosSucursales()
  {
    try{
      $this->conectar();
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_sucursal, id_nombre_precio, nombre, no_corte, estatus FROM sucursales "); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoSucursales();
        $obj->id_sucursal = $fila->id_sucursal;
        $obj->id_nombre_precio = $fila->id_nombre_precio;
        $obj->nombre = $fila->nombre;
        $obj->no_corte = $fila->no_corte;
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
  public function editarSucursales(PojoSucursales $obj)
  {
    $sql = "UPDATE sucursales SET 
    id_nombre_precio= ?,
    nombre= ?,
    no_corte= ?,
    estatus= ?
    WHERE id_sucursal = ?";
    $this->conectar();
    $sentenciaSQL = $this->conexion->prepare($sql); 
    $sentenciaSQL->execute(
    array(
      $obj->id_nombre_precio,
      $obj->nombre,
      $obj->no_corte,
      $obj->estatus,
      $obj->id_sucursal
      ));
    return true;
    Conexion::cerrarConexion();
  }

  public function obtenerEstatus()
  {
    try
    {
      $this->conectar();
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT estatus FROM sucursales "); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoSucursales();
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