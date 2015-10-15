<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

$app->get("/books/", function() use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM books");
		$dbh->execute();
		$books = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($books));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->get("/books/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM books WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$book = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($book));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->post("/books/", function() use($app)
{
	$title = $app->request->post("title");
	$isbn = $app->request->post("isbn");
	$author = $app->request->post("author");

	try{
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO books VALUES(null, ?, ?, ?, NOW())");
		$dbh->bindParam(1, $title);
		$dbh->bindParam(2, $isbn);
		$dbh->bindParam(3, $author);
		$dbh->execute();
		$bookId = $connection->lastInsertId();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($bookId));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->put("/books/", function() use($app)
{
	$title = $app->request->put("title");
	$isbn = $app->request->put("isbn");
	$author = $app->request->put("author");
	$id = $app->request->put("id");

	try{
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE books SET title = ?, isbn = ?, author = ?, created_at = NOW() WHERE id = ?");
		$dbh->bindParam(1, $title);
		$dbh->bindParam(2, $isbn);
		$dbh->bindParam(3, $author);
		$dbh->bindParam(4, $id);
		$dbh->execute();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->delete("/books/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM books WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});