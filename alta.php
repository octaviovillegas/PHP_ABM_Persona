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
		
		<script type="text/javascript" src="js/ValidacionjavaScript.js">
	
        </script>
</head>
<body>
	<a class="btn btn-info" href="index.html">Menu principal</a>
	<a class="btn btn-info" href="grilla.php">Grilla</a>
<?php     
	require_once("clases\Personas.php");

	$titulo = "ALTA";
	if(isset($_POST['dniParaModificar'])) //viene de la grilla
	{
		$unaPersona = Persona::TraerUnaPersona($_POST['dniParaModificar']);
		$titulo = "MODIFICACIÓN";
	} 
?>
	<div class="container">
		<div class="page-header">
			<h1>Ejemplos de PHP</h1>      
		</div>
		<div class="CajaInicio animated bounceInRight">
			<h1>Ejemplo de <?php echo $titulo; ?></h1>

			<form id="FormIngreso" method="post" action="alta.php">
				<input type="text" name="apellido" id="apellido" placeholder="ingrese apellido" value="<?php echo isset($unaPersona) ?  $unaPersona->GetApellido() : "" ; ?>" /><span id="lblApellido" style="display:none;color:#FF0000;width:1%;float:right;font-size:80">*</span>
				<input type="text" name="nombre" id="nombre" placeholder="ingrese nombre" value="<?php echo isset($unaPersona) ?  $unaPersona->GetNombre() : "" ; ?>" /> <span id="lblNombre" style="display:none;color:#FF0000;width:1%;float:right;font-size:80">*</span>
				<input type="text" name="dni" id="dni" placeholder="ingrese dni" value="<?php echo isset($unaPersona) ?  $unaPersona->GetDni() : "" ; ?>" /> <span id="lblDni" style="display:none;color:#FF0000;width:1%;float:right;font-size:80">*</span>

				<input type="hidden" name="dniModif" value="<?php echo isset($unaPersona) ? $unaPersona->GetDni() : "" ; ?>" />

				<input type="button" class="btn btn-danger" name="guardar" value="Guardar" onclick="Validar()" />
				<input type="hidden" value="" id="hdnAgregar" name="agregar" />
				</div>

			</form>
		
<?php 

if(isset($_POST['agregar']) && $_POST['agregar'] === "Guardar")// si esto no se cumple ingreso por primera vez.
{

	if($_POST['dniModif'] != "")//paso por grilla y luego guardo
	{
		$unaPersona = Persona::TraerUnaPersona($_POST['dni']);
		$unaPersona->SetApellido($_POST['apellido']);
		$unaPersona->SetNombre($_POST['nombre']);
		$unaPersona->SetDni($_POST['dni']);
		
		$retorno = Persona::Modificar($unaPersona);
	}
	else// si es un alta
	{
		$p = new Persona();	
		$p->SetApellido($_POST['apellido']);
		$p->SetNombre($_POST['nombre']);
		$p->SetDni($_POST['dni']);

		$p->Insertar();
	}	
}
?>
		</div>
	</div>
</body>
</html>