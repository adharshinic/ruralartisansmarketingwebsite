<?php 
include("header.php");
if($_SESSION['randnumber']  == $_POST['randnumber']){ 
	if(isset($_POST['submitdetail'])){
		$sql="INSERT INTO product_purchase_bill( customer_id, country_id, state_id, city_id, customer_name, customer_address, pincode, customer_contact_number, purchase_date, status,payment_type ,payment_description,artist_id) VALUES ('$_SESSION[customerid]','$_POST[cstcountry]','$_POST[cststate]','$_POST[cstcity]','$_POST[cstname]','$_POST[cstaddress]','$_POST[cstpincode]','$_POST[cstcontact]','$dt','Active','$_POST[paymenttype]','$_POST[payment_description]','$_SESSION[artistid]') ";
		if(!mysqli_query($con,$sql)){
			echo "Error in mysqli query";
		}
		else{
			echo "<script>alert('Order placed successfully...');</script>";			
		}
		$insid = mysqli_insert_id($con);
		$buyingproduct = $_POST['buyingproduct'];
		if(isset($_SESSION['customerid'])){
			for($icount=0; $icount < count($_POST['buyingproduct']); $icount++){
				 $sql = "UPDATE product_purchase_record SET status='Active', product_purchase_bill_id='$insid' WHERE customer_id='$_SESSION[customerid]' AND status='Pending' AND purchase_record_id='$buyingproduct[$icount]'";
				mysqli_query($con,$sql);
			}
		}
		if(isset($_SESSION['artistid'])){
			for($icount=0; $icount < count($_POST['buyingproduct']); $icount++){
				$sql = "UPDATE product_purchase_record SET status='Active', product_purchase_bill_id='$insid' WHERE artist_id='$_SESSION[artistid]' AND status='Pending' AND purchase_record_id='$buyingproduct[$icount]'";
				mysqli_query($con,$sql);	
			}
		}
		echo "<script>window.location='mail_bill_kit.php?billid=$insid';</script>";
	}
}
$randnumber = rand();
$_SESSION['randnumber'] = $randnumber;
if(isset($_SESSION['customerid']))
{
	$sqlcustomer = "SELECT * FROM customer WHERE customer_id='$_SESSION[customerid]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
}
if(isset($_SESSION['artistid']))
{
	$sqlcustomer = "SELECT * FROM artist WHERE artist_id ='$_SESSION[artistid]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
}
?>
  <main id="main">


    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="text-center" data-aos="zoom-in">
		<br><br>
          <h3>Payment Panel</h3>
        </div>

      </div>
    </section><!-- End Cta Section -->

<form method="post" action="" name="frmcstdetail" onSubmit="return validatecstdetail()">
<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row">
		

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="info mt-4 ">
			
		<center><h4>Complete your order by Making Payment...</h4></center><hr>

<?php
$i=1;
$tot=0;
$buyingproduct = $_POST['buyingproduct'];
?>
							<table class="table table-striped table-bordered"  style="width:100%">
								<THEAD>
							  <tr>
      <th><strong>&nbsp;Image</strong></th>
      <th><strong>&nbsp;Product detail</strong></th>
      <th><strong>&nbsp;Product Cost</strong></th>
      <th><strong>&nbsp;Quantity</strong></th>
      <th><strong>&nbsp;Total</strong></th>
						      </tr>
								</THEAD>
								<TBODY>
<?php								
			for($icount=0; $icount < count($_POST['buyingproduct']); $icount++)
			{
				echo "<input type='hidden' name='buyingproduct[]' value='$buyingproduct[$icount]' >";
				  $sql = "SELECT * FROM product_purchase_record where customer_id='$_SESSION[customerid]' AND purchase_record_id='$buyingproduct[$icount]' ";
				  $qsql = mysqli_query($con,$sql);
				  $rs = mysqli_fetch_array($qsql);
				  
					$sql1 = "SELECT * FROM selling_product WHERE selling_prod_id='$rs[selling_prod_id]'";
					  $qsql1 = mysqli_query($con,$sql1);
					  $rs1 = mysqli_fetch_array($qsql1);
				  echo "
						<tr>
						<td>&nbsp;<img src='imgsellingproduct/$rs1[product_img1]' width='75' height='75'></td>
						  <td>&nbsp;$rs1[product_description]</td>
						  <td>&nbsp;$usdsymbol $rs[cost]</td>
						  <td>&nbsp;$rs[quantity]</td>
						  <td>&nbsp;<span id='calccost$i'>$usdsymbol " . $rs['cost'] * $rs['quantity'] ."</span></td>					  
						</tr>";
						$i++;
						$tot = $tot + ( $rs['cost'] * $rs['quantity'] );
				 
			}
