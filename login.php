<?php
  require_once 'db.php';
  $email = '';
  $password = '';
  $email_err = '';
  $password_err = '';


  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    if(empty($email)){
      $email_err = 'Please enter email';
    }

    if(empty($password)){
      $password_err = 'Please enter password';
    }


    if(empty($email_err) && empty($password_err)){
        $sql = 'SELECT name, email, password from users where email = :email';

        if($stmt = $pdo->prepare($sql)){
          $stmt->bindParam(':email', $email,PDO::PARAM_STR);

          if( $stmt->execute()){
            if($stmt->rowCount() == 1){
              if($row = $stmt->fetch()){
                $hashed_password = $row['password'];
                if(password_verify($password, $hashed_password)){
                  session_start();
                  $_SESSION['email'] = $email;
                  $_SESSION['name'] = $row['name'];
                  header('location: index.php');
                } else {
                  $password_err = 'The password you entered is not valid';
                }
              }
            } else {
              $email_err = 'No Account found for that email';
            }
          } else {
            die('Something went wrong');
          }
        }
        unset($stmt);
    } // 
    unset($pdo);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet" type="text/css" media="all">
  <title>Account Login</title>
</head>
<body>
      <div class="login-box">
      <h2>Login</h2>
      <p>Please fill in your credentials to login.</p>
      <form action="" method="post">
          <div class="user-box">
              <label>Email:</label>
              <input class="aaa" type="text" name="email" required="" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : '';?>" 
              value="<?php echo $email; ?>">
              <span class="invalid-feedback"><?php echo $email_err; ?></span>
          </div>    
          <div class="user-box">
              <label>Password:</label>
              <input class="aaa" type="password" name="password" required="" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : '';?>">
              <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          <div class="form-row">
            <div class="col">
              <input type="submit" class="aaa" value="Login">
            </div>
            <div class="col">
              <a href="register.php" class="aaa">No account? Register</a>
            </div>
        </div>
      </form>
        </div>
      </div>
    </div>
</div>    
</body>
</html>
