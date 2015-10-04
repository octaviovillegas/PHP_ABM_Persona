
     
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
   