<?php 
include("header.php");
if(!isset($_SESSION['adminid']))
{
	echo "<script>window.location='adminloginpanel.php'; </script>";
}
if(isset($_GET['deleteid']))
{
	$sql = "DELETE FROM product WHERE product_id='$_GET[deleteid]'";
		if(!mysqli_query($con,$sql))
	{
		echo "<script>alert('Failed to delete record'); </script>";
	}
	else
	{
		if(mysqli_affected_rows($con)  >= 1)
		{
         echo "<script>alert('This record deleted successfully..'); </script>";
		}
	}
}
?>
  <main id="main">


    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="text-center" data-aos="zoom-in">
		<br><br>
          <h3>View Artist's Market</h3>
        </div>

      </div>
    </section><!-- End Cta Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row">
		

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="info mt-4 ">
			
		<center><h4>View Artist's Market Report...</h4></center><hr>

							<?php
								$sql = "SELECT * FROM product";
							  if(isset($_SESSION['artistid'])) {
								  $sql = $sql . " WHERE artist_id='$_SESSION[artistid]'";
							  }
							  $qsql = mysqli_query($con,$sql);
								if(mysqli_num_rows($qsql)  == 0) {
									echo "<center>There is no product to display!!</center>";
								}
								else
								{
								?>
							<table ID="datatable" class="table table-striped table-bordered"  style="width:100%">
								<THEAD>
							  <tr>
						      <th width="113"><strong>Artist Name</strong></th>
						      <th width="81"><strong>Category</strong></th>
						      <th width="80"><strong>Produce</strong></th>
						      <th width="69"><strong>Variety</strong></th>
						      <th width="60"><strong>Title</strong></th>
						      <th width="72"><strong>Images</strong></th>
						      <th width="76"><strong>Quantity</strong></th>
						      <th width="99"><strong>Upload Date</strong></th>
						      <th width="70"><strong>Status</strong></th>
                  <th width="92"><strong>Action</strong></th>
						      </tr>
								</THEAD>
								<TBODY>
                <?php
							  while($rs = mysqli_fetch_array($qsql))
							  { 
									$sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  
								  $sql2 = "SELECT * FROM produce WHERE produce_id='$rs[produce_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2= mysqli_fetch_array($qsql2);
								  
								  $sql3 = "SELECT * FROM variety WHERE variety_id='$rs[variety_id]'";
								  $qsql3 = mysqli_query($con,$sql3);
								  $rs3 = mysqli_fetch_array($qsql3);
								  
									$sqlartist = "SELECT * FROM artist WHERE artist_id='$rs[artist_id]'";
									$qsqlartist = mysqli_query($con,$sqlartist);
									$rsartist = mysqli_fetch_array($qsqlartist);
								  
							  	echo "
						    	<tr>
						      <td>&nbsp;$rsartist[artist_name]</td>
						      <td>&nbsp; $rs1[category] </td>							  
						      <td>&nbsp;$rs2[produce]</td>
						      <td>&nbsp;$rs3[variety]</td>
						      <td>&nbsp;$rs[title]</td>
						      <td>&nbsp;";
						      if(file_exists("imgproduct/" . $rs['img_1']) && $rs['img_1'] != "") {
									echo "<img src='imgproduct/$rs[img_1]' width='25' height='25'>";
									}
									if(file_exists("imgproduct/" . $rs['img_2']) && $rs['img_2'] != "" ) {
									echo "<img src='imgproduct/$rs[img_2]' width='25' height='25'>";
									}
									if(file_exists("imgproduct/" . $rs['img_3']) && $rs['img_3'] != "") {
									echo "<img src='imgproduct/$rs[img_3]' width='25' height='25'>";
									}
									if(file_exists("imgproduct/" . $rs['img_4']) && $rs['img_4'] != "") {
								  echo "<img src='imgproduct/$rs[img_4]' width='25' height='25'>";
								  }
									if(file_exists("imgproduct/" . $rs['img_5']) && $rs['img_5'] != "") {
									echo "<img src='imgproduct/$rs[img_5]' width='25' height='25'>";
									}
									echo "</td>
						      <td>&nbsp;$rs[quantity] &nbsp; $rs[quantity_type]</td>
						      <td>&nbsp;$rs[uploaded_date]</td>
						      <td>&nbsp;$rs[status]</td>
							   	<td>&nbsp; <a href='Product.php?editid=$rs[product_id]' class='btn btn-info'>Edit</a> <a href='viewProduct.php?deleteid=$rs[product_id]' onclick='return delconfirm()' CLASS='btn btn-danger'>Delete</a></td>
					        </tr>";
							  }
							  ?>
								</TBODY>
						  </table>
						<?php
						 }
						?>
            </div>
		  </div>
		  
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  
<?php
include("footer.php");
?>
<script type="application/javascript">
function delconfirm()
{
	if(confirm("Are you sure you want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>