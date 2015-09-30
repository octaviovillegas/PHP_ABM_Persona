<?php
class Proveedor
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $numero;
 	private $nombre;
  	private $domicilio;
  	private $localidad;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetNumero()
	{
		return $this->numero;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetDomicilio()
	{
		return $this->domicilio;
	}
	public function GetLocalidad()
	{
		return $this->localidad;
	}

	public function SetNumero($valor)
	{
		$this->numero = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetDomicilio($valor)
	{
		$this->domicilio = $valor;
	}
	public function SetLocalidad($valor)
	{
		$this->localidad = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($numero=NULL)
	{
		if($numero != NULL){
			$obj = Proveedor::TraerUnProveedorPorNumero($numero);
			$this->numero = $obj->numero;
			$this->nombre = $obj->nombre;
			$this->domicilio = $obj->domicilio;
			$this->localidad = $obj->localidad;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->numero."  ".$this->nombre."  ".$this->domicilio."  ".$this->localidad;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnProveedorPorNumero($numero) 
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT numero, nombre, domicilio, localidad FROM proveedores WHERE numero = :numero ");
		$consulta->bindValue(':numero', $numero, PDO::PARAM_INT);
		$consulta->execute();
		$provBuscado= $consulta->fetchObject('Proveedor');
		return $provBuscado;				
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE INSTANCIA
	public function Insertar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO proveedores (numero, nombre, domicilio, localidad) values (:numero, :nombre, :domicilio, :localidad)");
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':domicilio', $this->domicilio, PDO::PARAM_STR);
		$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
		$consulta->bindValue(':numero',$this->numero, PDO::PARAM_INT);
		$consulta->execute();
		//return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}
	
	public function Modificar()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE proveedores SET nombre=:nombre, domicilio=:domicilio, localidad=:localidad WHERE numero=:numero");
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':domicilio', $this->domicilio, PDO::PARAM_STR);
		$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
		$consulta->bindValue(':numero',$this->numero, PDO::PARAM_INT);
		$consulta->execute();		
		//return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--MAS METODOS DE CLASE
	public static function TraerTodosLosProveedores()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta=$objetoAccesoDato->RetornarConsulta("SELECT numero, nombre, domicilio, localidad FROM proveedores");
		$consulta->execute();

		return $consulta->fetchall(PDO::FETCH_CLASS,"Proveedor");
	}

	public static function Borrar($numero)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM proveedores WHERE numero = :numero");	
		$consulta->bindValue(':numero', $numero, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--OTRAS FORMAS DE USAR PDO	
	public static function TraerUnProveedorPorNumeroArr($numero) 
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT numero, nombre, domicilio, localidad FROM proveedores WHERE numero = ?");
		$consulta->execute(array($numero));
		$provBuscado= $consulta->fetchObject('Proveedor');
		return $provBuscado;				
	}

	public static function TraerUnProveedorPorNumeroArrAsoc($numero) 
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT numero, nombre, domicilio, localidad FROM proveedores WHERE numero = :numero ");
		$consulta->execute(array(':numero' => $numero));
		$provBuscado= $consulta->fetchObject('Proveedor');
		return $provBuscado;				
	}
//--------------------------------------------------------------------------------//

}