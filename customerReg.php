<?php 
include("header.php");
if(!isset($_GET['editid'])){
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
}
if($_SESSION['randnumber']  == $_POST['randnumber']) 
{
	if(isset($_POST['submit'])) {
		if(isset($_GET['editid'])) {
			$sql ="UPDATE customer SET  `customer_name`='$_POST[customername]', `address`='$_POST[address]', `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city_id`='$_POST[city]', `pincode`='$_POST[pincode]', `contact_no`='$_POST[cntctnum]', `mobile_no`='$_POST[mblnum]', `email_id`='$_POST[email_id]', `password`='$_POST[password]', `customer_type`='$_POST[customertype]', `status`='$_POST[status]' WHERE customer_id='$_GET[editid]'";
			if(!mysqli_query($con,$sql)){
				echo "Error in mysqli query";
			}
			else {
				echo "<script>alert('Customer record updated successfully...');</script>";
			}
		}
		else {
			$sql="INSERT INTO `customer`( `customer_name`, `address`, `country_id`, `state_id`, `city_id`, `pincode`, `contact_no`, `mobile_no`, `email_id`, `password`, `customer_type`, `status`) VALUES ('$_POST[customername]','$_POST[address]','$_POST[country]','$_POST[state]','$_POST[city]','$_POST[pincode]','$_POST[cntctnum]','$_POST[mblnum]','$_POST[email_id]','$_POST[password]','$_POST[customertype]','$_POST[status]')";	
			if(!mysqli_query($con,$sql)) {
				echo mysqli_error($con);
			}
			else {
				//Mail Code Starts here
				$insid = mysqli_insert_id($con);
				$sqlcustomer = "SELECT * FROM customer WHERE customer_id='$insid'";
				$qsqlcustomer = mysqli_query($con,$sqlcustomer);
				$rscustomer = mysqli_fetch_array($qsqlcustomer);
				include("phpmailer.php");
				$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
				$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
				$registrationmsg = "Hello " . $rscustomer['customer_name'] . "<br><br>Greetings from ZimCrafts Marketplace!<br><br>Thank you for signing up! We're excited to have you here. Sign into your account to access all the featues of ZimCrafts...<br><br> ". "<a href='" . $protocol . "://" . $_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . "/customerreglogin.php' class='btn btn-danger'>Click here to Login</a>";
				sendmail($rscustomer['email_id'], $rscustomer['customer_name'] , "Welcome to ZimCrafts", $registrationmsg);
				//Mail Code Ends here
				echo "<script>alert('Customer Registred successfully...');</script>";
				echo "<script>window.location='customerloginpanel.php';</script>";				
			}
		}
	}
}
$randnumber = rand();
$_SESSION['randnumber'] = $randnumber;
if(isset($_GET['editid']))
{
	$sql = "SELECT * FROM customer WHERE customer_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
}
?>

  <main id="main">
  
      <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Customer Registration Panel</h2>
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
                  <h4>Register as Customer</h4>
                  <img src="images/customericon.jpg" style="width: 100%;">
                </div>
              </div>
              <div class="col-md-9 d-flex align-items-stretch">
                <div class="icon-box" data-aos="zoom-in" data-aos-delay="100" style="width: 100%;text-align: left;">
<form method="post" action="" name="frmcstreg">
	<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
    <h4>Registration Panel</h4>
				  
