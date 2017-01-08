<?php
		ob_start(); 
		session_start() ; 

		$pageTitle = "Dashboard" ; 

		if(isset($_SESSION["Username"])) {

			include "init.php" ;
			


			/* start dashboard page   */

			?>
				<div class="container home-stats text-center">
					<h1> Dashoard </h1>
					<div class="row">
						<div class="col-md-3">
							<div class="stat">Total Members </div>
							<span><?php echo countItems("UserId" , "users" );?></span>
						</div>
						<div class="col-md-3">
							<div class="stat">Pending  Members </div>
							<span>25</span>
						</div>
						<div class="col-md-3">
							<div class="stat">Total Items </div>
							<span>2000</span>
						</div>
						<div class="col-md-3">
							<div class="stat">Total Comments </div>
							<span>3500</span>
						</div>
					</div>

				</div>
				<div class="container latest">
					<div class="row">
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-heading">
								<i class="fa fa-users"></i> Latest Rgistered Users
								</div>
							<div class="panle-body">
							Test 
							</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-heading">
								<i class="fa fa-users"></i> Latest Rgistered Users
								</div>
							<div class="panle-body">
							<?php 

							$theLatest = getlatest("*" , "users" , "UserID" , 4 ) ;
							foreach ($theLatest as $user) {
								echo $user["Username"] . "<br /> " ; 
							}

							?>
							</div>
							</div>
						</div>
					</div>
				</div>


			<?php 





			/* End dashboard page   */ 



			include $tpl . "footer.php";

		} else {

			header("Location : index.php") ; 

			exit;
		}
ob_end_flush();
?>