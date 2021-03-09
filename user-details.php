<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[user_id])
	{
		$SQL="SELECT * FROM user,city,state,country WHERE user_city = city_id and user_state = state_id and user_country = country_id and user_id = $_REQUEST[user_id]";
		$DSQL="SELECT * FROM product WHERE product_user_id = ".$_REQUEST['user_id'];
		$rs=mysql_query($SQL) or die(mysql_error());
		$drs=mysql_query($DSQL) or die(mysql_error());
		$data=mysql_fetch_assoc($rs);
	}
?> 
<script>
function goToPage(location)
{
	window.location.href = location;
}
</script>
<style>
th {
	color:#17446b !important;
	font-size:12px;
	padding-top:10px;
	text-align:left;
}
ul{
	margin-left:20px;
}
</style>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
					<h4 class="heading colr"><?=$data[user_name]?> Profile</h4>
					<table>
						<tr>
							<td><img src="<?=$SERVER_PATH.'uploads/'.$data[user_image]?>" alt="" style="width:266px;"/></td>
							<td style="vertical-align:top;">
								<table style="margin-left:10px;">
									<tr>
										<th colspan="2" style="padding-top:0px;"><h5 style="color:#17446b !important"><?=$data[user_name]?></h5></th>
									</tr>
									<tr>
										<th>Name</th>
										<td><?=$data['user_name']?></td>
									</tr>
									<tr>
										<th>Email</th>
										<td><?=$data['user_email']?></td>
									</tr>
									<tr>
										<th>Mobile</th>
										<td><?=$data['user_mobile']?></td>
									</tr>
									<tr>
										<th>Address</th>
									</tr>
									<tr>
										<td colspan="2" style="font-size:13px;">
										<div style="margin-left:10px;">
											<?=$data[user_add1]?><br>
											<?=$data[user_add2]?><br>
											City : <?=$data[city_name]?><br>
											State : <?=$data[state_name]?><br>
											Country : <?=$data[country_name]?><br>
										</div>
										</td>
									</tr>
									<tr>
										<th>Designer Profile</th>
									</tr>
									<tr>
										<td colspan="2" style="font-size:13px;">
										<div style="margin-left:10px;">
											<?=nl2br($data[user_profile])?><br>
										</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<div style="border:1px solid #cccccc; margin-top:10px"></div>
					<div style="float:right; margin-top:20px;" class="b-btn">
						<!--<input type="submit" value="Modification Request" class="simplebtn">-->
						<input type="submit" value="View All Desings" class="simplebtn" onClick="goToPage('list-product.php?user_id=<?=$data[user_id]?>')">
					</div>
					<div style="clear:both"></div>
					<h4 class="heading colr">All Desings of the <?=$data[user_name]?></h4>
					<div class="news">
					<ul style="width:675px">
						<?php 
						$sr_no=1;
						while($data = mysql_fetch_assoc($drs))
						{
							$sr_no++;
							$class = "last";
							if($sr_no%3)
								$class = "class = ''";
						?>
						<li <?=$class?> style="width:196px; background-image:none">
							<h6 class="last"><?=$data['product_title']?></h6>
							<a href="product-details.php?product_id=<?=$data[product_id]?>" class="thumb"><img src="<?=$SERVER_PATH.'uploads/'.$data[product_image]?>" alt="" style="width:166px; height:200px;"/></a>
							<div class="news_links" style="background-image:none">
								<a href="product-details.php?product_id=<?=$data[product_id]?>" class="readmore left">View Product</a>
							</div>
						</li>
						<?php
						}
						if($sr_no == 1) {
						?>
						No Product Found for this category !!!
						<?php } ?>
					</ul>
					</div>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
