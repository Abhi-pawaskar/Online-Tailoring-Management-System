<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `category`";
	$rs=mysql_query($SQL) or die(mysql_error());
?>
<script>
function delete_category(category_id)
{
	if(confirm("Do you want to delete the category?"))
	{
		this.document.frm_category.category_id.value=category_id;
		this.document.frm_category.act.value="delete_category";
		this.document.frm_category.submit();
	}
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
			<h4 class="heading colr">Electricity Connection Category Report</h4>
			<?php
			if($_REQUEST['msg']) { 
			?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
			<?php
			}
			?>
			<form name="frm_category" action="lib/category.php" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr class="tablehead bold">
					    <td scope="col">ID</td>
						<td scope="col">Image</td>
						<td scope="col">Name</td>
						<td scope="col">Description</td>
						<td scope="col">Action</td>
					  </tr>
					<?php 
					$sr_no=1;
					while($data = mysql_fetch_assoc($rs))
					{
					?>
					  <tr>
						<td><?=$data[category_id]?></td>
						<td><img src="<?=$SERVER_PATH.'uploads/'.$data[category_image]?>" style="heigh:50px; width:50px"></td>
						<td><?=$data[category_name]?></td>
						<td style="width:400px;"><?=$data[category_description]?></td>
						<td style="text-align:center">
							<a href="category.php?category_id=<?php echo $data[category_id] ?>">Edit</a> | <a href="Javascript:delete_category(<?=$data[category_id]?>)">Delete</a> </td>
						</td>
					  </tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="category_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 