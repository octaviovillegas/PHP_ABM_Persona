<?php
	require_once('clases/Personas.php');
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

       <script type="text/javascript">
		function Borrar(dni)
		{
			document.getElementById('dniParaBorrar').value = dni;
			document.frmBorrar.submit();
		}
		function Modificar(dni)
		{
			document.getElementById('dniParaModificar').value = dni;
			document.frmModificar.submit();
		}
        </script>
</head>
<body>
 	<?php
		
		require_once"barraDeMenu.php";

	 ?>


<?php
	if(isset($_POST['dniParaBorrar']))
	{
		$resultado = Persona::Borrar($_POST['dniParaBorrar']);
	}
?>	
	<form name="frmBorrar" method="POST" action="baja.php">
		<input type="hidden" name="dniParaBorrar" id="dniParaBorrar" />
	</form>
	
	<form name="frmModificar" method="POST" action="alta.php" >
		<input type="hidden" name="dniParaModificar" id="dniParaModificar" />
	</form>

	<div class="container">
		<div class="page-header">
			<h1>Ejemplo de Grilla</h1>      
		</div>
		<div class="CajaInicio animated bounceInRight">
			<h1>Ejemplos ABM </h1>

<?php 

$ArrayDePersonas = Persona::TraerTodasLasPersonas();

echo "<table class='table'>
		<thead>
			<tr>
				<th>  Foto   </th>
				<th>  Apellido   </th>
				<th>  Nombre     </th>
				<th>  Dni        </th>
				<th>  BORRAR     </th>
				<th>  MODIFICAR  </th>
			</tr> 
		</thead>";   	

	foreach ($ArrayDePersonas as $p){

		echo " 	<tr>
					<td><img  class='fotoGrilla' src='fotos/".$p->GetFoto()."' /></td>
					<td>".$p->GetApellido()."</td>
					<td>".$p->GetNombre()."</td>
					<td>".$p->GetDni()."</td>
					<td><button class='btn btn-danger' name='Borrar' onclick='Borrar(".$p->GetDni().")'>   <span class='glyphicon glyphicon-remove-circle'>&nbsp;</span>Borrar</button></td>
					<td><button class='btn btn-warning' name='Modificar' onclick='Modificar(".$p->GetDni().")'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Modificar</button></td>
				</tr>";
	}	
echo "</table>";		
?>
		</div>
	</div>
</body>
</html>