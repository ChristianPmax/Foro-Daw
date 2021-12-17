<?php

	require'usuario.php';


	$per = json_decode($_POST['usuario']);



	if($per->usu != "" && $per->contra != "" && $per->mail != ""){

		registrarUsuario($per);
	
	}else{


		$resp = false;
		echo json_encode($resp);
	
	}




	function registrarUsuario($per){

		//Se crea el objeto "reg" que contiene los datos del usuario
 		$reg = new Usuario($per->nom, $per->ape, $per->mail, $per->usu, $per->contra);

		//Leer fichero configuracion

 		$dirConf = "conf/";
 		$fichConf="conf.dat";

 		$fc = fopen($dirConf.$fichConf,"r");

 		$conexBD = [];

 		while (!feof($fc)) { 
 			
 			$linea = fgets($fc);
 			$datosLinea = explode("=", $linea);

 			//Crear el array asociativo
 			$conexBD[$datosLinea[0]]=trim($datosLinea[1]);
 		}

 		fclose($fc);


		
		
		//error_log($conexBD["servidor"]."-".$conexBD["usuario"]."-".$conexBD["pass"]."-".$conexBD["basededatos"]."-");

		//Insertar en base de datos
 		try {

 		//Conexion
		$conn = new PDO('mysql:host='.$conexBD["servidor"].';dbname='.$conexBD["basededatos"], $conexBD["usuario"], $conexBD["pass"]);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		//Construir petición
		$sql = $reg ->inserta();

		//Ejecutar petición
		$conn->exec($sql);


		//Cerrar BD
		$conn = null;	


		$resp = true;
		echo json_encode($resp);


		//Sacar error por no poder conectarse
		}catch(PDOException $e){

			error_log("Error en la inserción: " . $e->getMessage());

			$resp = false;
			echo json_encode($resp);

		
		}
	}
