<?php
if(!isset($_SESSION)) { session_start(); }
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
$dt = date("Y-m-d");
$usdsymbol= "USD";
$paypal_client_id= "ATBLdCoUlhUlPQrlqgI6MtKSEAWTBv387tUB_zoO4r8RzZDyJPG951LzFCm-QnQF2sLZz77Mc6lPyQM1";
include("dbconnection.php");
$sql = "SELECT * FROM product_purchase_bill where product_purchase_bill_id='$_GET[billid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
$custid = $rs['customer_id'];
$artist_id = $rs['artist_id'];

$sql1 = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
$qsql1 = mysqli_query($con,$sql1);
$rs1 = mysqli_fetch_array($qsql1);

$sql2 = "SELECT * FROM state WHERE state_id='$rs[state_id]'";
$qsql2 = mysqli_query($con,$sql2);
$rs2 = mysqli_fetch_array($qsql2);

$sql3 = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
$qsql3 = mysqli_query($con,$sql3);
$rs3 = mysqli_fetch_array($qsql3);


  $mailcontent = "<main id='main'>

    <!-- ======= Contact Section ======= -->
    <section id='contact' class='contact'>
      <div class='container'>
        <div class='row'>
          <div class='col-lg-12' data-aos='fade-up' data-aos-delay='100'>
            <div class='info mt-4'>
              <div class='logo mr-auto'>
                  <center><h3>Bill Receipt</h3></center>
              </div>
            </div>
            <table  border='1' cellspacing='0' cellpadding='0' style='border:1px solid #ccc;width: 100%;'   width='700px'>
  <tbody>
    <tr>
      <td style='padding-left: 5px;'>
                  <h4>Billing detail:</h4>
				          <p><b>Bill No. :</b>" . $rs['product_purchase_bill_id'] . "</p>
				          <p><b>Date of Bill :</b>" .  $rs['purchase_date'] . "</p>
                  <p><b>Name :</b> " . $rs['customer_name'] . "</p>
                  <p><b>Ph. No.</b> " .  $rs['customer_contact_number'] . "</p>
                  <p><b>Payment Type:</b> " . $rs['payment_type'] . "</p>
      </td>
      <td style='padding-left: 5px;'>
                <div class='info'>
                  <i class='icofont-envelope'></i>
                  <h4>Delivery address:</h4>
                  <p>" . $rs['customer_address'] . "<br>" .  $rs3['city'] . "<br>" .  $rs2['state'] . "<br>" .  $rs1['country'] . "<br>PIN " .  $rs['pincode'] . "</p>
                </div>
      </td>
    </tr>
              </table>
            <form action='forms/contact.php' method='post' role='form' class='php-email-form mt-4'>
              <div class='form-row'>
                <div class='col-md-12 form-group'>
<h2>Order Details</h2>
<table border='1' cellspacing='0' cellpadding='0' style='border:1px solid #ccc;' width='700px'>
  <tbody>
    <tr>";
      //$mailcontent .= "<th><strong>&nbsp;Image</strong></th>";
      $mailcontent .= "<th><strong>&nbsp;Product detail</strong></th>
      <th><strong>&nbsp;Product Cost</strong></th>
      <th><strong>&nbsp;Quantity</strong></th>
      <th><strong>&nbsp;Total</strong></th>
    </tr>";
	  		$i=1;
			$tot=0;
			  $sql = "SELECT * FROM product_purchase_record where product_purchase_bill_id='$_GET[billid]'";
			  $qsql = mysqli_query($con,$sql);
			  while($rs = mysqli_fetch_array($qsql))
			  {
			   	$sql1 = "SELECT * FROM selling_product WHERE selling_prod_id='$rs[selling_prod_id]'";
				  $qsql1 = mysqli_query($con,$sql1);
				  $rs1 = mysqli_fetch_array($qsql1);
          // Get the image and convert into string
          $img = file_get_contents("imgsellingproduct/" . $rs1['product_img1']);
          // Encode the image string data into base64
          $imgdata = base64_encode($img);
          // Display the output
			    $mailcontent .= "<tr>";
					/*$mailcontent .= "<td>&nbsp;<img src='data:image/webp;base64," . $imgdata ."' width='75' height='50'></td>";*/
					$mailcontent .= "<td>&nbsp;$rs1[product_name]</td>
					  <td>&nbsp;$usdsymbol $rs[cost]</td>
					  <td>&nbsp;$rs[quantity]&nbsp;$rs1[quantity_type]</td>
					  <td>&nbsp;<span id='calccost$i'> $usdsymbol " . $rs['cost'] * $rs['quantity'] ."</span></td>					  
					</tr>";
					$i++;
					$tot = $tot + ( $rs['cost'] * $rs['quantity'] );
			 }
      $mailcontent .= "<tr>";
      //$mailcontent .= "<th height='33' scope='row'>&nbsp;</th>";
      $mailcontent .= "<th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Grand total</strong></th>
      <th>&nbsp; $usdsymbol $tot</th>
    </tr>
  </tbody>
</table>";
?>
<?php
    //Mail Code Starts here
    include("phpmailer.php");
    if($custid != 0)
    {
        $sqlcustomer = "SELECT * FROM customer WHERE customer_id='" . $custid . "'";
        $qsqlcustomer = mysqli_query($con,$sqlcustomer);
        $rscustomer = mysqli_fetch_array($qsqlcustomer);
        sendmail($rscustomer['email_id'], $rscustomer['customer_name'] , "ZimCrafts Art Kit Invoice", $mailcontent);
    }
    if($artist_id != 0)
    {
        $sqlartist = "SELECT * FROM artist WHERE artist_id='" . $artist_id . "'";
        $qsqlartist = mysqli_query($con,$sqlartist);
        $rsartist = mysqli_fetch_array($qsqlartist);
        sendmail($rsartist['email_id'], $rsartist['artist_name'] , "ZimCrafts Art Kit Invoice", $mailcontent);
    }
    //Mail Code Ends here
    echo "<script>window.location='printbill.php?billid=" . $_GET['billid'] ."';</script>";
?>