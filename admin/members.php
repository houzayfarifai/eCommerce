
<?php
		ob_start(); 
		session_start() ; 
		$pageTitle = "Members" ; 
		if(isset($_SESSION["Username"])) {
			include "init.php" ; 
			$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 
			if ($do == "Manage") { //manage page 
					// select all users to edit them
				$stmt = $con->prepare(" SELECT * FROM users Where GroupId != 1 ");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				?> 
				<h1 class="text-center"> Manage Members </h1>
                    <div class="container">
	                    <div class="table-responsive">
							<table class="main-table text-center table table-bordered">
								<tr>	
									<td>#ID</td>
									<td>Username</td>
									<td>Email</td>
									<td>Full Name</td>
									<td>Registerd Date</td>
									<td>Control</td>
								</tr>
								<?php 
									foreach ($rows  as $row) {
										echo "<tr>" ; 
											echo "<td>" . $row["UserID"] . "</td>" ; 
											echo "<td>" . $row["Username"] . "</td>" ; 
											echo "<td>" . $row["Email"] . "</td>" ; 
											echo "<td>" . $row["FullName"] . "</td>" ; 
											echo "<td>"  . $row["Date"] . "</td>" ;
											echo "<td>
													<a href='members.php?do=Edit&userid=" . $row['UserID'] ."'  class='btn btn-success'>Edit </a>
													<a href='members.php?do=Delete&userid=" . $row['UserID'] ."'  class=' confirm btn btn-danger'>Delete </a> 
												</td>";
										echo "</tr>";
									}
								?>
								</tr>
								</table>
	                    </div>
	  					   <a href='members.php?do=Add' class="btn btn-primary"><i class="fa fa-plus"></i> Add New Members</a>
					</div>

			<?php } elseif ($do == "Add") { ?> 

				 <h1 class = "text-center"> Add New Members </h1>
                    <div class="container">
				<form class="form-horizontal" action="?do=Insert" method="post">
					<input type="hidden" name="userid">
					<!-- start username field -->
					<div class="form-group form-group-lg ">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" name="username" class="form-control"  placeholder ="username" autocomplete="off" required="required" />
						</div>
					</div>
					<!-- End username field -->
					<!-- start password field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10 col-md-4">
							<input type="password" name="password" class="passwd form-control" autocomplete="new-password" placeholder ="password" required="required" />
							<i class="show-pass fa fa-eye fa-2x"></i>
						</div>
					</div>
					<!-- End password field -->
					<!-- start Full Name field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Full Name</label>
						<div class="col-sm-10 col-md-4">
							<input type="text" name="full" class=" form-control" autocomplete="off" required="required" placeholder ="fullname"/>
						</div>
					</div>
					<!-- End Full Namee field -->
					<!-- start email field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label ">Email</label>
						<div class="col-sm-10 col-md-4">
							<input type="email" name="email" class="form-control" autocomplete="off" required="required" placeholder ="Email" />
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


			<?php 
				 }	elseif ($do == "Insert") {
				 		// INSERT PAGE
				 	echo "<h1 class ='text-center'> Edit Members </h1>" ;
					echo "<h1 class='container'>";
						if($_SERVER["REQUEST_METHOD"] == "POST" ) {
							// get variables from form
							$user = $_POST["username"];
							$pass = $_POST["password"];
							$email = $_POST["email"]; 
							$name = $_POST["full"];
							$hashedpass = sha1($_POST["password"]);

		                    // validate the form 
		                    $formErrors = array();
		                    if(strlen($user) < 2 ) {
		                    	$formErrors[] = "username can not be less than 2 letters" ; 		
		                    }
		                    if(strlen($user) > 30) {
		                    	$formErrors[] = "username can not be more than 30 letters" ; 		
		                    }
		                    if(empty($user)){
		                    	$formErrors[] = "Username can not be Empty" ;}
		                    if(empty($pass)){
		                    	$formErrors[] = "password can not be Empty" ;}
		                    if(empty($name)){
		                    	$formErrors[] = "Full Name can not be Empty" ;}
		                    if(empty($email)){
		                    	$formErrors[] = "Email can not be Empty" ;}
		                    	foreach($formErrors as $error ) {
		                    		echo "<div class='alert alert-danger'>" . $error . "</div>" ;
		                    	}
		                    	if(empty($formErrors)) {
		                    		// check if the username is not the same 
		                    		$check = checkItem("Username" , "users" , $user);
									if ($check == 1 ) {
										$theMSG =   " <div class='alert alert-danger'> Sorry This User Is Exist</div> " ;
										redirectHome( $theMSG , "back " , 3  ) ;
									} else{ 
		                    		// Insert the info to database  
		                    			$stmt = $con->prepare("INSERT INTO
		                    				 users(Username, Password, Email, FullName , RegState  , Date)
		                    				 VALUES(:zusers , :zpasses , :zmails , :znames ,  1  , now() )" );
		                    			$stmt->execute(array(

		                    					"zusers" => $user , 
		                    					"zpasses" => $hashedpass , 
		                    					"zmails" => $email , 
		                    					"znames" => $name 

		                    				));
										//echo  success message  
										$theMSG = "<div class='alert alert-success'>" . $stmt->rowCount(). " record Insert "; 
										redirectHome( $theMSG , "back" , 2 );
									}
		                    	}
						}else {
							$theMSG = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly</div>";
							redirectHome($theMSG , "back" , 3);

						}
						echo "</div>";

					}
			 	 elseif ($do == "Edit") { // edit page 
			$userid = isset($_GET["userid"]) && is_numeric($_GET["userid"]) ? intval($_GET["userid"]) : 0;
			$stmt = $con->prepare(" SELECT * FROM users where UserID= ?  ");
			$stmt->execute(array($userid));
			$row = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($count = $stmt->rowCount() > 0) { ?>
				<h1 class="text-center"> Edit Members </h1>
				<div class="container">
					<form class="form-horizontal" action="?do=update" method="post">
						<input type="hidden" name="userid" value="<?php echo $userid; ?>">
						<!-- start username field -->
						<div class="form-group form-group-lg ">
							<label class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="username" class="form-control"
									   value="<?php echo $row['Username']; ?>" autocomplete="off" required="required" />
							</div>
						</div>
						<!-- End username field -->
						<!-- start password field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10 col-md-4">
								<input type="hidden" name="oldpassword" value="<?php echo $row['Password']; ?>"/>
								<input type="password" name="newpassword" class="form-control"
									   autocomplete="new-password"/>
							</div>
						</div>
						<!-- End password field -->
						<!-- start Full Name field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Full Name</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="full" class="form-control"
									   value="<?php echo $row['FullName']; ?>" autocomplete="off" required="required"/>
							</div>
						</div>
						<!-- End Full Namee field -->
						<!-- start email field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label ">Email</label>
							<div class="col-sm-10 col-md-4">
								<input type="email" name="email" class="form-control"
									   value="<?php echo $row['Email']; ?>" autocomplete="off" required="required"/>
							</div>
						</div>
						<!-- End email field -->
						<!-- start username field -->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Save" class="btn btn-primary btn-lg"/>
							</div>
						</div>
						<!-- End username field -->
					</form>
				</div>
			<?php }

				else {
					echo "There is no such ID " ; 
				}
                    } elseif ($do == "update") { // update page 
					echo "<h1 class ='text-center'> Edit Members </h1>" ;
					echo "<h1 class='container'>";
					if($_SERVER["REQUEST_METHOD"] == "POST" ) {
						// get variables from form
							$id = $_POST["userid"]; 
							$user = $_POST["username"];
							$email = $_POST["email"]; 
							$name = $_POST["full"];
							// passwd Trick
                    			$pass= empty($_POST["newpassword"]) ? $_POST["oldpassword"] : sha1($_POST["newpassword"]) ; 
                   			 // validate the form 
			                  	 $formErrors = array();
			                    	if(strlen($user) < 2 ) {
					                    	$formErrors[] = "username can not be less than 2 letters" ; 		
					                    }
					                    if(strlen($user) > 30) {
					                    	$formErrors[] = "username can not be more than 30 letters" ; 		
					                    }
					                    if(empty($user)){
					                    	$formErrors[] = "Username can not be Empty" ;}
					                    if(empty($name)){
					                    	$formErrors[] = "Full Name can not be Empty" ;}
					                    if(empty($email)){
					                    	$formErrors[] = "Email can not be Empty" ;}
					                    	foreach($formErrors as $error ) {
					                    		echo "<div class='alert alert-danger'>" . $error . "</div>" ;
					                    	}
                    	if(empty($formErrors)) {
                    		// update the db with This Info 
								$stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ? , Password = ?  where UserID = ?"); 
								$stmt->execute(array($user,$email,$name,$pass, $id)) ;
								//echo  success message  
								$theMSG =  "<div class='alert alert-success'>" . $stmt->rowCount(). " record update </div>"; 
								redirectHome($theMSG,"back", 3);

                    	}
				} else {
					echo "oops somthing wrong with this :("; 
				}
				echo "</div>";
			} elseif($do == "Delete") {
				// Delete Member Page 
					$userid = isset($_GET["userid"]) && is_numeric($_GET["userid"]) ? intval($_GET["userid"]) : 0;
					// select all data depend on id 
					$check = checkItem("userid" , "users" , $userid) ;
					// if id greater than 0 so show the form
					if ($check > 0) {
						$stmt = $con->prepare(" DELETE  FROM users Where UserID = :zusers ");
						$stmt->bindParam(':zusers', $userid , PDO::PARAM_STR);
						$stmt->execute();
						$theMSG =  "<div class='alert alert-success'>" . $stmt->rowCount(). " record Deleted </div>"; 
						redirectHome($theMSG , "s" , 3 );

					} else {
						$theMSG =  "<div class='alert alert-danger' > this id can not be found in the database </div>";
						redirectHome($theMSG ,  "back" , 3) ; 
					}
                        }
			include $tpl . "footer.php";
		} else {
			header("Location : index.php") ; 
                exit; 
            }
            ob_end_flush();
?>