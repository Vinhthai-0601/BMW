<?php
include 'db.php';
include 'includes/header.php';
var_dump($_GET);
$num_rows = 0;
if(isset($_GET['id'])) {
  $sql = "SELECT posts.Date_time, posts.Title, posts.Content, posts.Author, posts.Post_ID, posts.Image
  FROM posts JOIN users ON users.id = posts.Post_ID WHERE posts.ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $results = $stmt->get_result();
  if($results->num_rows == 1) {
    $row = $results->fetch_assoc();
    $title = $row['Title'];
    $date = date_create($row['Date_time']);
    $body = $row['Content'];
    $author = $row['Author'];
    $author_id = $row['Post_ID'];
    $img = $row['Image'];
  }
} else {
  $errorMsg = "Post not found!";
}
 ?>

 <style media="screen">
   a{
     color : black;
   }

   a:hover{
     color : white !important;
     text-decoration: none;
   }

   .jumbotron.jumbotron-fluid.article {
    background: url(https://i.pinimg.com/564x/17/7e/0f/177e0f772f771e2a08607b88ffef57b7.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}

 </style>
      <div class="jumbotron jumbotron-fluid article">
        <div class="container">
          <button type="button" class="btn btn-dark mb-2"><a href='index.php'>< Back</a></button><br>
          <?php if (isset($row)): ?>
            <img src="<?php echo $img; ?> " style='max-width:100%'>
            <h1 class="display-3"><?php echo $title; ?></h1>
            <h3>Author:  <?php echo $author; ?></h3>
            <p>Content: <?php echo $body ?></p>
            <h5 class="font-weight-light"><em><?php echo date_format($date,"Y/m/d"); ?> </em></h5>
            <div class='row'>
              <div class='col-md-4 mb-2'>
                <button type='button' name='' class='btn btn-lg btn-outline-dark mt-3'><i class='far fa-edit mr-2'></i> <a href='edit.php?id=<?php echo $_GET['id']?>'>Edit Post</a> </button>
              </div>
              <div class='col-md-4 mb-2'>
                <button type='button' name='' class='btn btn-lg btn-outline-success mt-3'><i class='far fa-comments mr-2'></i> <a href='cmt.php?id=<?php echo $_GET['id']?>'>Comment</a> </button>
              </div>
              <div class='col-md-4 mb-2'>
                <button type='button' name='' class='btn btn-lg btn-outline-danger mt-3'><i class='far fa-trash-alt mr-2'></i> <a href='delete.php?id=<?php echo $_GET['id']?>'>Delete</a></button>
              </div>
            </div>
          <?php else: ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="container recent-articles">
        <div class="row">
          <?php
            if($num_rows != 0) {
              echo $body;
            }
           ?>
        </div>
      </div>
<?php include 'includes/footer.php'; ?>
