<?php
include 'includes/header.php';
include 'func/filemanager.php';
include 'func/postmanager.php';
include 'classes/post.php';

$sql = "SELECT * FROM posts";
$results = $conn->query($sql);
$rows = $results->fetch_all(MYSQLI_ASSOC);
 ?>      <!-- end header -->
<link rel="stylesheet" href="css/index.css">
      <section class="slider_section">
         <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide" src="images/BMWWP.jpg" alt="First slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>The iX<br>New Generation Electric</h1>

                        <div class="button_section"> <a class="main_bt1" href="https://www.bmwusa.com/future-vehicles/ix.html">See More</a>  </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide" src="images/BMW3.jpg" alt="Second slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>The M5 CS<br> DISCOVER THE FASTEST<br>STREET-LEGAL BMW EVER</h1>
                        <div class="button_section"> <a class="main_bt1" href="https://www.bmwusa.com/future-vehicles/m5-cs-sedan.html">See More</a>  </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="third-slide" src="images/BMW4.jpg" alt="Third slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>SHOP FROM ANYWHERE<br> </h1>
                        <p>With BMW's online shopping tools, buying your dream car is as easy as browsing </p>
                        <div class="button_section"> <a class="main_bt1" href="https://www.bmwusa.com/buy-online.html">See More</a>  </div>
                        <div class="button_section"> <a class="main_bt1" href="https://www.bmwusa.com/inventory.html#!/results/">Car Forum</a>  </div>

                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </section>

      <div class="container post">
        <h2 class="display-4">Posts<strong class="black">Your Favorite Car! </strong></h2>
        <hr>
        <div class="row1">
          <?php
          $posts = getPosts(12, $conn);
           echo outputPosts($posts);
           ?>
        </div>
      </div>


        <!-- // <div class='row'>
        //   <div class='col-md-4 mb-2'>
        //     <button type='button' name='' class='btn btn-lg btn-outline-dark mt-3'><i class='far fa-edit mr-2'></i> <a href='edit.php?id={$post['ID']}'>Edit Post</a> </button>
        //     </div>
        //     <div class='col-md-4 mb-2'>
        //     <button type='button' name='' class='btn btn-lg btn-outline-success mt-3'><i class='far fa-comments mr-2'></i> <a href='cmt.php?id={$post['ID']}'>Comment</a> </button>
        //     </div>
        //     <div class='col-md-4 mb-2'>
        //     <button type='button' name='' class='btn btn-lg btn-outline-danger mt-3'><i class='far fa-trash-alt mr-2'></i> <a href='delete.php?id={$post['ID']}'>Delete</a> </button>
        //     </div>
        // </div> -->

        <!-- <div class="front-2">
          <div class="column-2">
            <img src="images/car3.jpg" alt="">
            <div class="text-block10">
            <h10> The 2021 BMW X7</h10>
            <p10> EXPERIENCE A LEGEND </p10>
            <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/vehicles/x-models/x7/sports-activity-vehicle/overview.html">See More</a>  </div>
            </div>
          </div>
          <div class="column-2">
            <img src="images/car2.png" alt="">
            <div class="text-block10">
            <h10> The 2021 BMW X5</h10>
            <p10> LEAD WITH CONFIDENCE </p10>
            <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/vehicles/x-models/x5/sports-activity-vehicle/overview.html">See More</a>  </div>
          </div>
          </div>
        </div>
        <div class="front-3">
          <div class="column-3">
            <img src="images/car4.jpg" alt="">
            <div class="text-block10">
            <h10> The 2021 BMW i7</h10>
            <p10> THE FASTEST CAR OF THE WORLD </p10>
            <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/vehicles/5-series/sedan/overview.html">See More</a>  </div>
            </div>
          </div>
          <div class="column-3">
            <img src="images/car5.jpg" alt="">
            <div class="text-block10">
            <h10> The 2021 BMW i7</h10>
            <p10> LEAD WITH CONFIDENCE </p10>
            <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/vehicles/8-series/overview.html">See More</a>  </div>
          </div>
          </div>
        </div> -->



      <!-- Library -->
      <div class="Library">
         <div class="container">
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="titlepage">
                     <h2>BUILD <strong class="black">the BMW Of Your Dreams </strong></h2>

                  </div>
               </div>
            </div>
         </div>
       </div>

  <div class="front-4">
      <div class="column-4">
        <img src="images/car7.jpg" alt="">
        <div class="exp1">
          <h10>LAMBORGHINI AVENTADOR SVJ</h10>
          <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/build-your-own.html#/series/3/sedan">START DESIGNING</a>  </div>
        </div>
      </div>
      <div class="column-4">
        <img src="images/car8.jpg" alt="">
        <div class="exp1">
          <h10>HURACAN WIND OF THE CAR</h10>
          <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/build-your-own.html#/series/X3/sports-activity-vehicle">START DESIGNING</a>  </div>
      </div>
      </div>
      <div class="column-4">
        <img src="images/car9.jpg" alt="">
        <div class="exp1">
          <h10>KAWASAKI THE KING OF SPEED</h10>
        <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/build-your-own.html#/series/5/sedan">START DESIGNING</a>  </div>
        </div>
      </div>
      <div class="column-4">
        <img src="images/car10.jpg" alt="">
        <div class="exp1">
          <h10>BMW THE MOST BEAUTIFUL CAR</h10>
          <div class="button_section"> <a class="main_bt" href="https://www.bmwusa.com/build-your-own.html#/series/X5/sports-activity-vehicle">START DESIGNING</a>  </div>
        </div>
      </div>
