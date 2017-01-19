<?php
	ob_start();
	session_start();
	$pageTitle = 'Show Item';
	include 'init.php';

	    	// CHECK IF GET REQUEST ITEM IS  NUMERIC & INTEGER VALUE
	    	$itemid = isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ? intval($_GET["itemid"]) : 0;
	    	//SELECT ALL DATA DEPEND ON THE ID
			$stmt = $con->prepare(" SELECT 
										items.* ,
										categories.Name AS category_name  , 
										users.Username 
									FROM items 
										INNER JOIN 
											categories 
										ON 
										categories.ID = items.Cat_ID
										INNER JOIN 
											users 
										ON 
										users.UserID = items.Members_ID 
										WHERE Item_id = ? ");
			// EXECUTE QUERY
			$stmt->execute(array($itemid));
			$count = $stmt->rowcount();
			// FETCH THE DATA
			if ($count > 0 ) {
				$item = $stmt->fetch();

			?>

			<h1 class="text-center"><?php echo $item["Name"]  ?></h1>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<img class="img-responsive img-thumbnail center-block" src="img.png" alt="" />
					</div>
				<div class="col-md-9 item-info">
				<ul class="list-unstyled">
					<h2>    <?php echo $item["Name"]   ?></h2>
					<p>     <?php echo  $item["Description"]    ?></p>
					<ul class="list-unstyled">
						<li><i class="fa fa-money fa-fw"></i><span> Price : </span><?php echo  $item["Price"]     ?></li>
						<li><i class="fa fa-building fa-fw"></i><span> Made In : </span><?php  echo $item["Country_Date"]  ?></li>
						<li><i class="fa fa-calendar fa-fw"></i><span> Added Date : </span><?php  echo  $item["Add_Date"]  ?></li>
						<li><i class="fa fa-tags fa-fw"></i><span> Category :  </span><a href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php  echo  $item["category_name"]  ?></a></li>
						<li><i class="fa fa-user fa-fw"></i><span> Added By:  </span> <a href="#"><?php  echo  $item["Username"]  ?></li>
					</ul>
				</div>
			</div>
		</div>
<?php
		}else { 
			 header('location: index.php') ; 
		}
	include $tpl . 'footer.php';
	ob_end_flush();
?>