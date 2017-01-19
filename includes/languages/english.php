<?php 
	function lang( $phrase ) {
		static $lang = array(
			//NAVBER LINKS
			"HOME_ADMIN" 	=> "Home" , 
			"CATEGORIES"	=> "Categories" ,
			"ITEMS" 	    => "Items" , 
			"MEMBERS"		=> "Members" , 
			"STATICS"		=> "Statics" , 
			"LOGS" 			=> "Logs"
		);
		return $lang[$phrase] ;
	}