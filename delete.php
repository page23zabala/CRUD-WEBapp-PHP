<?php

	$id = $_GET ['id'];

	include_once("config.php"); 
	$result = mysqli_query($mysqli, "DELETE  FROM country WHERE id=$id");

	header("Location: index.php");

?>