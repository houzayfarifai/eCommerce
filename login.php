<?php 
	ob_start();
	session_start();
	$pageTitle = "login" ;
			if(isset($_SESSION["user"])) {
			header("Location: index.php");
		} 

	include "init.php" ; 

	if ($_SERVER["REQUEST_METHOD"] == "POST") { 
			if(isset($_POST["login"])) { 
			$user = $_POST["username"]	;
			$pass = $_POST["password"] ;  
			$hashedPass = sha1($pass) ;  
			// CHECK IF THE USER EXIST IN THE DB 
			$stmt = $con->prepare(" SELECT
										 UserID ,  Username , Password 
									FROM 
										users
									WHERE 
									Username = ? 
									AND 
									Password = ? ");
			$stmt->execute(array($user , $hashedPass));
			$get = $stmt->fetch();
			$count = $stmt->rowCount();
			// if count > 0 this mean the db countain record about this Username
			if ($count > 0 ) {
				$_SESSION["user"] = $user ; // Register Session Name 
				$_SESSION["uid"] = $get["UserID"] ; // register user id 
				header("Location: index.php"); // redirect to dashboard
				exit();
			}
		}else {
			$formErrors = array(); 
			// variables 
			$username = $_POST["username"] ; 
			$password = $_POST["password"] ; 
			$password2 = $_POST["password2"] ; 
			$email = $_POST["email"] ; 
			// start checking the form
			if(isset($username )) {
				$filterUser = filter_var($username   , FILTER_SANITIZE_STRING) ;
				echo $filterUser ; 
				if(strlen($filterUser) < 4 ) {
					$formErrors[] = "username can not be less than 4  characters";
				}
			}
			if(isset($password) && isset($password2)) {
				if(empty($password) ) { $formErrors[] = " Tring to be intelignet !" ;}
				$pass1 = sha1($password) ;
				$pass2 = sha1($password2);
				if( $pass1 !== $pass2 ) {
						$formErrors[] = "Password is not match !" ; 
					}
				}
            
				if(isset($email)){
				$filterEmail = filter_var($email  , FILTER_SANITIZE_EMAIL) ;
				 if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true ) {
				 	$formErrors[] = "This is not a valid email" ; 
				 }
				}	// if there is no error start add user 
					        if(empty($formErrors)) {
                    		// check if the username is not the same 
                    		$check = checkItem("Username" , "users" , $username);
							if ($check == 1 ) {
								$formErrors[] = "Sorry this username is exists ";
							} else{ 
                    		// Insert the info to database  
                    			$stmt = $con->prepare("INSERT INTO
                    				 users(Username, Password, Email , RegState  , Date)
                    				 VALUES(:zusers , :zpasses , :zmails  ,  1  , now() )" );
                    			$stmt->execute(array(

                    					"zusers" => $username , 
                    					"zpasses" => sha1($password) , 
                    					"zmails" => $email  

                    				));
								//echo  success message  
								$succesMsg = "Thanks for your Register " ;
							}
                    	}
				if(isset($succesMsg)){
					echo "<div class='msg success' >" . $succesMsg . "</div>" ; 
				}
            }
    }          
?>
<!-- class login-page just  as a father of other classes -->
<div class="container login-page">
<h1 class="text-center"><span class="selected" data-class="login">Login </span>|<span data-class="signup"> Signup</span></h1>
						<!-- start login form -->
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?> " method="POST" >		
		<input class="form-control" type="text" name="username" autocomplete="off" placeholder="type your username"> 
 		<input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="type your password" >
		<!-- btn-primary(blue botton)  btn-block (width) -->
		<input class="btn btn-primary btn-block" name="login" type="submit" value="Login">
	</form>
						<!-- END login form -->
	<!-- start signup form -->
	<form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?> " method="POST" >
		<div class="input-container"><input class="form-control" type="text" name="username" autocomplete="off" placeholder="type your username" pattern=".{4,}" title="username must be more tham 4 characters" required="required"></div>
		<div class="input-container"><input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="type your password" minlength="8" required="required" ></div>
		<div class="input-container"><input class="form-control" type="password" name="password2" autocomplete="new-password" placeholder="re-type your password" required="required"></div>
		<div class="input-container"><input class="form-control" type="email" name="email" placeholder="type a valid email" required="required"></div>
		<!-- btn-success(green botton)  btn-block (width) -->
		<input class="btn btn-success btn-block" name="signup" type="submit" value="Login">
	</form>
	<div class="the_errors text-center msg" >
	<?php if(!empty($formErrors)){
		foreach($formErrors as $error) {
			echo "<div class='alert alert-danger' >" . $error . " </div>" ; 
			
		}
		}  ?> 
	</div>
		<!-- END login form -->
</div>
<?php 
include $tpl . "footer.php" ; 
ob_end_flush();
?>