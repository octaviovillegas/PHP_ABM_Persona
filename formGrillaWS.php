<?php
	require_once('clases/Personas.php');
?>
<html>
<head>
		<title>Ejemplos de ABM - con archivo de texto</title>

		<?php require_once"partes/referencias.php" ;?>
		<!--final de Estilos-->
		<script type="text/javascript" src="./bower_components/jquery/dist/jquery.js"></script>
        <script SRC="js/controlGrilla.js" TYPE="text/javascript"></script>
        <!--final logica de programación-->
</head>
<body onload="cargar()">
 	<?php		
		include_once"partes/barraDeMenu.php";
	 ?>


	<?php
		$mensaje = "Bienvenido .";
		/*if(isset($_POST['idParaBorrar']))
		{
			$resultado = Persona::BorrarPersona($_POST['idParaBorrar']);
			$mensaje = "SE HA BORRADO EXITOSAMENTE!!!";
		}*/
	?>	
	<form name="frmBorrar" method="POST" >
		<input type="hidden" name="idParaBorrar" id="idParaBorrar" />
	</form>
	
	<form name="frmModificar" method="POST" action="formAlta.php" >
		<input type="hidden" name="idParaModificar" id="idParaModificar" />
	</form>

	<div class="container">
		<div class="page-header">
			<center><h3><?php echo $mensaje; ?></h3><h1> Ejemplo de Grilla</h1> </center>     
		</div>
		<div class="CajaInicio animated bounceInRight">
			<h1>Listado de personas</h1>
			<!-- id="listaPersonas" -->
				
				<table class='table table-hover table-responsive' id="listaPersonas">
					<thead>
						<tr>
							<th>  Foto   </th>				
							<th>  Nombre     </th>
							<th>  Apellido   </th>
							<th>  Dni        </th>
							<th>  BORRAR     </th>
							<th>  MODIFICAR  </th>
						</tr> 
					</thead>
					<tr >
						
					</tr>
				</table>
			</div>
			<?php		
					// include_once"partes/grilla.php";
	 			?>
		</div>
	</div>
</body>
</html>