<div class="form-row">
	<div class="col-md-6 form-group">
	Customer Name <font color="#FF0000">*</font>
	  <input type="text" name="customername" id="customername" value="<?php echo $rsedit['customer_name']; ?>" class="form-control" >
	</div>	
	
	<div class="col-md-6 form-group">
	Email ID <font color="#FF0000">*</font>
	  <input type="email" name="email_id" id="email_id" value="<?php echo $rsedit['email_id']; ?>" class="form-control" >
	</div>	
	
	<div class="col-md-6 form-group">
	Password <font color="#FF0000">*</font>
	  <input type="password" name="password" id="password" value="<?php echo $rsedit['password']; ?>" class="form-control" >
	</div>
	
	<div class="col-md-6 form-group">
	Confirm Password <font color="#FF0000">*</font>
	  <input type="password" name="cpassword" id="cpassword" value="<?php echo $rsedit['password']; ?>" class="form-control" >
	</div>	
	
	<div class="col-md-12 form-group">
	 Address <font color="#FF0000">*</font>
	  <textarea name="address" id="address" class="form-control"><?php echo $rsedit['address']; ?></textarea>
	</div>
	
	<div class="col-md-6 form-group">
	Country <font color="#FF0000"> *</font>
	  <select name="country" id="country" onChange="loadstate(this.value)" class="form-control">
		  <option value="">Select</option>
		  <?php
		  $sql1 = "SELECT * FROM country where status='Active'";
			$qsql1 =mysqli_query($con,$sql1);
		  while($rssql1 = mysqli_fetch_array($qsql1))
		  {
			  if($rssql1['country_id'] == $rsedit['country_id'] )
			  {
			  echo "<option value='$rssql1[country_id]' selected>$rssql1[country]</option>";
			  }
			  else
			  {
			  echo "<option value='$rssql1[country_id]'>$rssql1[country]</option>";
			  }
		  }
		  ?>
		</select>
	</div>
	
	<div class="col-md-6 form-group">
	Province / State <font color="#FF0000"> *</font>
	  <span id='loadstate'><?php include("ajaxstate.php"); ?></span></div>
	
	<div class="col-md-6 form-group">
	City <font color="#FF0000"> *</font>
	  <span id='loadcity'><?php include("ajaxcity.php"); ?></span>
	</div>
	
	<div class="col-md-6 form-group">
	Pincode <font color="#FF0000"> *</font>
	  <input type="number" name="pincode" id="pincode" value="<?php echo $rsedit['pincode']; ?>" class="form-control">
	</div>

	<div class="col-md-6 form-group">
	Mobile Number <font color="#FF0000"> *</font>
	  <input type="number" name="mblnum" id="mblnum" value="<?php echo $rsedit['mobile_no']; ?>" class="form-control">
	</div>
	
	<div class="col-md-6 form-group">
	Secondary Contact Number <font color="#FF0000"> *</font>
	  <input type="number" name="cntctnum" id="cntctnum" value="<?php echo $rsedit['contact_no']; ?>" class="form-control">
	</div>
	
	<div class="col-md-6 form-group">
	Customer Type <font color="#FF0000"> *</font>
	  <select name="customertype" id="customertype" class="form-control" >
		  <option value="">Register as</option>
		  <?php
		  $arr= array("Customer","Collector","Investor", "Owner", "Interior Designers");
		  foreach($arr as $val)
		  {
			  if($rsedit['customer_type'] == $val)
			  {
			  echo "<option value='$val' selected >$val</option>";
			  }
			  else
			  {
			  echo "<option value='$val'>$val</option>";
			  }
		  }
		  ?>
		  </select>
	</div>
	
	<div class="col-md-6 form-group">
	<?php
	if(isset($_SESSION['adminid']))
	{
	?>
	Status <font color="#FF0000"> *</font>
	  <select name="status" id="status" class="form-control" >
		   <option value="">Select</option>
		  <?php
		  $arr= array("Active","Inactive");
		  foreach($arr as $val)
		  {
			  if($rsedit['status'] == $val)
			  {
			  echo "<option value='$val' selected >$val<option>";
			  }
			  else
			  {
			  echo "<option value='$val'>$val<option>";
			  }
		  }
		  ?>
		</select>
	<?php } else { ?>
		<input type="hidden" name="status" value="Active" >
	<?php } ?>
	</div>
</div>
	<?php
	include('smsapi.php');
	?>	
	<input type="hidden" name="smsstatus" id="smsstatus" value="<?php echo $smsstatus; ?>" >
	<?php
	if($smsstatus == "Enabled"){
	?>
		<button type="button" name="submitotp" id="submitotp" class="btn btn-danger btn-lg btn-block"  onclick="return validatecstreg()" >Click here to Register</button>
	<?php
	}
	else {
	?>
		<button type="submit" name="submit" id="submit" class="btn btn-danger btn-lg btn-block"  onclick="return validatecstreg()" >Click here to Register</button>
	<?php
	}
	?>
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
	        <h4 class="modal-title">Verify OTP</h4>
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
	      	<button value="Login" name="submit" id="submit" class="btn btn-danger button-login" type="submit" onclick="return validateotp()">Complete Registration</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<?php
