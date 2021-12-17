
function registrar() {
	
	let persona = {};

	persona.nom = document.getElementById("nom").value;
	persona.ape = document.getElementById("ape").value;
	persona.mail = document.getElementById("mail").value;
	persona.usu = document.getElementById("usuR").value;
	persona.contra = document.getElementById("contraR").value;

	if (!(persona.contra == "" && persona.usu == "" && persona.mail == "")) {

		regUsu(persona);

	}else{

		window.location.replace("error.html");
		

	}
}
	
function regUsu(p) {

	const llamada = new XMLHttpRequest();

	//Recibir la respuesta
	llamada.onload = function() {


    	let resp = JSON.parse(this.responseText);

    	if (resp) {

    		
			document.getElementById("salida").innerHTML="Usuario registrado";


    	}else{

			window.location.replace("error.html");

    	}

    }


	//***********************************************
	

	//***********************************************



	//Construir la consulta
	  llamada.open("POST", "registroUsuario.php", true);

	  llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Ejecutar la consulta
  	  llamada.send("usuario=" + JSON.stringify(p));
	

	
}
	

	
