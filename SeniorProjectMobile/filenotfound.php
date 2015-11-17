<!DOCTYPE html>

<html lang="en">

	<head>
		
		<meta charset="utf-8" />
		<title>RestaurantApp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<link rel="stylesheet" type="text/css" href="resources/css/restaurantapp.css" />
		<link rel="stylesheet" href="resources/themes/test-theme-1.css" />
		<link rel="stylesheet" href="resources/themes/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile.structure-1.4.3.min.css" /> 
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
		<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>	
		<!-- custom js function file -->
		<script src="resources/js/functions.js"></script>

		<style>
	    	<link rel="stylesheet" type="text/css" href="resources/css/restaurantapp.css"/>
	    </style>
		
	</head>

	<body>
<!-- CHECKOUT PAGE begin... -->
		<div data-role="page" id="checkout-page" class="main-page">
			<div class='page-width'>

				<!-- panel -->
					<?php printPanel("filenotfound-panel"); ?>
				<!-- /panel -->

				<header data-role="header" data-position="fixed">
					<div style='max-width: 800px !important; margin: 0 auto !important; position: relative !important; padding-right: 5px;'>
					<!--
						<h1 class="ui-title" role="heading">Home</h1>
					-->
						<div class="ui-btn-left" data-role="controlgroup" data-type="horizontal" style='padding-top: 5px;'>
					    	<a href="signin.php" data-role="button" data-icon="false" style='font-size: 80%; width: auto;' data-ajax='false'>Sign In</a>
					    	<a href="signup.php" data-role="button" data-icon="false" style='font-size: 80%; width: auto;' data-ajax='false'>Sign Up</a>
					    </div>
						
						<a href='#filenotfound-panel' data-icon='bars' data-role='button' data-iconpos='notext' style='float: right; display: inline;'>Dropdown Menu</a>
					</div>
				</header>

				<article data-role="content">

					<center>
						<h1>Warning!</h1>
					</center>

					<center>

						<h1>
						FILE NOT FOUND				
						</h1>

					</center>
					<!--
					<ul data-role="listview" data-inset="true">
					
						<li><a href="#menu-page" data-transition=''><center>Our Menu</center></a></li>
						<li><a href="restaurant-locator.php" data-ajax="false"><center>Restaurant Locator</center></a></li>

					</ul>
					-->

				</article>

				<?php
					include "resources/php/footer.php";
					printFooter(1);
				?>
			</div>
		</div>
<!-- CHECKOUT PAGE end -->
	</body>
</html>