</div>
<section class="slider_section">

   <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <img class="first-slide" src="images/WP1.jpg" alt="First slide">
            <div class="container">
               <div class="carousel-caption relative">
                  <h1>REWARDS FOR  <br>THE DRIVEN</h1>
                  <p> Accelarate your rewards with the new BMW credit cards. </p>
                  <div class="button_section"> <a class="main_bt" href="https://www.mybmwcreditcard.com/offer1">See More</a>  </div>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <img class="second-slide" src="images/WP2.jpg" alt="Second slide">
            <div class="container">
               <div class="carousel-caption relative">
                  <h1>BMW VALUE SERVICE</h1>
                  <p> Think we're expensive? Think again. </p>

                  <div class="button_section"> <a class="main_bt" href="https://bmwusaservice.com/valueservice?utm_source=FMA&utm_campaign=JanFMAValue">See More</a>  </div>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <img class="third-slide" src="images/WP3.jpg" alt="Third slide">
            <div class="container">
               <div class="carousel-caption relative">
                  <h1>Protective MEASURES<br> </h1>
                  <p>Keep your BMW pristine with brand-new floor mats. </p>
                  <div class="button_section"> <a class="main_bt" href="https://www.shopbmwusa.com/ACCESSORIES/INTERIOR/FLOOR-MATS?utum_source=BMWUSA_FMA&utum_medium=National_FMA&utum_campaing=FloormatsFMA">See More</a>  </div>
                  <div class="button_section"> <a class="main_bt" href="https://www.shopbmwusa.com/ACCESSORIES/INTERIOR/FLOOR-MATS?utum_source=BMWUSA_FMA&utum_medium=National_FMA&utum_campaing=FloormatsFMA">Car Forum</a>  </div>

               </div>
            </div>
         </div>

      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
      </a>
   </div>
   <div class="Library">
      <div class="container">
         <div class="row">
            <div class="col-md-10 offset-md-1">
               <div class="titlepage">
                  <h2>OWNERSHIPS <strong class="black">Start Here </strong></h2>

               </div>
            </div>
         </div>
      </div>
    </div>
    <div class="front-5">
        <div class="column-5">
          <div class="exp2">
            <h1>Trade-In Value</h1>
          <p> Get the latest information on your vehicle’s trade-in value today.</p>
            <div class="button_section"> <a class="main_bt2" href="https://www.intelliprice.com/intellipricedealer/start.htm?dealerid=952001">VISIT BLACK BOOK</a>  </div>
          </div>
        </div>
        <div class="column-5">
          <div class="exp2">
            <h1>Check Your Credit Score</h1>
          <p>See where you stand on your journey to owning a BMW..</p>
            <div class="button_section"> <a class="main_bt2" href="https://www.intelliprice.com/intellipricedealer/start.htm?dealerID=9541001">VISI EQUIFAX</a>  </div>
        </div>
        </div>
        <div class="column-5">

          <div class="exp2">
            <h1>Apply for Financing</h1>
          <p>Own the BMW of your dreams with BMW Financial Services.</p>
          <div class="button_section"> <a class="main_bt2" href="https://creditapp.bmwusa.com/">GET STARTED</a>  </div>
          </div>
        </div>
        <div class="column-5">

          <div class="exp2">
            <h1>Stay Connected</h1>
          <p>Receive the latest offers, releases, and news from BMW./p>
            <div class="button_section"> <a class="main_bt2" href="https://www.bmwusa.com/keep-me-updated.html">SIGN UP NOW</a>  </div>
          </div>
        </div>
  </div>
  <?php
  include 'includes/footer.php';
   ?>
