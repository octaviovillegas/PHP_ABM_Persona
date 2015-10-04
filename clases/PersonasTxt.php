<?php
class Persona
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $nombre;
 	private $apellido;
  	private $dni;
  	private $foto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetApellido()
	{
		return $this->apellido;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetDni()
	{
		return $this->dni;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetApellido($valor)
	{
		$this->apellido = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetDni($valor)
	{
		$this->dni = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($dni=NULL)
	{
		if($dni != NULL){
			$obj = Persona::TraerUnaPersona($dni);
			
			$this->apellido = $obj->apellido;
			$this->nombre = $obj->nombre;
			$this->dni = $dni;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->apellido."-".$this->nombre."-".$this->dni."-".$this->foto;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaPersona($dni) 
	{
		$persona = new Persona();
		
		$a = fopen("./txt/personas.txt", "r");
		
		while(!feof($a)){
			$arr = explode("-", fgets($a));

			if(count($arr) > 1){
				if((int)$arr[2] == $dni){
					$persona->SetFoto($arr[3]);
					$persona->SetDni($arr[2]);
					$persona->SetNombre($arr[1]);
					$persona->SetApellido($arr[0]);
					break;
				}
			}
		}
		fclose($a);
		
		return $persona;				
	}
	
	public static function TraerTodasLasPersonas()
	{
		$arrPersonas = array();
		
		$a = fopen("./txt/personas.txt", "r");
		
		while(!feof($a)){
			$arr = explode("-", fgets($a));
			if(count($arr) > 1){
				$persona = new Persona();
				$persona->SetFoto($arr[3]);
				$persona->SetDni($arr[2]);
				$persona->SetNombre($arr[1]);
				$persona->SetApellido($arr[0]);
				
				array_push($arrPersonas, $persona);
			}
		}
		fclose($a);
		
		return $arrPersonas;
	}
	
	public static function Borrar($dni)
	{	
		$arrPersonas = array();
		
		$a = fopen("./txt/personas.txt", "r");
		
		while(!feof($a)){
		
			$arr = explode("-", fgets($a));

			if(count($arr) > 1){
				if((int)$arr[2] == $dni){
					continue;
				}
				$persona = new Persona();
				$persona->SetFoto($arr[3]);
				$persona->SetDni($arr[2]);
				$persona->SetNombre($arr[1]);
				$persona->SetApellido($arr[0]);
				
				array_push($arrPersonas, $persona);
			}
		}
		fclose($a);
		
		$a = fopen("./txt/personas.txt", "w");
		fclose($a);
		
		foreach($arrPersonas AS $p){
			$p->Insertar();
		}
		
	}
	
	public static function Modificar($p)
	{
		$arrPersonas = array();
		
		$a = fopen("./txt/personas.txt", "r");
		
		while(!feof($a)){
		
			$arr = explode("-", fgets($a));

			if(count($arr) > 1){
				if((int)$arr[2] == $p->GetDni()){
					$persona = $p;
				}
				else{
					$persona = new Persona();
					$persona->SetFoto($arr[3]);
					$persona->SetDni($arr[2]);
					$persona->SetNombre($arr[1]);
					$persona->SetApellido($arr[0]);
				}
				array_push($arrPersonas, $persona);
			}
		}
		fclose($a);
		
		$a = fopen("./txt/personas.txt", "w");
		fclose($a);
		
		foreach($arrPersonas AS $p){
			$p->Insertar();
		}		
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE INSTANCIA
	public function Insertar()
	{
		$a = fopen("./txt/personas.txt", "a");
		
		fwrite($a, $this->ToString() . "\r\n");
		
		fclose($a);
	}	
//--------------------------------------------------------------------------------//

}