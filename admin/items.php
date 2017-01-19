<?php 

	/* 
	===========================================
	== Items Page 
	===========================================
	*/
	ob_start() ; // output Buffering Start 
	session_start() ; 
	$pageTitle = "Items" ; 
	if( isset($_SESSION["Username"])) {
	include "init.php" ; 
	$do = isset($_GET["do"]) ? $_GET["do"] : "Manage" ;
	if ($do == "Manage") {
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
										users.UserID = items.Members_ID ");
				$stmt->execute();
				$items = $stmt->fetchAll();
				?> 
				<h1 class="text-center"> Manage Items </h1>
                    <div class="container">
	                    <div class="table-responsive">
							<table class="main-table text-center table table-bordered">
								<tr>	
									<td>#ID</td>
									<td>Name</td>
									<td>Description</td>
									<td>Price</td>
									<td>Adding Date</td>
									<td>Category</td>
									<td>Username</td>
									<td>Control</td>
								</tr>
								<?php 
									foreach ($items as $item) {
											echo "<tr>" ; 
											echo "<td>" . $item["Item_id"] . "</td>" ; 
											echo "<td>" . $item["Name"] . "</td>" ; 
											echo "<td>" . $item["Description"] . "</td>" ; 
											echo "<td>" . $item["Price"] . "</td>" ; 
											echo "<td>" . $item["Add_Date"] . "</td>" ;
											echo "<td>" . $item["category_name"] . "</td>" ;
											echo "<td>" . $item["Username"] . "</td>" ;
											echo "<td>
													<a href='Items.php?do=Edit&itemid=" . $item['Item_id'] ."'  class='btn btn-success'>Edit </a>
													<a href='Items.php?do=Delete&itemid=" . $item['Item_id'] ."'  class=' confirm btn btn-danger'>Delete </a> 
												</td>";
										echo "</tr>";
									}
								?>
								</tr>
								</table>
	                    </div>
	  					   <a href='Items.php?do=Add' class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New Item</a>
					</div>

			<?php
	}elseif($do == "Add" ){ ?>
			<h1 class = "text-center"> Add New Item </h1>
                    <div class="container">
				<form class="form-horizontal" action="?do=Insert" method="post">
					
					<!-- start name field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="name" 
								   class="form-control"  
								   placeholder ="Name of the Item" 
								   autocomplete="off"  />
						</div>
					</div>
					<!-- End name field -->
					<!-- start Description field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="Description" 
								   class="form-control"  
								   placeholder ="Description of the Item" 
								   autocomplete="off" />
						</div>
					</div>
					<!-- End Description field -->
					<!-- start Price field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Price</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="Price" 
								   class="form-control"  
								   placeholder ="Price of the Item" 
								   autocomplete="off" />
						</div>
					</div>
					<!-- End Price field -->
					<!-- start Country field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="Country" 
								   class="form-control"  
								   placeholder ="Made in ... " 
								   autocomplete="off" />
						</div>
					</div>
					<!-- End Country field -->
					<!-- start status field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">status</label>
						<div class="col-sm-10 col-md-4">
							<select name="status" class="form-control">
								<option value="0">...</option>
								<option value="1">New</option>
								<option value="2">Like New</option>
								<option value="3">Used</option>
								<option value="4">Very old </option>
							</select>
						</div>
					</div>
					<!-- End status field -->
					<!-- start members field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Members</label>
						<div class="col-sm-10 col-md-4">
							<select name="members" class="form-control">
								<option value="0">...</option>
								<?php 
								$stmt = $con->prepare("SELECT * FROM users");
								$stmt->execute();
								$users = $stmt->fetchAll();
								foreach( $users as $user ) {
									echo "<option value='" . $user["UserID"] . "'>" . $user["Username"] . "</option>";
								}
								?>
							</select>
						</div>
					</div>
					<!-- End members field -->
					<!-- start categories field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Gategories</label>
						<div class="col-sm-10 col-md-4">
							<select name="categories" class="form-control">
								<option value="0">...</option>
								<?php 
								$stmt2= $con->prepare("SELECT * FROM categories");
								$stmt2->execute();
								$cats = $stmt2->fetchAll();
								foreach( $cats as $cat ) {
									echo "<option value='" . $cat["ID"] . "'>" . $cat["Name"] . "</option>";
								}
								?>
							</select>
						</div>
					</div>
					<!-- End categories field -->
					<!-- start add item -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit"   value="Add Item" class="btn btn-primary btn-lg" placeholder ="Describe the category"  />
						</div>
					</div>
					<!-- End add item  -->
				</form>
			</div> 
<?php 	}elseif($do == "Insert") {
	echo "<h1 class ='text-center'> Edit Members </h1>" ;
					echo "<h1 class='container'>";
						if($_SERVER["REQUEST_METHOD"] == "POST" ) {
							// get variables from form
							$name = $_POST["name"];
							$desc = $_POST["Description"];
							$price = $_POST["Price"]; 
							$country = $_POST["Country"];
							$status = $_POST["status"];
							$member = $_POST["members"];
							$cat = $_POST["categories"];

		                    // validate the form 
		                    $formErrors = array();
		                    if(empty($name)  ) {
		                    	$formErrors[] = "Name can not be Empty " ; 		
		                    }
		                    if(empty($desc) ) {
		                    	$formErrors[] = "Description can not be Empty" ; 		
		                    }
		                    if(empty($price)){
		                    	$formErrors[] = "price can not be Empty" ;}
		                    if(empty($country)){
		                    	$formErrors[] = "country can not be Empty" ;}
		                    if($status == 0 ){
		                    	$formErrors[] = "you must choose the status" ;}
		                    if(empty($member)){
		                    	$formErrors[] = "members can not be Empty" ;}
		                    //if($cat == 0  ){
		                    	//$formErrors[] = "categories can not be Empty" ;}
		                    	

		                    	foreach($formErrors as $error ) {
		                    		echo "<div class='alert alert-danger'>" . $error . "</div>" ;
		                    	}
		                    	if(empty($formErrors)) {
		                    		
		                    		// Insert the info to database  
		                    			$stmt = $con->prepare("INSERT INTO
		                    				 items(Name, Description, Price, Country_Date , Status  , Add_Date , Cat_ID , Members_ID)
		                    				 VALUES(:zname , :zdesc , :zprice , :zcountry ,  :zstatus  , now() , :zcat ,:zmember )" );
		                    			$stmt->execute(array(

		                    					"zname" 	=> $name , 
		                    					"zdesc" 	=> $desc , 
		                    					"zprice" 	=> $price , 
		                    					"zcountry"	=> $country,
		                    					"zstatus"	=> $status , 
		                    					"zcat"		=> $cat , 
		                    					"zmember"	=> $member 


		                    				));
										//echo  success message  
										$theMSG = "<div class='alert alert-success'>" . $stmt->rowCount(). " record Insert "; 
										redirectHome( $theMSG , "back" , 2 );
									}
		                    	
						}else {
							$theMSG = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly</div>";
							redirectHome($theMSG , "back" , 3);

						}
						echo "</div>";


	    }elseif($do == "Edit") {
	    	// CHECK IF GET REQUEST ITEM IS  NUMERIC & INTEGER VALUE
	    	$itemid = isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ? intval($_GET["itemid"]) : 0;
	    	//SELECT ALL DATA DEPEND ON THE ID
			$stmt = $con->prepare(" SELECT * FROM items where Item_id= ? ");
			// EXECUTE QUERY
			$stmt->execute(array($itemid));
			// FETCH THE DATA
			$item = $stmt->fetch();
			// THE ROW COUNT 
			$count = $stmt->rowCount();
			// IF THERE IS ID => START WORK !
			if ($count = $stmt->rowCount() > 0) { ?>
				<h1 class = "text-center"> Edit Item </h1>
                    <div class="container">
				<form class="form-horizontal" action="?do=Update" method="post">
					<input type="hidden" name="itemid" value="<?php echo $itemid;?>">
					<!-- start name field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="name" 
								   class="form-control"  
								   placeholder ="Name of the Item" 
								   autocomplete="off"  
								   value="<?php echo $item['Name']?>"/>
						</div>
					</div>
					<!-- End name field -->
					<!-- start Description field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="Description" 
								   class="form-control"  
								   placeholder ="Description of the Item" 
								   autocomplete="off" 
								   value="<?php echo $item['Description']?>"/>
						</div>
					</div>
					<!-- End Description field -->
					<!-- start Price field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Price</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="Price" 
								   class="form-control"  
								   placeholder ="Price of the Item" 
								   autocomplete="off" 
								   value="<?php echo $item['Price']?>"/>
						</div>
					</div>
					<!-- End Price field -->
					<!-- start Country field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" 
								   name="Country" 
								   class="form-control"  
								   placeholder ="Made in ... " 
								   autocomplete="off" 
								   value="<?php echo $item['Country_Date'] ?>" />
						</div>
					</div>
					<!-- End Country field -->
					<!-- start status field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">status</label>
						<div class="col-sm-10 col-md-4">
							<select name="status" class="form-control">
								<option value="0">...</option>
								<option value="1"<?php  if($item["Status"] == 1) {echo "selected" ;}?> >New</option>
								<option value="2"<?php  if($item["Status"] == 2) {echo "selected" ;}?>>Like New</option>
								<option value="3"<?php  if($item["Status"] == 3) {echo "selected" ;}?>>Used</option>
								<option value="4"<?php  if($item["Status"] == 4) {echo "selected" ;}?>>Very old </option>
							</select>
						</div>
					</div>
					<!-- End status field -->
					<!-- start members field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Members</label>
						<div class="col-sm-10 col-md-4">
							<select name="members" class="form-control">
								<option value="0">...</option>
								<?php 
								$stmt = $con->prepare("SELECT * FROM users");
								$stmt->execute();
								$users = $stmt->fetchAll();
								foreach( $users as $user ) {
									echo "<option value='" . $user['UserID'] . "'";
									if($item["Members_ID"] == $user['UserID']) {echo 'selected' ;}
										echo ">" . $user["Username"] . "</option>";
									}
								
								?>
							</select>
						</div>
					</div>
					<!-- End members field  $cat["ID"] -->
					<!-- start categories field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Gategories</label>
						<div class="col-sm-10 col-md-4">
							<select name="categories" class="form-control">
								<option value="0">...</option>
								<?php 
								$stmt2= $con->prepare("SELECT * FROM categories");
								$stmt2->execute();
								$cats = $stmt2->fetchAll();
								foreach( $cats as $cat ) {
									echo "<option value='".$cat["ID"]."'";
									if($item["Cat_ID"] == $cat["ID"] ) {echo 'selected' ;}
										echo ">".$cat["Name"]."</option>";
								}
								?>
							</select>
						</div>
					</div>
					<!-- End categories field -->
					<!-- start add item -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit"   value="Save Item" class="btn btn-primary btn-lg" placeholder ="Describe the category"  />
						</div>
					</div>
					<!-- End add item  -->
				</form>
			</div> 
			<?php }
				// IF THE ID IS NOT EXIST => CATCH U :D 
				// HELLO READER :P 
				// HOPE TO HAVE FUN WITH MY CODES :) 
				else {
					echo "There is no such ID " ; 
				}
	}elseif($do == "Update"){
					echo "<h1 class ='text-center'> Edit Members </h1>" ;
					echo "<h1 class='container'>";
					if($_SERVER["REQUEST_METHOD"] == "POST" ) {
						// get variables from form
							$id 		= $_POST["itemid"]; 
							$name 		= $_POST["name"];
							$desc 		= $_POST["Description"]; 
							$price 		= $_POST["Price"];
							$country 	= $_POST["Country"];
							$status 	= $_POST["status"];
							$member 	= $_POST["members"];
							$categories	= $_POST["categories"];
							
                   			 // validate the form 
		                    $formErrors = array();
		                    if(empty($name)  ) {
		                    	$formErrors[] = "Name can not be Empty " ; 		
		                    }
		                    if(empty($desc) ) {
		                    	$formErrors[] = "Description can not be Empty" ; 		
		                    }
		                    if(empty($price)){
		                    	$formErrors[] = "price can not be Empty" ;}
		                    if(empty($country)){
		                    	$formErrors[] = "country can not be Empty" ;}
		                    if($status == 0 ){
		                    	$formErrors[] = "you must choose the status" ;}
		                    if(empty($member)){
		                    	$formErrors[] = "members can not be Empty" ;}
					                    	foreach($formErrors as $error ) {
					                    		echo "<div class='alert alert-danger'>" . $error . "</div>" ;
					                    	}
                    	if(empty($formErrors)) {
                    		// update the db with This Info 
								$stmt = $con->prepare("UPDATE items SET Name = ?,Description = ?,Price = ?,Country_Date = ?,Status= ?,Members_ID=?,Cat_ID =? where Item_id = ?"); 
								$stmt->execute(array($name,$desc,$price,$country,$status,$member,$categories,$id)) ;
								//echo  success message  
								$theMSG =  "<div class='alert alert-success'>" . $stmt->rowCount(). " record update </div>"; 
								redirectHome($theMSG,"back", 3);

                    	}
				} else {
					echo "oops somthing wrong with this :("; 
				}
				echo "</div>";

	}elseif($do == "Delete") {
		// Delete Member Page 
					$itemid = isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ? intval($_GET["itemid"]) : 0;
					// select all data depend on id 
					$check = checkItem("Item_id" , "items" , $itemid) ;
					// if id greater than 0 so show the form
					if ($check > 0) {
						$stmt = $con->prepare(" DELETE  FROM items Where Item_id = :zitem ");
						$stmt->bindParam(':zitem', $itemid , PDO::PARAM_STR);
						$stmt->execute();
						$theMSG =  "<div class='alert alert-success'>" . $stmt->rowCount(). " record Deleted </div>"; 
						redirectHome($theMSG , "s" , 3 );

					} else {
						$theMSG =  "<div class='alert alert-danger' > this id can not be found in the database </div>";
						redirectHome($theMSG ,  "back" , 3) ; 
					}
	include $tpl . "footer.php" ;
	}else {
		header("Location: index.php");
		exit();
	}
    }
	ob_end_flush();