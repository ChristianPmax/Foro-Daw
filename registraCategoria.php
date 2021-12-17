<?php
	require "dentro.php";

	$categoria = json_decode($_POST['categoria']);

	//insertar en base de datos
	try {
	    //construir un objeto de la clase PDO para conectar a la base de datos		
	    $conn = new PDO("mysql:host=".$_SESSION["servidor"].";dbname=".$_SESSION["basededatos"], $_SESSION["usuario"], $_SESSION["pass"]);

 		//fijar el atributo MODO de ERROR en el valor EXCEPTION
  		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  		//Validacion de que el tema no existe
  		//SELECT * FROM categorias where nombre = "h"

  		$inf = $conn->prepare('SELECT count(*) as N FROM categorias where  nombre ="'.$categoria[0].'"');

  		//$conn->exec($inf);
  		$inf->execute();
	  	$inf->setFetchMode(PDO::FETCH_ASSOC);


	  	$comprueba = $inf->fetchAll();

  		$resp = $comprueba[0]["N"];

  		if ($resp == 0) {

			//-------------------

	  		$sql = "INSERT INTO categorias(nombre,descripcion,id_usuario) VALUES('".$categoria[0]."','".$categoria[1]."',".$_SESSION["id"].") ";

	  		$conn->exec($sql);


	  		//Recuperar el id de la categoria creada

	  		$stmt = $conn->prepare('SELECT id FROM categorias where nombre ="'.$categoria[0].'"');

	  		$stmt->execute();

	  		$stmt->setFetchMode(PDO::FETCH_ASSOC);

	  		$salida=$stmt->fetchAll();
	  		$salida[0]["id"];
	  		$conn = null;

			$resp=$salida[0]["id"];

			echo json_encode($resp);

  			
  		}else{

  			$resp=-1;

			echo json_encode($resp);
	  		$conn = null;
			

  		}



	} catch(PDOException $e) {

		error_log("Error en la insercion: " . $e->getMessage());

		$resp=-1;

		echo json_encode($resp);

		
	}
