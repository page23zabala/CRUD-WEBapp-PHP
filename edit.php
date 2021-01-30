<?php
	include_once("config.php"); 

	if( isset($_POST['Update']))
	{
		$id = mysqli_real_escape_string($mysqli, $_POST['id']);
		$iso = mysqli_real_escape_string($mysqli, ($_POST['iso']));
		$name = mysqli_real_escape_string($mysqli, ($_POST['name']));
		$nicename = mysqli_real_escape_string($mysqli, ($_POST['nicename']));
		$iso3 = mysqli_real_escape_string($mysqli, ($_POST['iso3']));
		$numcode = mysqli_real_escape_string($mysqli, ($_POST['numcode']));
		$phonecode = mysqli_real_escape_string($mysqli, ($_POST['phonecode']));

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

		$result = mysqli_query($mysqli, "UPDATE country SET iso='$iso',name='$name',nicename='$nicename',iso3='$iso3',numcode='$numcode',phonecode='$phonecode' WHERE id=$id");
		header("Location: index.php");
		}
	}
?>


<?php
	$id = $_GET['id'];

	$result = mysqli_query($mysqli, "SELECT * FROM country WHERE id=$id");

	while($res = mysqli_fetch_array($result))
		{
			$iso = $res['iso'];
			$name = $res['name'];
			$nicename = $res['nicename'];
			$iso3 = $res['iso3'];
			$numcode = $res['numcode'];
			$phonecode = $res['phonecode'];
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Data</title>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>

	<div class="login-box">
  		<h2>Edit Country</h2>
  		<form name="form1" method="post" action="edit.php">
    <div class="user-box">
      	<input type="text" name="iso" required="" value="<?php echo $iso;?>">
      	<label>ISO</label>
    </div>
    <div class="user-box">
     	<input type="text" name="name" required="" value="<?php echo $name;?>">
      	<label>NAME</label>
    </div>
    <div class="user-box">
      	<input type="text" name="nicename" required="" value="<?php echo $nicename;?>">
      	<label>NICENAME</label>
    </div>
    <div class="user-box">
     	<input type="text" name="iso3" required="" value="<?php echo $iso3;?>">
      	<label>ISO3</label>
    </div>
    <div class="user-box">
      	<input type="text" name="numcode" required="" value="<?php echo $numcode;?>">
      	<label>NumCode</label>
    </div>
    <div class="user-box">
     	<input type="text" name="phonecode" required="" value="<?php echo $phonecode;?>">
      	<label>PhoneCode</label>
    </div>
    <div class="user-box">
     	<input type="hidden" name="id"  value="<?php echo $_GET['id'];?>">
    </div>

      <input class="aaa" type="submit" name="Update" value="UPDATE"/>

</body>
</html>