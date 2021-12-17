function login() {
	let usuario = {};

	usuario.usu = document.getElementById("usuL").value;
	usuario.pas = document.getElementById("contraL").value;

	if(usuario.usu != "" && usuario.pas != ""){
		loginAjax(usuario);
	}else{
		window.location.replace("errorLogin.html");
	}
}

function loginAjax(u) {
	const llamada = new XMLHttpRequest();

	//**********************************************
	//recibir la respuesta
	llamada.onload = function() {

		
    	let resp = JSON.parse(this.responseText);

    	if(resp){
    		window.location.replace("categorias.php");
    	}else{
    		window.location.replace("errorLogin.html");
    	}

    }
	//**********************************************

	//**********************************************

	//construir la consulta
	llamada.open("POST", "loginUsuariosAjax.php", true);
	llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//ejecutar la consulta
  	llamada.send("usuario="+JSON.stringify(u));
	//**********************************************	
}
