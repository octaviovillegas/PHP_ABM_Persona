	function Validar()
		{
			var ape = document.getElementById('apellido').value;
			var nom = document.getElementById('nombre').value;
			var dni = document.getElementById('dni').value;
			var envio = true;
			
			if(!ValidarCadena(ape)){
				document.getElementById('lblApellido').style.display = "block";
				envio = false;
			}
			else{
				document.getElementById('lblApellido').style.display = "none";
			}
			
			if(!ValidarCadena(nom)){
				document.getElementById('lblNombre').style.display = "block";
				envio = false;
			}
			else{
				document.getElementById('lblNombre').style.display = "none";
			}

			if(!ValidarCadena(dni)){
				document.getElementById('lblDni').style.display = "block";
				envio = false;
			}
			else{
				document.getElementById('lblDni').style.display = "none";
			}

			if(envio){
				document.getElementById("hdnAgregar").value="Guardar";
				document.getElementById("FormIngreso").submit();
			}
		}
		function ValidarCadena(cad)
		{
			if(cad === "")
				return false;
			return true;
		}