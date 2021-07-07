<?php

include 'config.php';

error_reporting(0);

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows == 1) {
		$row = mysqli_fetch_assoc($result);
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $row['username'];
    $_SESSION['user_id'] = $row['id'];
		$_SESSION['user_role'] = $row['role'];
		$_SESSION['user_img'] = $row['user_img'];
    $location = "Location:  index.php?id=" . $stmt->insert_id . "&new=true";
    header($location);
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/yourcode.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/jquery-3.4.1.slim.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style1.css">

	<title>Car World</title>
</head>
<body>
  <h1> Minh Nhat & Vinh Thai </h1>


  <h2> This is Car World.</h2>


	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>"required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
    <ul class="social_footer_ul">
  <li><a href="https://www.facebook.com/minhnhatlonelyboy/"><i class="fab fa-facebook-f"></i></a></li>
  <li><a href="https://www.facebook.com/minhnhatlonelyboy/"><i class="fab fa-twitter"></i></a></li>
  <li><a href="https://www.facebook.com/minhnhatlonelyboy/"><i class="fab fa-youtube"></i></a></li>
  <li><a href="https://www.facebook.com/minhnhatlonelyboy/"><i class="fab fa-instagram"></i></a></li>
  </ul>
	</div>

</body>

</html>
