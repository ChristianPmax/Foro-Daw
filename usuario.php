<?php

	class Usuario{

		private $nombre;
		private $apellidos;
		private $email;
		private $usu;
		private $pass;


		function __construct($n,$a,$e,$u,$p)
		{
			$this->nombre = $n;
			$this->apellidos = $a;
			$this->email = $e;
			$this->usu = $u;
			$this->pass = $p;
		}

		function inserta(){

			$cript = password_hash($this->pass, PASSWORD_DEFAULT);

			$sal = "INSERT INTO usuarios(nombre, apellido, user, pass, correo) VALUES('".$this->nombre."', '".$this->apellidos."','".$this->usu."','".$cript."','".$this->email."')";
			return $sal;
		}

		function getUsu(){
			return $this->usu;
		}

	}

?>