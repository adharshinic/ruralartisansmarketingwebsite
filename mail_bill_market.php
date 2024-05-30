<?php
if(!isset($_SESSION)) { session_start(); }
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
$dt = date("Y-m-d");
$usdsymbol= "USD";
$paypal_client_id= "ATBLdCoUlhUlPQrlqgI6MtKSEAWTBv387tUB_zoO4r8RzZDyJPG951LzFCm-QnQF2sLZz77Mc6lPyQM1";
include("dbconnection.php");

$mailcontent = "
                  <center><h2 style='padding: 0 0 0 0px;'>Payment Receipt:</h2></center>";
										$sqlbill = "SELECT * FROM purchase_order_bill where purchase_order_bill_id='$_GET[purchase_order_bill_id]'";
										$qsqlbill = mysqli_query($con,$sqlbill);
										$rsbill = mysqli_fetch_array($qsqlbill);
									
										$sqlpurchase_order = "SELECT * FROM purchase_order WHERE purchase_order_id='$rsbill[purchase_order_id]'";
										$qsqlpurchase_order = mysqli_query($con,$sqlpurchase_order);
										$rspurchase_order = mysqli_fetch_array($qsqlpurchase_order);
							 
								   	$sqlcustomer = "SELECT * FROM customer WHERE customer_id='$rspurchase_order[customer_id]'";
								  	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
								  	$rscustomer = mysqli_fetch_array($qsqlcustomer);
								
								   	$sqlcstcountry = "SELECT * FROM country WHERE country_id='$rscustomer[country_id]'";
								  	$qcstcountry = mysqli_query($con,$sqlcstcountry);
								  	$rscstcountry = mysqli_fetch_array($qcstcountry);
								
								  	$sqlcststate = "SELECT * FROM state WHERE state_id='$rscustomer[state_id]'";
								  	$qcststate  = mysqli_query($con,$sqlcststate);
								  	$rscststate  = mysqli_fetch_array($qcststate);
								 
								  	$sqlcstcity = "SELECT * FROM city WHERE city_id='$rscustomer[city_id]'";
								  	$qsqlcstcity = mysqli_query($con,$sqlcstcity);
								  	$rscstcity = mysqli_fetch_array($qsqlcstcity);
									
										$sqlartist = "SELECT * FROM artist WHERE artist_id='$rspurchase_order[artist_id]'";
								  	$qsqlartist = mysqli_query($con,$sqlartist);
								  	$rsartist = mysqli_fetch_array($qsqlartist);
									
								   	$sqlselcountry = "SELECT * FROM country WHERE country_id='$rsartist[country_id]'";
								  	$qselcountry = mysqli_query($con,$sqlselcountry);
								  	$rsselcountry = mysqli_fetch_array($qselcountry);
								
								  	$sqlselstate = "SELECT * FROM state WHERE state_id='$rsartist[state_id]'";
								  	$qselstate  = mysqli_query($con,$sqlselstate);
								  	$rsselstate  = mysqli_fetch_array($qselstate);
								 
								  	$sqlselcity = "SELECT * FROM city WHERE city_id='$rsartist[city_id]'";
								  	$qsqlselcity = mysqli_query($con,$sqlselcity);
								  	$rsselcity = mysqli_fetch_array($qsqlselcity);
												  
						$mailcontent .= "
						<table   border='1' cellspacing='0' cellpadding='0' style='border:1px solid #ccc;width: 755px;'   width='755'>
						<tr>
							<td>
									<p style='padding: 0 0 0 0px;'><b>Order Bill Number:</b>" . $rsbill['purchase_order_bill_id'] . "</p><p style='padding: 0 0 0 0px;'><b>Paid Date:</b>" .  $rsbill['paid_date'] . "</p><p style='padding: 0 0 0 0px;'><b>Customer Name:</b>" . $rscustomer['customer_name'] . "</p>
                  <p style='padding: 0 0 0 0px;'><b>artist Name:</b>" . $rsartist['artist_name'] . "</p>
              </td>
              <td>
                  <h4>Customer address:</h4>
                  <p>" .  $rscustomer['address']. "<br>
										  " .  $rscstcity['city']. "<br>
										  " .  $rscststate['state']. "<br>
										  " .  $rscstcountry['country']. "<br>
										  PIN Code:" .  $rscustomer['pincode']. "<br>
										  Ph. No. " .  $rscustomer['contact_no']. "
										  </p>
              </td>
              <td>
                  <h4>artist Address:</h4>
                  <p>
                  		" . $rsartist['artist_address']. " <br>
                      " . $rsselcity['city']. " <br>
                      " . $rsselstate['state']. " <br>
                      " . $rsselcountry['country']. "<br>
                      PIN Code: " . $rsartist['pincode']. "<br>
					  					Ph. No. " . $rsartist['mobile_no']. "</p>
              </td>
						</tr>
						</table>
						<hr>
                <h2>Product Details</h2>
                <table   border='1' cellspacing='0' cellpadding='0' style='border:1px solid #ccc;width: 100%;'   width='755'>
							  <tbody>
							    <tr>
							      <th><strong>Product Name</strong></th>
							      <th><strong>Quantity</strong></th>
							      <th><strong>Total</strong></th>
							    </tr>";
	  		$i=1;
			$tot=0;
			$sqlproduct = "SELECT * FROM product WHERE product_id='$rspurchase_order[product_id]'";
			$qsqlproduct = mysqli_query($con,$sqlproduct);
			$rsproduct = mysqli_fetch_array($qsqlproduct);
			
			  $mailcontent .=  "
					<tr>
					  <td>&nbsp;$rsproduct[title]</td>
					  <td>&nbsp;$rspurchase_order[quantity]&nbsp;$rsproduct[quantity_type]</td>
					  <td>&nbsp;<span id='calccost$i'>$usdsymbol " . $rspurchase_order['purchase_amt'] ."</span></td>					  
					</tr>";
    $mailcontent .= "<tr>
      <th>&nbsp;</th>
      <th><strong>Grand total</strong></th>
      <th>&nbsp;  $usdsymbol " . $rspurchase_order['purchase_amt'] . "</th>

    </tr>
  </tbody>
