<?php
include("header.php");
if(isset($_SESSION['customerid'])){
	echo "<script>window.location='customerpanel.php';</script>";
}
if(isset($_SESSION['artistid'])){
	echo "<script>window.location='artistpanel.php';</script>";
}
if(isset($_SESSION['workerid'])){
	echo "<script>window.location='workerpanel.php';</script>";
}
if(isset($_SESSION['adminid'])){
	echo "<script>window.location='adminpanel.php';</script>";
}
if($_SESSION['randnumber']  == $_POST['randnumber']){
	if(isset($_POST['submit'])){
			$sql = "SELECT * FROM artist WHERE email_id='$_POST[emailid]' AND password='$_POST[password]' AND status='Active' ";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_num_rows($qsql) == 1){
					$rslogin = mysqli_fetch_array($qsql);
					$_SESSION['artistid'] = $rslogin['artist_id']; 
					if(isset($_GET['redirectlink'])){
						$redirectlink = $_GET['redirectlink'] . "?workerid=" . $_GET['workerid'];
						echo "<script>window.location='$redirectlink';</script>";
					}
					else if(isset($_GET['pagename'])){
						echo "<script>window.location='" . $_GET['pagename'] . "?productid=" . $_GET['productid'] . "';</script>";
					}
					else {
						echo "<script>window.location='artistpanel.php';</script>";
					}
			}
			else {
				echo "<script>alert('Login ID and password not valid..');</script>";	
			}
	}
}
$randnumber = rand();
$_SESSION['randnumber'] = $randnumber;
?>
  <main id="main">
  
      <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Artist Login Panel</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
<hr>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
			
              <div class="col-md-3 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="icon-box" data-aos="zoom-in" data-aos-delay="200" style="width: 100%;">
                  <h4>Artist Login</h4>
                  <img src="images/farmer%20icon.jpg" style="width: 100%;">
                </div>
              </div>
              <div class="col-md-6 d-flex align-items-stretch">
                <div class="icon-box" data-aos="zoom-in" data-aos-delay="100" style="width: 100%;text-align: left;">
										<form method="post" action="" name="frmartistlogin">
												<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
										    <h4>Login Panel</h4>
												<div class="form-group">
												    <label for="exampleInputEmail1">Email address</label>
												    <input type="email" class="form-control" id="emailid" name="emailid" aria-describedby="emailHelp" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Password</label>
													<input type="password" class="form-control"  placeholder="Password"  id="password" name="password">
												</div>
												<a href="artistforgotpassword.php">Forgot Password?</a>
													<?php
													include('smsapi.php');
													?>	
													<input type="hidden" name="smsstatus" id="smsstatus" value="<?php echo $smsstatus; ?>" >
													<?php
													if($smsstatus == "Enabled"){
													?>
													<button type="button" name="submitotp" id="submitotp" class="btn btn-danger btn-lg btn-block"  onclick="return validateartistlogin()" >Click here to Login</button>
													<?php
													} else {
													?>
													<button type="submit" name="submit" id="submit" class="btn btn-danger btn-lg btn-block" onclick="return validateartistlogin()" >Click here to Login</button>
													<?php } ?>
													<script>
													function validateotp(){
														if(document.getElementById("otpnumber").value == document.getElementById("enteredotp").value){
															return true;
														}
														else {
															alert("You have entered invalid OTP..");
															return false;
														}
													}
													</script>
                </div>
              </div>

              <div class="col-md-3 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="icon-box" data-aos="zoom-in" data-aos-delay="200" style="width: 100%;">
                  <h4><a href="artist.php">New User</a></h4>
                  <div class="icon"><i class="bx bx-file"></i></div>
				  <button type="button" class="btn btn-warning btn-lg btn-block"  onclick="window.location='artist.php'" >Sign Up (It's Free)</button>
                </div>
              </div>


            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

<hr>
  </main><!-- End #main -->
  	<div id="otpModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" style="max-width: 50%;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Verify Login OTP</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>
	      <div class="modal-body">
			<p class="coupon-input form-row-first">
				<label><b>We have sent OTP to following Mobile Number.</b></label>
				<input type="text" name="otpmobno" id="otpmobno" readonly class="form-control">
				<input type="hidden" name="otpnumber" id="otpnumber" readonly>
			</p>
				<p class="coupon-input form-row-first">
				<label>Enter OTP</label>
				<input type="text" name="enteredotp" id="enteredotp" class="form-control">
			</p>
	      </div>
	      <div class="modal-footer">
	      	<button value="Login" name="submit" id="submit" class="btn btn-danger button-login" type="submit" onclick="return validateotp()">Veify OTP</button>
	      </div>
	    </div>
	  </div>
	</div>

</form>
<?php
include("footer.php");
?>
<script type="application/javascript">
function validateartistlogin()
{
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID
	if(document.frmartistlogin.emailid.value == "") {
		alert("E-Mail ID should not be empty..");
		document.frmartistlogin.emailid.focus();
		return false;
	}
	else if(!document.frmartistlogin.emailid.value.match(emailExp)) {
		alert("Kindly enter Valid Email ID.");
		document.frmartistlogin.emailid.focus();
		return false;
	}	
	else if(document.frmartistlogin.password.value == "") {
		alert("Password should not be empty..");
		document.frmartistlogin.password.focus();
		return false;
	}
	else
	{
			if($('#smsstatus').val() == "Enabled") {
					$("#submitotp").prop("disabled", true);
					$("#submitotp").html('Please wait...');
				  $.post("loginotp.php",
				  {
				    emailid: $('#emailid').val(),
				    password: $('#password').val(),
				    logintype: "artist"
				  },
				  function(data){
				  	rec = JSON.parse(data);
				    if(rec.status == "Failed"){
				    		$('#emailid').val('');
				    		$('#password').val('');
								$("#submitotp").prop("disabled", false);
								$("#submitotp").html('Click here to Login');
				    		alert("Entered Login credential is not valid...");
				    }
				    else {
								document.getElementById("otpmobno").value = rec.mblnum;
					    	document.getElementById("otpnumber").value = rec.otp;
								$('#otpModal').modal('show');
				    }
				  });
			} else {
				return true;
			}
	}
}
</script>