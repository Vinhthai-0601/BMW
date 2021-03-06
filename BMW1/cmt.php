<?php
include 'func/postmanager.php';
include 'classes/Comment.php';
include 'classes/Reply.php';
include 'includes/header.php';


if(isset($_GET['id'])) {
  $post = getPost($_GET['id'], $conn);
  $theid = $_GET['id'];
  $comments = new Comment($theid, $conn);
  $comments->getComments();
  $replies = new Reply($theid, $conn);
  $replies->getReplies();
}

 ?>
 <link rel="stylesheet" href="css/comment.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Amaranth:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="9ymJyXDy"></script>
 <div class="container post">
   <div class="row">
     <?php if ($post == false): ?>
       <h2 class="display-4">404 Post Not Found!</h2>
      </div>
     <?php else: ?>
       <div class="col-md-8 offset-md-2">
          <img src="<?php echo $post['Image']; ?>" class="img-fluid" alt="">
          <!-- Like BEGIN -->
<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="button" data-action="like" data-size="large" data-share="true"></div>
          <h2 class="font-weight-light mt-4"><?php echo htmlspecialchars($post['Title']); ?></h2>
          <p><?php echo htmlspecialchars($post['Content']); ?></p>
          <h5><em><?php echo htmlspecialchars($post['Date_time']); ?>
          </em></h5>
       </div>
     </div> <!-- end of post row -->

     <!-- comment row -->
      <hr>
      <h3 class="display-4 mt-3 mb-3">Comments</h3>
      <hr>
      <?php if ($_SESSION['loggedin']): ?>
      <div class="row comment-form">
        <div class="col-md-8 form">
          <form class="comment-form" method="POST" action="func/ajaxManager.php">
            <textarea name="comment-text" class="form-control" rows="4" cols="80"></textarea>
            <input type="hidden" name="id" value="id=<?php echo htmlspecialchars($_GET['id']); ?>">
            <button type="submit" name="comment-submit" class="comment-submit btn btn-outline-success mt-2"><i class="far fa-comment"></i>Add Comment</button>
          </form>
        </div>
      </div>
     <div class="row comments">
           <?php $comments->outputComments($replies);?>
         <?php else: ?>
           <h3>Please login to comment!</h3>
           <a href="login.php"><button type="button" class="btn btn-primary btn-lg">Login</button></a>
         <?php endif; ?>
     </div>
   <?php endif; ?>

 </div>

 <hr>
 <?php
 $queryIDCount = count($_SESSION['query_history']) -2;
 $queryStrPos = strpos($_SESSION['query_history'][$queryIDCount],"id");
 $queryId = substr($_SESSION['query_history'][$queryIDCount],$queryStrPos);
 $queryId = explode("=", $queryId);
 include 'includes/footer.php';
  ?>
