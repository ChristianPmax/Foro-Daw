<?php 	
	require 'ListaUsuarios.php';
	if(isset($_GET['usuario'],$_GET['passwd'])){

		//Datos del fichero con los usuarios
		$path = "datos/";
		$fichUsu = "usuario.dat";

		//Para ganar tiempo 
		$usu = $_GET['usuario'];
		$pas = $_GET['passwd'];

		//Lista con todos los usuarios (Array asociativo)
		$listaUsu = new ListaUsuarios($path,$fichUsu);

		if($listaUsu->login($usu,$pas)){
			echo "Bienvenido";
		}else{
			echo "Ya estás dentro";
		}

	}else{
		echo "Error en el Login. Faltan datos";
	}	
		

	



