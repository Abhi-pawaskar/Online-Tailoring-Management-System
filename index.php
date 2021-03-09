<?php 
ini_set("display_errors",1);
error_reporting(E_ALL);
include_once("includes/header.php"); 
include_once("includes/db_connect.php"); 
$SQL="SELECT * FROM category";
$rs=mysql_query($SQL) or die(mysql_error());
global $SERVER_PATH;
?> 
	<div id="banner">
    	<div class="left">
        	<div class="anythingSlider">
        
          <div class="wrapper">
            <ul>
               <li><a href="#"><img src="./images/banner1.jpg" alt="" /></a></li>
               <li><a href="#"><img src="./images/banner2.png" alt="" /></a></li>
               <li><a href="#"><img src="./images/banner3.jpg" alt="" /></a></li>
            </ul>        
          </div>
          
        </div>
        </div>
    </div>
    <div class="clear"></div>
  <script type="text/javascript" src="./js/cont_slide.js"></script>
  <div id="content_sec">
     <div class="col1">
		<h4 class="heading colr">Tailoring Management System</h4>
			<div class="news">
            <ul>
				<?php 
				$sr_no=1;
				while($data = mysql_fetch_assoc($rs))
				{
					$sr_no++;
					$class = "";
					if($sr_no%2)
						$class = "class = 'last'";
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
	<div class="col2">
		<?php include_once("includes/sidebar.php"); ?>
		<div><img src="images/save_2.jpg" style="width: 250px"></div>
	</div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<?php include_once("includes/footer.php"); ?> 
