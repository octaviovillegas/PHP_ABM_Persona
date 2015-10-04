<?php
	require_once('clases/Personas.php');

	$mensaje ="";
	if(isset($_POST['dniParaBorrar']))//paso por grilla y luego guardo
	{
		$unaPersona = Persona::Borrar($_POST['dniParaBorrar']);
		$mensaje = "SE HA BORRADO EXITOSAMENTE!!!";
	}
?>
<html>
<head>
		<title>Ejemplos de ABM - con archivo de texto</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="http://www.octavio.com.ar/favicon.ico">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" type="text/css" href="css/animacion.css">
		<!--final de Estilos-->

</head>
<body>


		<?php
		
		require_once"barraDeMenu.php";

	 ?>
	  <div class="container">
	  	  <div class="page-header">
                <h1>ABM</h1>      
            </div>
			<h2><?php echo $mensaje; ?></h2>
					<div class="CajaInicio animated bounceInRight">
							<h1>PERSONAS - BAJA</h1>
						
							<form id="FormIngreso">
 										
									    <a href="index.html" class="list-group-item  list-group-item list-group-item-info">
									      <h4 class="list-group-item-heading">Men&uacute; Principal</h4>
									    </a>
										
										<a href="grilla.php" class="list-group-item  list-group-item list-group-item-info">
									      <h4 class="list-group-item-heading">Grilla de Personas</h4>
									    </a>
									
									  </div>									
							</form>
						</div>
		</div>
</body>
</html>