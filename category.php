<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[category_id])
	{
		$SQL="SELECT * FROM `category` WHERE category_id = $_REQUEST[category_id]";
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
				<h4 class="heading colr">Category Entry Form</h4>
				<?php if($_REQUEST['msg']) { ?>
					<div class="msg"><?=$_REQUEST['msg']?></div>
				<?php } ?>
				<form action="lib/category.php" enctype="multipart/form-data" method="post" name="frm_type">
					<ul class="forms">
						<li class="txt">Category Name</li>
						<li class="inputfield"><input name="category_name" id="category_name" type="text" class="bar" required value="<?=$data[category_name]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Category Image</li>
						<li class="inputfield"><input name="category_image" id="category_image" type="file" class="bar" required value="<?=$data[category_image]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Description</li>
						<li class="textfield"><textarea name="category_description" cols="" rows="6" required><?=$data[category_description]?></textarea></li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<input type="hidden" name="avail_image" value="<?=$data[category_image]?>">
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_category">
					<input type="hidden" name="category_id" value="<?=$data[category_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
