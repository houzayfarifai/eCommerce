<?php
include "init.php"; ?>

	<div class="container">
		<h1 class="text-center"><?php// echo str_replace("-" , " " , $_GET["pagename"])  ?> </h1>
		<div class="row">
		<?php 
				$items = getAllFrom( "*" , "items" , "where Cat_ID = '".$_GET['pageid']."' " , "Item_id" , "DESC" );
			 foreach($items as $item) {
			 	echo "<div class='col-sm-6 col-md-4'>" ; 
			 		echo '<div class="thumbnail item-box">';
			 			echo '<span class="price-tag">'  .  $item["Price"] . ' </span>' ; 
			 			echo "<img class='img-responsive' src='img.png' alt='' />"; 
			 			echo "<div class='caption' >" ; 
			 				echo '<h3><a href="item.php?itemid='. $item['Item_id'] .'">' .  $item['Name']  . '</a></h3>';
			 				echo "<p>"  .  $item['Description']  . "</p>";
			 				echo "<div class='date'>" . $item['Add_Date'] . " </div>" ; 
			 			echo "</div>" ; 
			 		echo"</div>";
			 	echo "</div>" ; 
			 }

		?>
		</div>
	</div>
<?php include $tpl . "footer.php";
?>
  