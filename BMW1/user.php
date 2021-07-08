<?php
include 'includes/header.php';
include 'func/postmanager.php';

$sql = "SELECT * FROM users";
$results = $conn->query($sql);
$rows = $results->fetch_all(MYSQLI_ASSOC);
?>
<link rel="stylesheet" href="css/user.css">
<div class="Library">
   <div class="container">
      <div class="row">
         <div class="col-md-10 offset-md-1">
            <div class="titlepage">
               <h2>Some <strong class="black">Information & About Us  </strong></h2>

            </div>
         </div>
      </div>
   </div>
 </div>
<hr>
<div class="container post">
  <div class="row1">
    <?php
    foreach ($rows as $row) {
     $users = getUser($row['id'], $conn);
     echo outputUser($users);
    }
     ?>
  </div>
</div>


<?php include 'includes/footer.php' ?>
