<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[measurement_id])
	{
		///// Get Mesurements Details ////
		$SQL="SELECT * FROM `measurement` WHERE measurement_id = $_REQUEST[measurement_id]";
		$rs=mysql_query($SQL) or die(mysql_error());
		$data=mysql_fetch_assoc($rs);
		
		//// Get Comments /////
		$SQL="SELECT * FROM `comments`, `user` WHERE comments_measurement_id = $_REQUEST[measurement_id] AND comments_user_id = user_id";
		$rs1=mysql_query($SQL) or die(mysql_error());
	}
	if($_SESSION['user_details']['user_level_id'] == 2) {
		$disabled = "disabled";
	}
?>
<script>
jQuery(function() {
	jQuery( "#measurement_date" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	   yearRange: "-0:+1",
	   dateFormat: 'd MM,yy'
	});
	jQuery( "#measurement_delivery_date" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	   yearRange: "-0:+1",
	   dateFormat: 'd MM,yy'
	});
});
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
				<h4 class="heading colr">Customer Measurement Entry Form</h4>
				<?php if($_REQUEST['msg']) { ?>
					<div class="msg"><?=$_REQUEST['msg']?></div>
				<?php } ?>
				<form action="lib/measurement.php" enctype="multipart/form-data" method="post" name="frm_type">
					<ul class="forms">
						<li class="txt">Select Customer</li>
						<li class="inputfield">
							<select name="measurement_customer_id" id="measurement_customer_id" class="bar" required <?=$disabled?>/>
								<?php echo get_new_optionlist("user","user_id","user_name",$data[measurement_customer_id],"user_level_id=2"); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">Select Category</li>
						<li class="inputfield">
							<select name="measurement_category_id" id="measurement_category_id" class="bar" required <?=$disabled?>/>
								<?php echo get_new_optionlist("category","category_id","category_name",$data[measurement_category_id]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">Select Status</li>
						<li class="inputfield">
							<select name="measurement_status_id" id="measurement_category_id" class="bar" required <?=$disabled?>/>
								<?php echo get_new_optionlist("status","status_id","status_title",$data[measurement_status_id]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">Measurement Date</li>
						<li class="inputfield"><input name="measurement_date" id="measurement_date" type="text" class="bar" required value="<?=$data[measurement_date]?>" <?=$disabled?>/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Delivery Date</li>
						<li class="inputfield"><input  <?=$disabled?> name="measurement_delivery_date" id="measurement_delivery_date" type="text" class="bar" required value="<?=$data[measurement_delivery_date]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Cost</li>
						<li class="inputfield"><input <?=$disabled?> name="measurement_cost" type="text" class="bar" required value="<?=$data[measurement_cost]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Customization</li>
						<li class="textfield"><textarea <?=$disabled?> name="measurement_customization" cols="" rows="6" required><?=$data[measurement_customization]?></textarea></li>
					</ul>
					<ul class="forms">
						<li class="txt">Description</li>
						<li class="textfield"><textarea <?=$disabled?> name="measurement_description" cols="" rows="6" required><?=$data[measurement_description]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<?php if($_SESSION['user_details']['user_level_id'] == 1) { ?>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<?php } ?>
					<input type="hidden" name="act" value="save_measurement">
					<input type="hidden" name="measurement_id" value="<?=$data[measurement_id]?>">
				</form>
			</div>
			<?php if($_REQUEST[measurement_id]) { ?>
			<div class="contact" style="clear:both;">
			<h4 class="heading colr">Enter Your Comments</h4>
			<form action="lib/comments.php" enctype="multipart/form-data" method="post" name="frm_type">
					<ul class="forms">
						<li class="txt">Title</li>
						<li class="inputfield"><input name="comments_title" type="text" class="bar" required value="<?=$data[comments_title]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Comments</li>
						<li class="textfield"><textarea name="comments_details" cols="" rows="6" required><?=$data[comments_details]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Post Comment" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_comments">
					<input type="hidden" name="comments_measurement_id" value="<?=$data[measurement_id]?>">
				</form>
			</div>
			<div class="contact" style="clear:both;">
			<h4 class="heading colr">Comments and Reviews:</h4>
			<table style="width:100%">
					<tbody>
					<?php 
					$sr_no=1;
					if(mysql_num_rows($rs1)) 
					{
					while($data = mysql_fetch_assoc($rs1))
					{
					?>
					  <tr class="tablehead bold"><td scope="col" style="background-color:#17446b; padding:8px; color:#ffffff; margin-top:20px"><?=$data['comments_title']?> (Posted By : <?=$data['user_name']?> on <?=$data['comments_date']?>)</td></tr>
					  <tr><td style="padding-bottom:20px;"><?=nl2br($data[comments_details])?></td></tr>
					<?php } 
						}
					else {
					?>
					<tr>
						<td style="text-align:left; font-weight:bold; color: #ff0000" colspan="6">No Comments found !!!!</td>
					</tr>
					<?php } ?>
					</tbody>
					</table>
			</div>
			<?php } ?>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
