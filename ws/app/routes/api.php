<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");
// var_dump($app);

// GET: Para consultar y leer recursos
// POST: Para crear recursos
// PUT: Para editar recursos
// DELETE: Para eliminar recursos

// GET: Para consultar y leer recursos

$app->get("/personas/", function() use($app)
{
	$cnn = Conexion::DameAcceso();
	$sentencia = $cnn->prepare('call TraerTodasLasPersonas()');
	
	$sentencia->execute();
	$res = $sentencia->fetchAll(PDO::FETCH_ASSOC);
		
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($res));
});

$app->get("/personas/:id", function($id) use($app)
{
	try{
		$cnn = Conexion::DameAcceso();
		$sentencia = $cnn->prepare('call TraerUnaPersona(?)');
		
		$sentencia->execute(array($id));
		$res = $sentencia->fetchAll(PDO::FETCH_OBJ);

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($res));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

// POST: Para crear recursos
$app->post("/personas/", function() use($app)
{
	$nombre = $app->request->post("nombre");
	$dni = $app->request->post("dni");
	$apellido = $app->request->post("apellido");
	$foto = ($app->request->post("foto") != "")? $app->request->post("foto") : "pordefecto.png"; 
	// $foto = "pordefecto.png";
	$cnn = Conexion::DameAcceso();
	$sentencia = $cnn->prepare('CALL InsertarPersona (?,?,?,?)');
	
	
	$status = 200;
	if ($sentencia->execute(array($nombre, $apellido, $dni, $foto)))
		$res = array("rta" => true);	
	else{
		$res = array("rta" => false);
		$status = 500;
	}
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status($status);
	$app->response->body(json_encode(json_encode($res)));
});

$app->post("/personas/foto/", function() use($app)
{
	if(!isset($_FILES["foto"]))
	{
		// no se cargo una imagen
	}
	else
	{
		if($_FILES["foto"]['error'])
		{
			//error de imagen
		}
		else
		{
			$tamanio =$_FILES['foto']['size'];
    		if($tamanio>1024000)
    		{
    				// "Error: archivo muy grande!"."<br>";
    		}
    		else
    		{
    			//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
				//IMAGEN, RETORNA FALSE
				$esImagen = getimagesize($_FILES["foto"]["tmp_name"]);
				if($esImagen === FALSE) 
				{
							//NO ES UNA IMAGEN
					$res = "No es una imagen";
				}
				else
				{
					$NombreCompleto=explode(".", $_FILES['foto']['name']);
					$Extension=  end($NombreCompleto);
					$arrayDeExtValida = array("jpg", "jpeg", "gif", "bmp","png");  //defino antes las extensiones que seran validas
					if(!in_array($Extension, $arrayDeExtValida))
					{
					   //"Error archivo de extension invalida";
						$res = "Error, extension invalida";
					}
					else
					{
						//$destino =  "fotos/".$_FILES["foto"]["name"];
						$destino = "../fotos/". $_FILES['foto']['name'];//.".".$Extension;
						$foto=$_POST['dni'].".".$Extension;
						//MUEVO EL ARCHIVO DEL TEMPORAL AL DESTINO FINAL
    					if (move_uploaded_file($_FILES["foto"]["tmp_name"],$destino))
    					{		
      						 $res = $_FILES['foto']['name'];
      					}
      					else
      					{   
      						// algun error;
      						$res = "Error!";
      					}
					}
				}
    		}			
		}
	}	
	$status = 200;
	
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status($status);
	$app->response->body(json_encode($res));
});
// PUT: Para editar recursos
$app->put("/personas/", function() use($app)
{
	$nombre = $app->request->put("nombre");
	$id = $app->request->put("id");
	$apellido = $app->request->put("apellido");
	$foto = $app->request->put("foto");

	$cnn = Conexion::DameAcceso();
	$sentencia = $cnn->prepare('CALL ModificarPersona(?,?,?,?)');
	$status = 200;
	if ($sentencia->execute(array($id, $nombre, $apellido, $foto)))
		$res = array("rta" => true);	
	else{
		$res = array("rta" => false);
		$status = 500;
	}
		
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status($status);
	$app->response->body(json_encode($res));
});
// DELETE: Para eliminar recursos
$app->delete("/personas/:id", function($id) use($app)
{
	try{
		$cnn = Conexion::DameAcceso();
		$sentencia = $cnn->prepare('CALL BorrarPersona(?)');
		
		$sentencia->execute(array($id));

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 111)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});