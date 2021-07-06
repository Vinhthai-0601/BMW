<<<<<<< Updated upstream
this is user
=======
<?php
include 'includes/header.php';
include 'func/postmanager.php';

$sql = "SELECT * FROM users";
$results = $conn->query($sql);
$rows = $results->fetch_all(MYSQLI_ASSOC);
?>

<div class="container post">
  <h2 class="display-4" style="margin-top: 100px;"><strong class="black">Your User Information! </strong></h2>
  <hr>
  <div class="row">
    <?php
    foreach ($rows as $row) {
     $users = getUser($row['id'], $conn);
     echo outputUser($users);
    }
     ?>
  </div>
</div>


<?php include 'includes/footer.php' ?>
>>>>>>> Stashed changes
