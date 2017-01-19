<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php  getTitle();?> </title>

		<link rel="stylesheet" href=" <?php echo $css ; ?>bootstrap.min.css" />
		<link rel="stylesheet" href="<?php  echo $css ; ?>font-awesome.min.css" />
		<link rel="stylesheet" href="<?php  echo $css ; ?>jquery-ui.structure.css" />
		<link rel="stylesheet" href="<?php  echo $css ; ?>jquery.selectBoxIt.css" />
		<link rel="stylesheet" href="<?php  echo $css ; ?>front.css" />

	</head>
	<body>
	<!-- Start Navbar  -->
	<div class="upper-bar ">
    <div class="container" >
    <?php
      if(isset($_SESSION["user"])) {   ?>
      <img class="image1 img-thumbnail  img-circle" src="img.png" alt="" />
              <div class="btn-group info">
                  <span class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                       <?php echo $sessionUser?>
                        <span class="caret" ></span>
                  </span>
                  <ul class="dropdown-menu">  
                    <li><a href="profile.php">My Profile</a></li>
                    <li><a href="addnewitem.php">New Item</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </div>
                    <?php 
      } else {
     ?>
		  <a href='login.php' >
        <span class="pull-right"><i class="fa fa-unlock-alt fa-fw"></i> My Acount</span>
      </a>
          <?php  } ?>
    </div>
	</div>
	<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- talking is cheap , show me your codes  -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Homepage</a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav navbar-right">
        <?php
        $allCats = getAllFrom("*" , "categories" , "WHERE Parent = 0" , "ID" , "ASC");
          foreach($allCats as $cat){
            echo '<li><a href="categories.php?pageid='. $cat['ID']. ' ">
            '. $cat['Name'] .' </a></li>'  ;
          }
        ?>
      </ul>
    </div>
  </div>
</nav>
