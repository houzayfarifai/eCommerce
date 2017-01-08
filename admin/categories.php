<?php 

	/* 
	===========================================
	== Template Page 
	===========================================
	*/
	ob_start() ; // output Buffering Start 
	session_start() ; 
	$pageTitle = "" ; 
	if( isset($_SESSION["Username"])) {
	include "init.php" ; 
	$do = isset($_GET["do"]) ? $_GET["do"] : "Manage" ;
	if ($do == "Manage") {
		$stmt2 = $con->prepare("SELECT * FROM categories "); 
		$stmt2->execute();
		$cats = $stmt2->fetchAll() ; ?>
		<h1 class = "text-center">Manage Categories </h1>
        <div class="container">
        	<div class="panel panel-default">
        		<div class="panel-heading">Manage Categories</div>
        		<div class="panel-body" > 
        		<?php 
        			foreach($cats as $cat ){
        				echo $cat["Name"] . "< br />" ;
        			}?>
        		</div>
        	</div>
        </div>

<?php 
	}elseif($do == "Add" ){ ?> 

		<h1 class = "text-center"> Add New Category </h1>
                    <div class="container">
				<form class="form-horizontal" action="?do=Insert" method="post">
					
					<!-- start name field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" name="name" class="form-control"  placeholder ="Name OF THE Category" autocomplete="off" required="required" />
						</div>
					</div>
					<!-- End name field -->
					<!-- start Description field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" name="description" class=" form-control" placeholder ="Describe the category" />
						</div>
					</div>
					<!-- End Description field -->
					<!-- start Ordering field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Ordering</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" name="ordering" class=" form-control"  required="required" placeholder ="Number to arrange the categories"/>
						</div>
					</div>
					<!-- End Ordering field -->
					<!-- start email field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label ">visible</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" name="text" class="form-control" autocomplete="off" required="required" placeholder ="Email" />
						</div>
					</div>
					<!-- End email field -->
					<!-- start username field -->
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="Add Member" class="btn btn-primary btn-lg" />
						</div>
					</div>
					<!-- End username field -->
				</form>
			</div>

		
	<?php }elseif($do == "Insert") {
	}elseif($do == "Edit") {

	}elseif($do == "Insert"){ 


	}elseif($do == "Update"){

	}elseif($do == "Delete") {

	}elseif($do == "Activate") {

	}
	include $tpl . "footer.php" ;
	}else {
		header("Location: index.php");
		exit();
	}
	ob_end_flush();
	?>