include("footer.php");
?>
<script type="application/javascript">
function validatecstreg()
{
	var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

	if(document.frmcstreg.customername.value == "") {
		alert("Customer name should not be empty..");
		document.frmcstreg.customername.focus();
		return false;
	}
	else if(!document.frmcstreg.customername.value.match(alphaspaceExp)) {
		alert("Please enter only letters for Customer name..");
		document.frmcstreg.customername.focus();
		return false;
	}
	else if(document.frmcstreg.address.value == "") {
		alert("Address should not be empty..");
		document.frmcstreg.address.focus();
		return false;
	}
	else if(document.frmcstreg.country.value == "") {
		alert("Kindly select the country..");
		document.frmcstreg.country.focus();
		return false;
	}	
	else if(document.frmcstreg.state.value == "") {
		alert("Kindly select the state..");
		document.frmcstreg.state.focus();
		return false;
	}	
	else if(document.frmcstreg.city.value == "") {
		alert("Kindly select the city..");
		document.frmcstreg.city.focus();
		return false;
	}
	else if(document.frmcstreg.pincode.value == "") {
		alert("Kindly enter PIN Code..");
		document.frmcstreg.pincode.focus();
		return false;
	}
	else if(document.frmcstreg.cntctnum.value == "") {
		alert("Kindly enter Contact number..");
		document.frmcstreg.cntctnum.focus();
		return false;
	}
	else if(document.frmcstreg.mblnum.value == "") {
		alert("Kindly enter Mobile number..");
		document.frmcstreg.mblnum.focus();
		return false;
	}
	else if(document.frmcstreg.mblnum.value.length != 10) {
		alert("Mobile Number should contain 10 digits..");
		document.frmcstreg.mblnum.focus();
		return false;
	}
	else if(document.frmcstreg.email_id.value == "") {
		alert("Kindly enter Email ID..");
		document.frmcstreg.email_id.focus();
		return false;
	}		
	else if(!document.frmcstreg.email_id.value.match(emailExp)) {
		alert("Kindly enter Valid Email ID.");
		document.frmcstreg.email_id.focus();
		return false;
	}	
	else if(document.frmcstreg.password.value == "") {
		alert("Password should not be empty..");
		document.frmcstreg.password.focus();
		return false;
	}			
	else if(document.frmcstreg.password.value.length < 8) {
		alert("Password length should be more than 8 characters...");
		document.frmcstreg.password.focus();
		return false;
	}
	else if(document.frmcstreg.password.value.length > 16) {
		alert("Password length should be less than 16 characters...");
		document.frmcstreg.password.focus();
		return false;
	}		
	else if(document.frmcstreg.cpassword.value == "") {
		alert("Confirm password should not be empty..");
		document.frmcstreg.cpassword.focus();
		return false;
	}		
	else if(document.frmcstreg.password.value != document.frmcstreg.cpassword.value) {
		alert("Password and confirm password not matching...");
		document.frmcstreg.cpassword.focus();
		return false;
	}				
	else if(document.frmcstreg.customertype.value == "") {
		alert("Kindly select the customer type..");
		document.frmcstreg.customertype.focus();
		return false;
	}
	else {
				if($('#smsstatus').val() == "Enabled") {
					$("#submitotp").prop("disabled", "disabled");
					$("#submitotp").html('Please wait...');
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("otpnumber").value = this.responseText;
							document.getElementById("otpmobno").value = document.getElementById("mblnum").value;
							$('#otpModal').modal('show');
						}
					};
					xmlhttp.open("GET","sendotp.php?mblnum="+document.getElementById("mblnum").value+"&cstname="+document.getElementById("customername").value,true);
					xmlhttp.send();
				}
				else {
					return true;
				}
	}
}

function loadstate(id) {
    if (id == "") {
        document.getElementById("loadstate").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadstate").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxstate.php?id="+id,true);
        xmlhttp.send();
    }
}
function loadcity(id) {
    if (id == "") {
        document.getElementById("loadcity").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadcity").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxcity.php?id="+id,true);
        xmlhttp.send();
    }
}
</script>