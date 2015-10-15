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
				// document.getElementById("FormIngreso").submit();
				var foto = $('img').attr('src');
				foto = foto.split('/');
				
				if ($('#idParaModificar').val() != 0)
					var tipo = 'PUT';
				else
					var tipo = 'POST';
				console.log(tipo);
				$.ajax({
			        type: tipo,
			        url: "http://localhost:8080/LaboIV/ws1/ws/personas/",// + $('#id').val(),
			        
			        data: { apellido: $('#apellido').val(),
			        		nombre: $('#nombre').val(),
			        		dni: $('#dni').val(),
			        		id: $('#id').val(),
			        		foto: foto[1]
			        		},
			        success: function(data, textStatus, jqXHR){
			            // console.log(data);
			            // document.getElementById("FormIngreso").submit();
			        },
			        error: function(jqXHR, textStatus, errorThrown){
			            console.log(errorThrown);
			            alert("No se pudo modificar " + errorThrown);
			        }
			    });
			}
		}
		function ValidarCadena(cad)
		{
			if(cad === "")
				return false;
			return true;
		}
