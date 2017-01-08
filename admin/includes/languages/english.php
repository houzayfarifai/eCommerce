<?php 
	function lang( $phrase ) {
		static $lang = array(
			//NAVBER LINKS
			"HOME_ADMIN" 	=> "Admin Area" , 
			"CATEGORIES"	=> "Sections" ,
			"ITEMS" 	    => "Items" , 
			"MEMBERS"		=> "Members" , 
			"STATICS"		=> "Statics" , 
			"LOGS" 			=> "Logs"
		);
		return $lang[$phrase] ;
	}