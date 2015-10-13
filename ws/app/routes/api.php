<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");
// var_dump($app);
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
		$res = $sentencia->fetchAll(PDO::FETCH_ASSOC);

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($res));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->post("/personas/", function() use($app)
{
	$cnn = Conexion::DameAcceso();
	$sentencia = $cnn->prepare('SELECT CONCAT(apellido, \', \', nombre) as piloto, fechaNacimiento as city FROM p_pilotos limit 25');
	
	$sentencia->execute();
	$res = $sentencia->fetchAll(PDO::FETCH_ASSOC);

	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode(json_encode($res)));
});

$app->post("/personas/:id", function($id) use($app)
{
	$cnn = Conexion::DameAcceso();
	$sentencia = $cnn->prepare('SELECT CONCAT(apellido, \', \', nombre) as piloto, nombre as city FROM p_pilotos WHERE id = ?');
	$sentencia->execute(array($id));
	$res = $sentencia->fetch(PDO::FETCH_ASSOC);

	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode(json_encode($res, JSON_NUMERIC_CHECK)));
});
$app->put("/personas/", function() use($app)
{
	// $title = $app->request->put("title");
	// $isbn = $app->request->put("isbn");
	// $author = $app->request->put("author");
	// $id = $app->request->put("id");

	// try{
	// 	$connection = getConnection();
	// 	$dbh = $connection->prepare("UPDATE books SET title = ?, isbn = ?, author = ?, created_at = NOW() WHERE id = ?");
	// 	$dbh->bindParam(1, $title);
	// 	$dbh->bindParam(2, $isbn);
	// 	$dbh->bindParam(3, $author);
	// 	$dbh->bindParam(4, $id);
	// 	$dbh->execute();
	// 	$connection = null;
	// 	$app->response->headers->set("Content-type", "application/json");
	// 	$app->response->status(200);
	// 	$app->response->body(json_encode(array("res" => 1)));
	// }
	// catch(PDOException $e)
	// {
	// 	echo "Error: " . $e->getMessage();
	// }
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode(array("res" => 1)));
});

$app->delete("/personas/:id", function($id) use($app)
{
	try{
		/*$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM books WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$connection = null;*/
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 111)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});