<?php 
include_once("includes/header.php"); 
include_once("includes/db_connect.php"); 
$SQL="SELECT * FROM category";
$rs=mysql_query($SQL) or die(mysql_error());
global $SERVER_PATH;
?> 
      <div id="content_sec">
     <div class="col1" style="width:1075px">
		<h4 class="heading colr">All Design Categries</h4>
			<div class="news">
            <ul style="width:1075px">
				<?php 
				$sr_no=1;
				while($data = mysql_fetch_assoc($rs))
				{
					$sr_no++;
					$class = "";
					if($sr_no%3)
						$class = "class = ''";
				?>
				<li <?=$class?>>
                	<h6 class="last"><?=$data['category_name']?></h6>
                    <a href="list-product.php?category_id=<?=$data[category_id]?>" class="thumb"><img src="<?=$SERVER_PATH.'uploads/'.$data[category_image]?>" alt="" style="height:163px; width:266px;"/></a>
                    <p><?=$data['category_description']?></p>
                    <div class="news_links">
                    	<a href="list-product.php?category_id=<?=$data[category_id]?>" class="readmore left">View Items</a>
                    </div>
                </li>
				<?php
				}
				?>
			</ul>
			</div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<?php include_once("includes/footer.php"); ?> 