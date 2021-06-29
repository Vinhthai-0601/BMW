<?php
include 'db.php';
include 'includes/header.php';

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

   a:hover{
     color : white !important;
     text-decoration: none;
   }

   .jumbotron.jumbotron-fluid.article {
    background: url(https://images.hgmsites.net/hug/mclaren-600lt-spider-segestria-borealis-by-mso_100747301_h.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}

 </style>
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="css/article.css">
      <div class="jumbotron jumbotron-fluid article">
        <div class="container">
          <button type="button" class="btn btn-dark mb-2"><a href='index.php'>< Back</a></button><br>
          <?php if (isset($row)): ?>
            <img src="<?php echo $img; ?> " style='max-width:100%'>
            <h5 class="display-3"><?php echo $title; ?></h5>
            <h3>Author:  <?php echo $author; ?></h3>
            <p>Content: <?php echo $body ?></p>
            <h6 class="font-weight-light"><em><?php echo date_format($date,"Y/m/d"); ?> </em></h6>
            <div class='row1'>
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
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row pdn-top-30">
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                     <div class="Follow">
                        <h3>CONTACT US</h3>
                     </div>
                     <ul class="location_icon">
                        <li> <a href="#"><img src="icon/facebook.png"></a></li>
                        <li> <a href="#"><img src="icon/Twitter.png"></a></li>
                        <li> <a href="#"><img src="icon/linkedin.png"></a></li>
                        <li> <a href="#"><img src="icon/instagram.png"></a></li>
                     </ul>
                  </div>
                  <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                     <div class="Follow">
                        <h3>CONTACT US WITH YOUR EMAIL</h3>
                     </div>
                     <input class="Newsletter" placeholder="Enter your email" type="Enter your email">
                     <button class="Subscribe">SENT</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <p>Car World's Page belong to Minh Nhật & Vinh Thái!<a href="#"></a></p>
            </div>
         </div>
      </footer>
