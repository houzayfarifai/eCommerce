<?php 

	function lang( $phrase ) {
		static $lang = array(
			"MESSAGE" => "AHLAN" , 
			"ADMIN" => "ADMIN" 
		);
		return $lang[$phrase] ;
	}
	