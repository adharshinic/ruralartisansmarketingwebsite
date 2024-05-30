<?php
include("header.php");
include_once("textslider.php");
?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1>ARTISANS PRODUCT - Rural Artisans Online Store..</h1>
      <h2>Art evokes the mystery without which the world would not exist…</h2>
      <a href="customerreglogin.php" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

<?php include 'clienticons.php'; ?>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="images/pexels-photo-716107.jpeg" style="width: 100%;">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
            <p class="font-italic"><b>Welcome to our Online Rural Artisans Store!</b>
              <br>At ARTISANS PRODUCT, we believe that art has the power to inspire, transform, and connect people from all walks of life. We have created a vibrant online marketplace where artists can showcase their talent, and art enthusiasts can discover and collect captivating artworks from around the world.
            </p>
            <p class="font-italic"><b>Mission :</b> To provide technology and services to artists, merchants, and labourers to help them expand their business and provide them with a wider market. And to improve the present art trading processes and to provide knowledge about recent art issues.
            </p>
            <p class="font-italic"><b>Vision :</b> To provide a helping hand to the Artists and labourers in improving their lives through the medium of technology, thereby, improving the Arts Sector in the Zimbabwean Economy.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> ‘ARTISANS PRODUCT' is a model Artists management website application..</li>
              <li><i class="ri-check-double-line"></i> ‘ARTISANS PRODUCT’ provides a concept of virtual art trade to its users.</li>
              <li><i class="ri-check-double-line"></i> It helps the wholesalers and retailers in buying produce from larger number of Artists.</li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-2 col-4 text-center">
            <span data-toggle="counter-up"><?php
$sql = "select * from artist";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
			?></span>
            <p>Artists</p>
          </div>

          <div class="col-lg-2 col-4 text-center">
            <span data-toggle="counter-up"><?php
$sql = "select * from customer";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
			?></span>
            <p>Customers</p>
          </div>
		  
          <div class="col-lg-2 col-4 text-center">
            <span data-toggle="counter-up"><?php
$sql = "select * from article";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
			?></span>
            <p>Blogs & Articles</p>
          </div>

          <div class="col-lg-2 col-4 text-center">
            <span data-toggle="counter-up"><?php
$sql = "select * from product";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
			?></span>
            <p>Art Kit</p>
          </div>

          <div class="col-lg-2 col-4 text-center">
            <span data-toggle="counter-up"><?php
$sql = "select * from selling_product";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
			?></span>
            <p>Artist's Market</p>
          </div>

          <div class="col-lg-2 col-4 text-center">
            <span data-toggle="counter-up"><?php
$sql = "select * from worker";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
			?></span>
            <p>Workers</p>
          </div>


        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">

          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box mt-4 mt-xl-0">
                    <h4>Customer</h4>
                    <i class="bx bx-group"></i>
                    <p>Are you willing to purchase artworks from Artists?<br> <b>Login / Register as Customer</b></p>
					<div class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='customerreglogin.php'">Click Here</button></div>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                  <div class="icon-box mt-4 mt-xl-0">
                    <h4>Artist</h4>
                    <i class="bx bx-donate-heart"></i>
                    <p>Online Market where you can Sell all your Products...<br>
					<b>Login / Register as an Artist</b></p>
					<div class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='artistreglogin.php'">Click Here</button></div>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                  <div class="icon-box mt-4 mt-xl-0">
                    <h4>Worker</h4>
                    <i class="bx bx-walk"></i>
                    <p>Would you be interested in working alongside artists?...<br> <b>Login / Register as Worker</b></p>
					<div class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='workerreglogin.php'">Click Here</button></div>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->


  </main><!-- End #main -->
  
<?php
include("footer.php");
?>