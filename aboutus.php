<?php
include("header.php");
?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1>ARTISANS PRODUCTS - Unleash Your Artistic Potential, Connect with Collectors Worldwide...</h1>
      <a href="aboutus.php" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <?php include 'clienticons.php'; ?>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="images/pexels-abhishek-saini-3145866.jpg" style="width: 100%;">
            <img src="images/pexels-prasanta-kr-dutta-190589.jpg" style="width: 100%;">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
            <p class="font-italic"><b>Welcome to our Online RURAL ARTISANS Store!</b><br><br>
              At Zimcrafts, we believe that art has the power to inspire, transform, and connect people from all walks of life. We have created a vibrant online marketplace where artists can showcase their talent, and art enthusiasts can discover and collect captivating artworks from around the world.
            </p>
            <p class="font-italic">Our platform is designed to provide a seamless and enriching experience for both artists and collectors. We have brought together a diverse community of talented artists who specialize in various styles, mediums, and genres. Whether you're a seasoned collector looking to expand your collection or an emerging artist seeking global exposure, [Platform Name] is your gateway to the world of art.
            </p>
            <p class="font-italic"><b>For Artists:</b> We understand the passion and dedication that goes into creating art. That's why we provide a dynamic platform where artists can showcase their unique creations to a global audience. With our user-friendly interface, artists can easily create their profiles, upload high-quality images of their artworks, and provide detailed descriptions. We empower artists to take control of their artistic journey by setting their own prices, managing their inventory, and directly engaging with potential buyers. Join our thriving community of artists and unlock new opportunities to connect, sell, and gain recognition for your talent.
            </p>
            <p class="font-italic"><b>For Collectors:</b> We know that collecting art is a deeply personal and enriching experience. At Zimcrafts, we strive to make the process of discovering and acquiring artworks an enjoyable one. With our extensive collection of artworks from around the world, you can explore a wide range of styles, mediums, and themes to find the perfect piece that resonates with you. Our platform offers powerful search tools and personalized recommendations, making it easy to navigate through the vast array of artworks. Engage in direct conversations with artists, learn about their creative process, and acquire unique and meaningful artworks that will enhance your collection.
            </p>
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
            <p>EXHIBITION</p>
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

  </main><!-- End #main -->
  
<?php
include("footer.php");
?>