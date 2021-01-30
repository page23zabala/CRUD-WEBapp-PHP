<?php


require_once 'db.php';

$name = '' ;
$email = '';
$password = '';
$confirm_password = '';

if( $_SERVER['REQUEST_METHOD'] == 'POST'){

  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);

  if(empty($name)){
    $name_err = 'Please enter your name';
  }


  if(empty($email)){
    $email_err = 'Please enter email address'; 
  } else {
    $sql = 'SELECT id FROM users WHERE email = :email';

    if( $stmt = $pdo->prepare($sql)){
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);

      if($stmt->execute()){
        if($stmt->rowCount() === 1){
          $email_err = 'Email is already taken';
        }
      }else{
        die('Something went wrong');
      }
    }

    unset($stmt);
  }


  if(empty($password)){
    $password_err = 'Please enter a password';
  } elseif(strlen($password) < 6) {
    $password_err = 'Password must be at least 6 characters';
  }


  if(empty($confirm_password)){
    $confirm_password_err = 'Please confirm password';
  } else {
    if( $password !== $confirm_password){
      $confirm_password_err = 'Passwords do not match';
    }
  }

  //inputs are okay to be saved to the database
  if( empty($name_err) &&
      empty($email_err) &&
      empty($password_err) &&
      empty($confirm_password_err))
  {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

      if( $stmt = $pdo->prepare($sql)){
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        if( $stmt->execute()){
            header('location: login.php');
        } else {
          die('Something went wrong');
        }
      }

      unset($stmt);
  }
  unset($pdo);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <link href="style.css" rel="stylesheet" type="text/css" media="all">
  <title>Create An Account</title>
</head>
<body>

      <div class="login-box">
        <h2>Create An Account</h2>
        <p>Please fill this form to register with us</p>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="user-box">
                <label>Name:</label>
                <input class="aaa" type="text" name="name" required="" class="form-control form-control-lg <?php echo (!empty($name_err)) ? 'is-invalid' : '';?>" value="<?php echo $name;?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div> 
            <div class="user-box">
                <label>Email Address:</label>
                <input class="aaa" type="email" name="email" required="" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : '';?> " value="<?php echo $email;?> ">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="user-box">
                <label>Password:</label>
                <input class="aaa" type="password" name="password" required="" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : '';?>" value="<?php echo $password;?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="user-box">
                <label>Confirm Password:</label>
                <input class="aaa" type="password" name="confirm_password" required="" class="form-control form-control-lg <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : '';?>" value="<?php echo $confirm_password;?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-row">
              <div class="col">
                <input type="submit" class="aaa" value="Register">
              </div>
              <div class="col">
                <a href="login.php" class="btn btn-light btn-block">Have an account? Login</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>    
</body>
</html>
