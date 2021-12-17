<?php

	class ListaUsuarios{

	private $path;
	private $fichUsu;

	//array asociativo con la informacion de cada usuario
	private $listaUsu;

		function __construct($p,$f){
			//rellenar atributos con parametros
			$this->path = $p;
			$this->fichUsu = $f;

			if(file_exists($p.$f)){
					//Abre el fichero
					$fu = fopen($p.$f, "r");
					//Lee el contenido hasta el final del fichero	
					while(!feof($fu)){
						//Lee una linea del fichero
						$linea= fgets($fu);
						$linea = substr($linea,0,strlen($linea)-1 );
						//Si la linea está vacia no se hace nada
						if(strlen($linea)!=0){
							//Se divide la linea por el ";" y se genera un array indexado
							$datosUsu = explode(";", $linea);
							//Se añade el usuario al array asociativo
							//Se le añade con la clave "usu" y un array con los datos
							$this->listaUsu[$datosUsu[3]] = $datosUsu;
						}
					}

				fclose($fu);
				}
		}
		//Comprueba si existe ya el usuario comprobando si el nombre de usuario existe
		function noExisteUsuario($usu){
			return !(isset($this->listaUsu[$usu]));
		}

		function login($u,$p){
				//Se comprueba si el usuario está en el array asociativo
				//	que se ha creado desde el fichero	
				if(!isset($this->listaUsu[$u])){
					//El usuario existe
					//comprobamos la contraseña
					if($this->listaUsu[$u][4]==$p){
						return true;
					}else{
						return false;
					}
				}else{
					//El usuario no existe
					//Se devuelve false
					return false;	
				}

		}
	}

?>