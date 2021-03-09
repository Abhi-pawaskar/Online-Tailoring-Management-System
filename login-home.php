<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[car_id])
	{
		$SQL="SELECT * FROM car WHERE car_id = $_REQUEST[car_id]";
		$rs=mysql_query($SQL) or die(mysql_error());
		$data=mysql_fetch_assoc($rs);
	}
?> 
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
					<h4 class="heading colr">Welcome to Tailoring Management System</h4>
					<ul class='login-home-listing'>
						<?php if($_SESSION['user_details']['user_level_id'] == 1) {?>
							<li><a href="user.php?type=1">Add New System User</a></li>
							<li><a href="user.php?type=2">Add New Customer</a></li>
							<li><a href="category.php">Add New Category</a></li>
							<li><a href="measurement.php">Add New Measurement</a></li>
							<li><a href="user-report.php?type=1">System User Reports</a></li>
							<li><a href="user-report.php?type=2">Customer Reports</a></li>
							<li><a href="category-report.php">Category Reports</a></li>
							<li><a href="measurement-report.php">Measurement Reports</a></li>
							<li><a href="./user.php?user_id=<?php echo $_SESSION['user_details']['user_id']; ?>">My Account</a></li>
							<li><a href="change-password.php">Change Password</a></li>
							<li><a href="./lib/login.php?act=logout">Logout</a></li>
						<?php } ?>
						<?php if($_SESSION['user_details']['user_level_id'] == 2) {?>
							<li><a href="measurement-report.php">My Order History</a></li>
							<li><a href="./user.php?user_id=<?php echo $_SESSION['user_details']['user_id']; ?>">My Account</a></li>
							<li><a href="change-password.php">Change Password</a></li>
							<li><a href="./lib/login.php?act=logout">Logout</a></li>
						<?php } ?>
					</ul>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
