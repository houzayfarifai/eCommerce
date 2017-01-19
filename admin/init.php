<?php
		     
			 include "connect.php" ;
			 $tpl = "includes/templates/" ; // template directore 
			 $lang = "includes/languages/" ; // LANG Files
			 $func = "includes/functions/" ; // FUNCTIONS Directory 
			 $css =  "layout/css/"; // css files 
			 $js = "layout/js/" ; // js files 
			 

 			// Include The Important Files 
			 include $func . "functions.php" ;
			 include $lang . "english.php" ; 
			 include $tpl . "header.php" ;  

			 //include navbar on all pages expect the one with $nonavbar variable 
			 if(!isset($noNavbar) ) {
			 	include $tpl . "navbar.php" ; 
			 }
			 