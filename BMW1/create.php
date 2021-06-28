<?php
 include 'func/filemanager.php';
 include 'func/postmanager.php';
 include 'config.php';

if(isset($_POST['submit'])) {
  checkPost($_POST, $_FILES, $errors,$conn, 0);
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
	<link rel="stylesheet" type="text/css" href="css/Create.css"><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

	<title>Car World</title>
</head>
<body>
  <h5>Post Form</h5>
<div class="container">
  <div class="row">
<?php if ($_SESSION['loggedin'] == false): ?>
  <div class="container text-center" style="margin: 0px">
    <h2>Please Login first!!!</h2>
    <h4>Then you can create a post =)))</h4>
    <hr>
    <button type="post" name="submit" class="btn btn-lg btn-dark mt-3"><a href="login.php">Login</a> </button>
  </div>

<?php else:?>
        <form class="" action="create.php" method="post" enctype="multipart/form-data">
          <label for="title">Title</label>
          <input type="text" name="title" placeholder="Input your title..." class="form-control mb-3" value="">
          <label for="content">Content</label>
          <textarea name="content" class="form-control mb-3" placeholder="Input your content..." rows="8" cols="80"></textarea>
          <label for="img">Image Address</label>
          <input type="file" name="img" value="" class="mt-3 mb-3 form-control">
          <button type="submit" name="submit" style="margin-left: 33%;" class="btn btn-lg btn-dark mt-3"><i class="fas fa-pen mr-2"></i>Create</button>
        </form>
<?php endif; ?>
    </div>
  </div>
  </body>
</html>
