<?php if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

function getConnection()
{
	try{
		$db_username = "root";
		$db_password = "";
		$connection = new PDO("mysql:host=localhost;dbname=restfulslim", $db_username, $db_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
	return $connection;
}