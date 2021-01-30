<?php

  //initialize session
  session_start();

  if( !isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: login.php');
    exit;
  }
?>

<?php
	include_once("config.php");

	$result = mysqli_query($mysqli, "SELECT * FROM country");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Homepage</title>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
	<header>
  <div class="title">
    <h1><?php echo "CRUD WEB APP"; ?></h1>
	<h5><a href="logout.php" class="aaa">Logout</a></h5>
  </div>
</header>
	<a href="add.html">Add Country</a>

	<table class="table table-dark table-striped" style="color: #ff1493" >
		<tr background="bg.jpg">
			<td>Iso</td>
			<td>Country</td>
			<td>Nicename</td>
			<td>iso3</td>
			<td>Num Code </td>
			<td>Phone Code </td>
			<td>Created</td>
			<td>Action</td>
		</tr>

		<?php 

			while ($res = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>".$res['iso']."</td>";
				echo "<td>".$res['name']."</td>";
				echo "<td>".$res['nicename']."</td>";
				echo "<td>".$res['iso3']."</td>";
				echo "<td>".$res['numcode']."</td>";
				echo "<td>".$res['phonecode']."</td>";
				echo "<td>".$res['created_at']."</td>";
				echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onclick=\"return confirm('Do you want to delete this Country?')\">Delete</a></td>";
				echo "</tr>";
			}
		?>
		

	</table>
	
</body>
</html>