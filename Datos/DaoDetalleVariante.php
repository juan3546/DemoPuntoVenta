<?php
require_once 'Conexion.php'; /*importa Conexion.php*/
require_once '../Pojos/PojoDetalleVariante.php';


class DaoDetalleVariante
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
 public function registrarDetalleVariante(PojoDetalleVariante $obj)
 {
  $clave=0;
  try 
  {
   $sql = "INSERT INTO detalle_variante (id_detalle_variante, nombre, id_variante) values(?, ?, ?)";

   $this->conectar();
   $this->conexion->prepare($sql)
   ->execute(
    array(
     $obj->id_detalle_variante,
     $obj->nombre,
     $obj->id_variante
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
  public function eliminarDetalleVariante($id)
  {
   try 
    {
      $this->conectar();    
      $sentenciaSQL = $this->conexion->prepare("DELETE FROM detalle_variante WHERE id_detalle_variante = ?");                             
      $sentenciaSQL->execute([$id]);
      return true;
    } catch (Exception $e) 
    {
      return false;
    }finally{
      Conexion::cerrarConexion();
    }
  }

  public function getIdDetalleVariante($id)
  {
   //$idCategoria = 0;
   try
   {
      $this->conectar();
    
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_detalle_variante from detalle_variante WHERE nombre = ? AND id_variante='1'"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoDetalleVariante();
        $obj->id_detalle_variante = $fila->id_detalle_variante;
      }
    return $obj->id_detalle_variante;
    }catch(Exception $e){
      echo $e->getMessage();
      return null;
    } finally {
      Conexion::cerrarConexion();
    }
  }
    
  public function getDatosDetalleVariante()
  {
    try{
      $this->conectar();
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_detalle_variante, nombre, id_variante FROM detalle_variante"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoDetalleVariante();
        $obj->id_detalle_variante = $fila->id_detalle_variante;
        $obj->nombre = $fila->nombre;
        $obj->id_variante = $fila->id_variante;
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
  public function editarDetalleVariante(PojoDetalleVariante $obj)
  {
    $sql = "UPDATE detalle_variante SET 
    nombre= ?,
    id_variante= ?
    WHERE id_detalle_variante = ?";
    $this->conectar();
    $sentenciaSQL = $this->conexion->prepare($sql); 
    $sentenciaSQL->execute(
    array(
      $obj->nombre,
      $obj->id_variante,
      $obj->id_detalle_variante
      ));
    return true;
    Conexion::cerrarConexion();
  }

  public function obtenerid_variante($id)
  {
    try
    {
      $this->conectar();
      $lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/
      $sentenciaSQL = $this->conexion->prepare("SELECT id_variante FROM detalle_variante WHERE id_detalle_variante = ?"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
      $sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
      /*Se recorre el cursor para obtener los datos*/
      foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
      {
        $obj = new PojoDetalleVariante();
        $obj->id_variante = $fila->id_variante;
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