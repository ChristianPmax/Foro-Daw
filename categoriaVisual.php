<?php

				try{
				  //construir un objeto de la clase PDO para conectar a la base de datos	
				  $conn = new PDO("mysql:host=".$_SESSION["servidor"].";dbname=".$_SESSION["basededatos"], $_SESSION["usuario"], $_SESSION["pass"]);
				  
				  //fijar el atributo MODO de ERROR en el valor EXCEPTION
				  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				  //Pasos para hacer un SELECT de la base de datos
				  //preparamos la consulta
				  $stmt = $conn->prepare("SELECT * FROM categorias");
			  
			  	  //ejecutamos la consulta
			  	  $stmt->execute();


			  	  //modo de resultados en array asociativo
			  	  $stmt->setFetchMode(PDO::FETCH_ASSOC);

			  	  //los resultados
			  	  $salida = $stmt->fetchAll();
			  	  	
					foreach ($salida as $categoria) {


						echo '<tr onclick="location.href=\'temas.php?cate='.$categoria["id"].'\'"><td>'.$categoria["nombre"]." - <span>".$categoria["descripcion"]."</span></td></tr>";

						echo '</span></td></tr>';
			  	  }


				} catch(PDOException $e) {
				  error_log("Error en la conexion: " . $e->getMessage());
				}

				//deconectar de la BD
				$conn = null;


