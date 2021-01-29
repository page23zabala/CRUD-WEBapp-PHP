<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
	<title>Add Script</title>

</head>

<body>
	<?php 
		$dbhost = 'localhost';
		$dbname = 'countries';
		$dbuser = 'root';
		$dbpass = '';
		$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	?>

	<?php

		if( isset($_POST['Submit'])){
		$iso = mysqli_real_escape_string($conn, trim($_POST['iso']));
		$name = mysqli_real_escape_string($conn, trim($_POST['name']));
		$nicename = mysqli_real_escape_string($conn, trim($_POST['nicename']));
		$iso3 = mysqli_real_escape_string($conn, trim($_POST['iso3']));
		$numcode = mysqli_real_escape_string($conn, trim($_POST['numcode']));
		$phonecode = mysqli_real_escape_string($conn, trim($_POST['phonecode']));

		if( empty($iso) || empty($name) || empty($nicename) || empty($iso3) || empty($numcode) || empty($phonecode) ){

		if(empty($iso)){
			echo "<font color='red'> Iso field is empty. </font><br/>";
		}

		if(empty($name)){
			echo "<font color='red'> Name field is empty. </font><br/>";
		}

		if(empty($nicename)){
			echo "<font color='red'> Nicename field is empty. </font><br/>";
		}
		if(empty($iso3)){
			echo "<font color='red'> Iso3 field is empty. </font><br/>";
		}

		if(empty($numcode)){
			echo "<font color='red'> Numcode field is empty. </font><br/>";
		}

		if(empty($phonecode)){
			echo "<font color='red'> Phonecode field is empty. </font><br/>";
		}
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}
	 	
	 	else {

		$result = mysqli_query($conn, "INSERT INTO country(iso, name, nicename, iso3, numcode, phonecode) VALUES ('$iso', '$name', '$nicename', '$iso3', '$numcode', '$phonecode')");
		echo "<font color='green'> Data Added Successfully.";
		echo "<br/><a href='index.php'> View Result </a>";
		}
	}
	?>
</body>
</html>