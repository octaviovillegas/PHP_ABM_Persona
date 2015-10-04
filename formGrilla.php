<?php
	require_once('clases/Personas.php');
?>
<html>
<head>
		<title>Ejemplos de ABM - con archivo de texto</title>

		<?php require_once"referencias.php" ;?>
		<!--final de Estilos-->

        <script SRC="js/controlGrilla.js" TYPE="text/javascript"></script>
        <!--final logica de programación-->
</head>
<body>
 	<?php		
		include_once"barraDeMenu.php";
	 ?>


	<?php
		$mensaje = "Bienvenido .";
		if(isset($_POST['dniParaBorrar']))
		{
			$resultado = Persona::Borrar($_POST['dniParaBorrar']);
			$mensaje = "SE HA BORRADO EXITOSAMENTE!!!";
		}
	?>	
	<form name="frmBorrar" method="POST" >
		<input type="hidden" name="dniParaBorrar" id="dniParaBorrar" />
	</form>
	
	<form name="frmModificar" method="POST" action="formAlta.php" >
		<input type="hidden" name="dniParaModificar" id="dniParaModificar" />
	</form>

	<div class="container">
		<div class="page-header">
			<center><h1><?php echo $mensaje; ?> Ejemplo de Grilla</h1> </center>     
		</div>
		<div class="CajaInicio animated bounceInRight">
			<h1>Listado de personas</h1>
			<?php		
					include_once"grilla.php";
	 			?>
		</div>
	</div>
</body>
</html>