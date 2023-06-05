<?php 

	session_start();

	unset($_SESSION['requerimientos_usuario']);
	unset($_SESSION['requerimientos_admin']);
	header('location: ../../index.php');

?>