<?php 
			// Error Reporting

			ini_set("display_erroes" , "on") ; 
		    error_reporting(E_ALL);

		    // include connect file 

			 include "admin/connect.php" ;

			 // session 
			 $sessionUser = "" ;  
			 	if(isset($_SESSION["user"])){
						$sessionUser = $_SESSION["user"];
					}
					
			// Routes
			 $tpl = "includes/templates/" ; // template directore 
			 $lang = "includes/languages/" ; // LANG Files
			 $func = "includes/functions/" ; // FUNCTIONS Directory 
			 $css =  "layout/css/"; // css files 
			 $js = "layout/js/" ; // js files  

 			// Include The Important Files 
			 include $func . "functions.php" ;
			 include $lang . "english.php" ; 
			 include $tpl . "header.php" ;   
