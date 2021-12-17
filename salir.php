<?php 
	require "dentro.php";

	session_unset();
	session_destroy();

	header("location: http://pruebabd.daw/foroDaw/");

