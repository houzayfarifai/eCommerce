<?php 


	function getTitle() {
		global $pageTitle ; 
		if(isset($pageTitle)) {
			echo $pageTitle ; 
		}
		else {
			echo "Default" ; 
		}
	}
// ==============================================================================================

// ==============================================================================================
			/* 
			**	Redirect Page 
			**	$theMSG = ECHO THE ERROR MESSAGE
			** 	$seconds = Seconds Before Rediracting
            */
				function redirectHome( $theMSG , $url = null , $seconds ) {
            	if( $url === null ) {
            		$url= "index.php"  ;
            		$link = "Homepage" ;
            	}else {
            		if (isset( $_SERVER["HTTP_REFERER"] ) && $_SERVER["HTTP_REFERER"] !== "" ) {
            			$url = $_SERVER["HTTP_REFERER"];
            			$link = "Previous Page" ;
            		}else {
            			$url = "index.php" ;
            			$link = "Homepage" ;

            		}
            	}
            	echo $theMSG;
            	echo "<div class='alert alert-info'> You Will Be Redirected to $link After $seconds Seconds </div>";
            	header("refresh:$seconds;url=$url");
            	exit;
            }



            function checkItem($select , $from , $value) {
            	global $con ; 
            	$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

            	$statement->execute(array($value));

            	$count = $statement->rowCount();

            	return $count ;
            }
            /*
            ** COUNT NUMBER OF ITEMS FUNCTION V1.0 
            **FUNCTION TO COUNT NUMBER OF ITEMS ROWS
            **$item = THE ITEM TO COUNT 
            **$table = THE TABLE TO CHOOSE FROM
            */
            function countItems($item , $table ) {
            global $con ; 
            $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
            $stmt2->execute();
            return $stmt2->fetchColumn();
            }
            /* 
            **GET LATEST RECORDS FUNCTION V1.0
            **FUNCTION TO GET LATEST ITEMS FROM DATABASE 
            **$select = Field to select 
            **$table = the table to choose from
            **$limit
            */
            function getlatest($select , $table , $order  , $limit = 5) {
                  global $con ; 
                  $stmt = $con->prepare("SELECT * FROM users ORDER BY $order desc LIMIT 5 ");
                  $stmt->execute();
                  $rows = $stmt->fetchAll();
                  return $rows ; 
            }