</table>
<hr>
<table border='1' cellspacing='0' cellpadding='0' style='border:1px solid #ccc;width: 100%;'   width='755'>
				            <tbody>
				              <tr>
				                <th width='231' height='31' scope='row' align='right'><strong>Payment type:</strong></th>
				                <th width='514' height='31' scope='row' align='left'>&nbsp;" . $rsbill['payment_type'] . "</th>
			                  </tr>
				              
				              <tr>
				                <th height='33' scope='row' align='right'>&nbsp;<strong>Paid Date:</strong></th>
				                <th align='left'>&nbsp;" .  $rsbill['paid_date'] . "</th>
			                  </tr>
                              
                              
				              <tr>
				                <th height='33' scope='row' align='right'>&nbsp;<strong>artist Bank Account detail:</strong></th>
				                <th align='left'><strong> &nbsp;Bank Name: </strong> ". $rsartist['bank_name'] . "<br>
                              &nbsp;Bank Account number: </strong> " .$rsartist['bank_acno'] . "<br>
                              &nbsp;Branch: </strong> ".$rsartist['bank_branch'] . "<br>
                               &nbsp;IFSC Code: </strong> ". $rsartist['bank_IFSC'] . "<br>
                                </th>
			                  </tr>
			                </tbody>
</table>";
//Mail Code Starts here
	include("phpmailer.php");
    sendmail($rscustomer['email_id'], $rscustomer['customer_name'] , "ZimCrafts Artist's Artwork order Invoice", $mailcontent);
    sendmail($rsartist['email_id'], $rsartist['artist_name'] , "ZimCrafts Artist's Artwork Payment Receipt", $mailcontent);
//Mail Code Ends here
		echo "<script>window.location='salesprintbill.php?purchase_order_bill_id=" . $_GET['purchase_order_bill_id'] ."';</script>";
?>