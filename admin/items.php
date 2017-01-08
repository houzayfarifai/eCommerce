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
		echo "welcome  to Items page" ; 
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
								   autocomplete="off" 
								   required="required" />
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
					<!-- start Description field -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit"   value="Add Item" class="btn btn-primary btn-lg" placeholder ="Describe the category"  />
						</div>
					</div>
					<!-- End Description field -->
				</form>
			</div> 
<?php 	}elseif($do == "Insert") {
	}elseif($do == "Edit") {

	}elseif($do == "Insert"){

	}elseif($do == "Update"){

	}elseif($do == "Delete") {

	}elseif($do == "Approve") {

	}
	include $tpl . "footer.php" ;
	}else {
		header("Location: index.php");
		exit();
	}
	ob_end_flush();
	?>
