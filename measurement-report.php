<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM measurement, user, status WHERE measurement_status_id = status_id AND measurement_customer_id = user_id";
	$heading = "Measurement Reports";
	if($_SESSION['user_details']['user_level_id'] == 2) {
		$SQL="SELECT * FROM measurement, user, status WHERE measurement_status_id = status_id AND measurement_customer_id = user_id AND user_id = ".$_SESSION['user_details']['user_id'];
		$heading = "Your Orders";
	}
	$rs=mysql_query($SQL) or die(mysql_error());
	global $SERVER_PATH;
?>
<script>
function delete_measurement(measurement_id)
{
	if(confirm("Do you want to delete the measurement?"))
	{
		this.document.frm_measurement.measurement_id.value=measurement_id;
		this.document.frm_measurement.act.value="delete_measurement";
		this.document.frm_measurement.submit();
	}
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
			<h4 class="heading colr"><?=$heading?></h4>
			<?php
			if($_REQUEST['msg']) { 
			?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
			<?php
			}
			?>
			<form name="frm_measurement" action="lib/measurement.php" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr class="tablehead bold">
						<td scope="col">Sr. No.</td>
						<td scope="col">Customer Name</td>
						<td scope="col">Sale Date</td>
						<td scope="col">Delivery Date</td>
						<td scope="col">Cost</td>
						<td scope="col">Status</td>
						<td scope="col">Action</td>
					  </tr>
					<?php 
					$sr_no=1;
					if(mysql_num_rows($rs)) {
					while($data = mysql_fetch_assoc($rs))
					{
					?>
					  <tr>
						<td style="text-align:center; font-weight:bold;"><?=$sr_no++?></td>
						<td><?=$data[user_name]?></td>
						<td><?=$data[measurement_date]?></td>
						<td><?=$data[measurement_delivery_date]?></td>
						<td><?=$data[measurement_cost]?></td>
						<td><?=$data[status_title]?></td>
						<td style="text-align:center">
							<?php if($_SESSION['user_details']['user_level_id'] == 1) {?>
								<a href="measurement.php?measurement_id=<?php echo $data[measurement_id] ?>">Edit</a> | <a href="Javascript:delete_measurement(<?=$data[measurement_id]?>)">Delete</a> 
							<?php } else { ?>
								<a href="measurement.php?measurement_id=<?php echo $data[measurement_id] ?>">View Details</a>
							<?php } ?>
						</td>
					  </tr>
					<?php } 
						}
					else {
					?>
					<tr>
						<td style="text-align:left; font-weight:bold; color: #ff0000" colspan="6">No orders found !!!!</td>
					</tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="measurement_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
