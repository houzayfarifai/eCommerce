<?php
	ob_start();
	session_start();
	$pageTitle = 'Add New Item';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['UserID'];
		if($_SERVER["REQUEST_METHOD"] == "POST") {
                $formErrors = array(); 
                    $name 		= filter_var($_POST["name"] , FILTER_SANITIZE_STRING);
                    $desc 		= filter_var($_POST["Description"] , FILTER_SANITIZE_STRING);
                    $price 		= filter_var($_POST["Price"],FILTER_SANITIZE_NUMBER_INT);
                    $country 	= filter_var($_POST["Country"],FILTER_SANITIZE_STRING);
                    $status 	= filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT);
                    $category 	= filter_var($_POST["categories"],FILTER_SANITIZE_NUMBER_INT);
                if(strlen($name) < 4 ) {
                    $formErrors[] = "Item name can not be less than 4 characters" ; 
                }  
                if(strlen($desc) < 4) {
                    $formErrors[] = "description can not be less than 10 characters" ; 
                }
                if(strlen($country) < 3) {
                    $formErrors[] = "country name can not be less than 4 characters" ; 
                }
                if(strlen($price)== 0 ) {
                    $formErrors[] = "Item Price can not be empty" ; 
                }
                if(strlen($status) == 0 ) {
                    $formErrors[] = "you have to choose a status" ; 
                }
                if(strlen($category) == 0 ) {
                    $formErrors[] = "you have to choose a category" ; 
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
		                    					"zcat"		=> $category , 
		                    					"zmember"	=> $_SESSION["uid"] ));
										//echo  success message  
										if($stmt) {$successMsg = "Item Added"  ; }	
						}
    }
?>
<h1 class="text-center"><?php echo $pageTitle ?></h1>
<div class="create-ad block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo $pageTitle ?></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8">
						<form class="form-horizontal main-form" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
					<!-- start name field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-3 control-label">Name</label>
						<div class="col-sm-10 col-md-9">
							<input type="text" 
								   name="name" 
								   class="form-control live-name"  
								   placeholder ="Name of the Item" 
								   pattern=".{4,}" 
								   title="name must be more than 4 characters"
								   required="required" 
								   autocomplete="off"  />
						</div>
					</div>
					<!-- End name field -->
					<!-- start Description field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-3 control-label">Description</label>
						<div class="col-sm-10 col-md-9">
							<input type="text" 
								   name="Description" 
								   class="form-control live-desc"  
								   placeholder ="Description of the Item"
								   pattern=".{4,30}" 
								   title="Description must be more than 4 characters nad less than 30 characters" 
								   required="required"
								   autocomplete="off" />
						</div>
					</div>
					<!-- End Description field -->
					<!-- start Price field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-3 control-label">Price</label>
						<div class="col-sm-10 col-md-9">
							<input type="text" 
								   name="Price" 
								   class="form-control live-price"  
								   placeholder ="Price of the Item" 
								   required="required"
								   autocomplete="off" />
						</div>
					</div>
					<!-- End Price field -->
					<!-- start Country field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-3 control-label">Country</label>
						<div class="col-sm-10 col-md-9">
							<input type="text" 
								   name="Country" 
								   class="form-control"  
								   placeholder ="Made in ... " 
								   required="required"
								    pattern=".{3,}" 
								   title="Country must be more than 3 characters " 
								   autocomplete="off" />
						</div>
					</div>
					<!-- End Country field -->
					<!-- start status field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-3 control-label">status</label>
						<div class="col-sm-10 col-md-9">
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
					<!-- start categories field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-3 control-label">Gategories</label>
						<div class="col-sm-10 col-md-9 ">
							<select name="categories">
								<option value="0">...</option>
								<?php 
								// fetch data from categories table
								$cats = getAllFrom("*", "categories" , " " , "ID" , $ordering = "ASC" );
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
						<div class="col-sm-offset-3 col-sm-9">
							<input type="submit" value="Add Item" class="btn btn-primary btn-lg" placeholder ="Describe the category"  />
						</div>
					</div>
					<!-- End add item  -->
				</form>
					</div>
					<div class="col-md-4">
						<div class="thumbnail item-box 	live-preview">
								<span class="price-tag">
									$<span class="live-price">0</span>
								</span>
								<img class="img-responsive" src="img.png" alt="" />
								<div class="caption">
									<h3>Title</h3>
									<p>Description</p>
							</div>
							</div>
						</div>
						</div>
					
				 <!-- start looping error -->
					
					<?php
						if(!empty($formErrors)) {
							foreach( $formErrors as $error) {
								echo '<div class="alert alert-danger">' . $error . ' </div>'  ; 
							}
						}
						if(isset($successMsg)) {
							echo '<div class="alert alert-success">' . $successMsg .  '</div>' ;
						}

					?>

				 <!-- end looping errors -->
			</div> 
		</div>
	</div>
</div>
<?php
	} else {
		header('Location: login.php');
		exit();
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>