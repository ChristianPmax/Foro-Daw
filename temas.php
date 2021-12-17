<?php
	require "dentro.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript" src="js/temas.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="js/objeto.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body>

<div class="container">
	<!-- Cabecera -->
	<nav class=" navbar navbar-dark bg-dark">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#">
	    	<?php 
	    	echo $_SESSION['nombre']
			?>
		

	</a>
	    
	      
	     <button type="button" class="btn btn-outline-danger" >

		      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">

				  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
				  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>

			</svg>

			<a href="salir.php">Salir</a>

		</button> 

	    </div>
	  </div>
	</nav>


	<div class="row">
		
	</div>
</div>
	<div>
	</div>

<!--Formulario-->

	<div class="row">
		<div class="col-3">
		</div>

		<div class="col-6">
			<form>

				<input type="hidden" id="cate" value="<?php echo $_GET["cate"]?>">

				<div class="mb-3 mt-3">
					<label for="titulo" class="form-label" >Titulo</label>
					<input type="text" class="form-control" id="titulo" placeholder="Titulo">
				</div>
				<div class="mb-3 mt-3">
					<label for="texto" class="form-label">Texto</label>
					<textarea class="form-control" id="texto" placeholder="Texto"></textarea>
				</div>
				<button type="button" class="btn btn-primary" onclick="registraTema()">Enviar tema</button>
			</form>
		</div>

	</div>


	<!-- listado de temas -->
<hr>
	<div class="row">
		
		<div class="col-3">
			
		</div>
		<div class="col-6">	
<?php
	

	try{
	  //construir un objeto de la clase PDO para conectar a la base de datos	
	  $conn = new PDO("mysql:host=".$_SESSION["servidor"].";dbname=".$_SESSION["basededatos"], $_SESSION["usuario"], $_SESSION["pass"]);
	  
	  //fijar el atributo MODO de ERROR en el valor EXCEPTION
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	  //Pasos para hacer un SELECT de la base de datos
	  //preparamos la consulta
	
	  $stmt = $conn->prepare("SELECT * FROM temas WHERE id_categoria=".$_GET['cate']);
  
  	  //ejecutamos la consulta
  	  $stmt->execute();


  	  //modo de resultados en array asociativo
  	  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  	  //los resultados
  	  $salida = $stmt->fetchAll();




  	  	

		//cards

  	  	

		foreach ($salida as $tema) {


		echo '<div class=" mt-3 card text-white bg-dark mb-3 border-info  mb-3">';

			echo '<div class="card-header">';

			echo $tema["titulo"];

			echo '</div>';

			echo '<div class="card-body">';

			echo $tema["texto"];

			echo '</div>';

			if ($tema["id_usuario"]==$_SESSION['id']) {

				echo '<a href = "borraTema.php?id='.$tema["id"].'" class="btn btn-primary">Borrar</a>';

			}

		echo '</div>';


  	  }



	} catch(PDOException $e) {
	  error_log("Error en la conexion: " . $e->getMessage());
	}

	//deconectar de la BD
	$conn = null;

?>	

	</div>
	</div>

</body>
</html>