?>
								</TBODY>
								<tfoot>
    <tr>
      <th colspan="4" style="text-align: right;"><strong>Grand total</strong></th>
      <th>&nbsp;<?php echo $usdsymbol; ?>  <?php echo $tot; ?>
      <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $tot; ?>">
      </th>
    </tr>								
								</tfoot>
						  </table>


    <section id="contact" class="contact">
      <div class="container">
        <div class="row">
		

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="info ">
			
		<center><h4>Enter Payment Detail...</h4></center><hr>

<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
				  
<div class="form-row">
	<div class="col-md-6 form-group">
	Customer Name <font color="#FF0000">*</font>
	  <input type="text" name="cstname" id="cstname" value="<?php echo $rscustomer['customer_name']; ?><?php echo $rscustomer['artist_name']; 
	  ?>" autofocus class="form-control" >
	</div>	
	
	<div class="col-md-6 form-group">
	Contact Number <font color="#FF0000">*</font>
	  <input type="text" name="cstcontact" id="cstcontact" value="<?php echo $rscustomer['mobile_no']; ?>" autofocus class="form-control" >
	</div>	
	
		<div class="col-md-12 form-group">
	Address <font color="#FF0000">*</font>
	  <textarea name="cstaddress" id="cstaddress" class="form-control"><?php echo $rscustomer['address']; ?><?php echo $rscustomer['artist_address']; ?></textarea>
	</div>	
	
	<div class="col-md-6 form-group">
		Country <font color="#FF0000">*</font>
	  <select name="cstcountry" id="cstcountry" onChange="loadstate(this.value)" class="form-control">
       <option value="">Select Country</option>
                                  <?php
								  $sql1 = "SELECT * FROM country where status='Active'";
									$qsql1 =mysqli_query($con,$sql1);
								  while($rssql1 = mysqli_fetch_array($qsql1))
								  {
									  if($rssql1['country_id'] == $rscustomer['country_id'] )
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
		State<font color="#FF0000">*</font>
	  <span id='loadstate'><select name="cststate" id="cststate" onChange="loadcity(this.value)" class="form-control">
<option value="">Select</option>
<?php
$sql2 = "SELECT * FROM state where status='Active' ";
$qsql2 =mysqli_query($con,$sql2);
while($rssql2 = mysqli_fetch_array($qsql2))
{
if($rssql2['state_id'] == $rscustomer['state_id'] )
{
echo "<option value='$rssql2[state_id]' selected>$rssql2[state]</option>";
}
else
{
echo "<option value='$rssql2[state_id]'>$rssql2[state]</option>";
}
}
?>
</select></span>
	</div>	
	
	<div class="col-md-6 form-group">
	City <font color="#FF0000">*</font>
	  <span id='loadcity'><select name="cstcity" id="cstcity" class="form-control">
    <option value="">Select</option>
    <?php
    $sql3 = "SELECT * FROM city where status='Active'";
    $qsql3 =mysqli_query($con,$sql3);
    while($rssql3 = mysqli_fetch_array($qsql3))
    {
      if($rssql3['city_id'] == $rscustomer['city_id'] )
      {
      echo "<option value='$rssql3[city_id]' selected>$rssql3[city]</option>";
      }
      else
      {
      echo "<option value='$rssql3[city_id]'>$rssql3[city]</option>";
      }
    }
    ?>
</select></span>
	</div>	
	
	<div class="col-md-6 form-group">
	PIN Code <font color="#FF0000">*</font>
	  <input type="text" name="cstpincode" id="cstpincode" value="<?php echo $rscustomer['pincode']; ?>" autofocus class="form-control" >
	</div>	
	
	
	<div class="col-md-6 form-group">
	Payment type <font color="#FF0000">*</font>
	  <select name="paymenttype" id="paymenttype" onChange="funpaymenttype(this.value)" autofocus class="form-control">
        <option value="">Select</option>
        <?php
			$arr =array("Online Payment","Cash on delivery");
			foreach($arr as $val)
			{
				echo "<option value='$val'>$val</option>";
			}
    ?>
      </select>
	</div>	
	
		
	<div class="col-md-12 form-group">		
		<div id="div_paypal">
			<input type="hidden" name="payment_description" id="payment_description" >
			<hr>
			<center><div id="paypal-payment-button"></div></center>
		</div>
		<div id="div_cashondelivery">
			<hr>
			<center><input type="submit" name="submitdetail" id="submitdetail" value="Click here to Submit" autofocus class="btn btn-danger"></center>
		</div>
	</div>	
	
	
</div>
  </div>
		  </div>
		  
        </div>

      </div>
    </section><!-- End Contact Section -->
 
            </div>
		  </div>
		  
        </div>

      </div>
    </section><!-- End Contact Section -->
				</form> 

  </main><!-- End #main -->
  
<?php
include("footer.php");
?>
<script type="application/javascript">
	$("#div_paypal").hide();
	$("#div_cashondelivery").hide();
	function changecost(totqty,purchaseid,divid)
	{
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        }
			else
			{
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("calccost"+divid).innerHTML = xmlhttp.responseText;
	            }
	        };
			xmlhttp.open("GET","ajaxupdatecart.php?totqty="+totqty+"&purchaseid="+purchaseid+"&divid="+divid,true);
	        xmlhttp.send();
	}
	function funpaymenttype(paytype)
	{
		if(paytype == "Online Payment"){
			$("#div_paypal").show();
			$("#div_cashondelivery").hide();
		}
		else{			
			$("#div_paypal").hide();
			$("#div_cashondelivery").show();
		}
	}
	function validatecstdetail()
	{
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
			if(document.frmcstdetail.cstname.value == "")
		{
			alert("Customer name should not be empty..");
			document.frmcstdetail.cstname.focus();
			return false;
		}
		else if(!document.frmcstdetail.cstname.value.match(alphaspaceExp))
		{
			alert("Please enter only letters for your name..");
			document.frmcstdetail.cstname.focus();
			return false;
		}
		else if(document.frmcstdetail.cstaddress.value == "")
		{
			alert("Address should not be empty..");
			document.frmcstdetail.cstaddress.focus();
			return false;
		}
		else if(document.frmcstdetail.cstcountry.value == "")
		{
			alert("Kindly select a country..");
			document.frmcstdetail.cstcountry.focus();
			return false;
		}
		else if(document.frmcstdetail.cststate.value == "")
		{
			alert("Kindly select a state..");
			document.frmcstdetail.cststate.focus();
			return false;
		}
		else if(document.frmcstdetail.cstcity.value == "")
		{
			alert("Kindly select a city..");
			document.frmcstdetail.cstcity.focus();
			return false;
		}
		else if(document.frmcstdetail.cstpincode.value == "")
		{
			alert("Kindly enter the PIN Code..");
			document.frmcstdetail.cstpincode.focus();
			return false;
		}
		else if(document.frmcstdetail.cstcontact.value == "")
		{
			alert("Kindly enter the Contact Number..");
			document.frmcstdetail.cstcontact.focus();
			return false;
		}
		else if(document.frmcstdetail.paymenttype.value == "")
		{
			alert("Kindly select the payment type..");
			document.frmcstdetail.paymenttype.focus();
			return false;
		}
		else if(document.frmcstdetail.cardtype.value == "")
		{
			alert("Kindly select the card type..");
			document.frmcstdetail.cardtype.focus();
			return false;
		}
			else if(document.frmcstdetail.cardnumber.value == "")
		{
			alert("Kindly enter the card number..");
			document.frmcstdetail.cardnumber.focus();
			return false;
		}
		else if(document.frmcstdetail.cardnumber.value.length < 16)
		{
			alert("Kindly enter a valid 16 digit Card Number...");
			document.frmcstdetail.cardnumber.focus();
			return false;
		}	
			
		else if(document.frmcstdetail.cardnumber.value.length > 16)
		{
			alert("Kindly enter a valid 16 digit Card Number...");
			document.frmcstdetail.cardnumber.focus();
			return false;
		}	
		else if(document.frmcstdetail.cvvnumber.value == "")
		{
			alert("Kindly enter CVV Number..");
			document.frmcstdetail.cvvnumber.focus();
			return false;
		}
		else if(document.frmcstdetail.expdate.value == "")
		{
			alert("Kindly select the Expiry Date..");
			document.frmcstdetail.expdate.focus();
			return false;
		}
		else
		{
			return true;
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
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $paypal_client_id; ?>"></script>
<script type="text/javascript">
paypal.Buttons({
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: $('#grand_total').val()
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            $('#payment_description').val(JSON.stringify(details));
            $('#submitdetail').click();
        });
    },
    onCancel: function (data) {
    	console.log(data);
    }
}).render('#paypal-payment-button');
</script>