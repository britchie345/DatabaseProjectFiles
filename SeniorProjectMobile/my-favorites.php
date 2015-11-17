<?php	
	session_start();
	include "connection.php";
	include "resources/php/print-functions.php";
	include "resources/php/header.php";
?>

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
<!-- MY FAVORITES PAGE begin... -->
		<div data-role="page" id="my-favorites-page" class="my-favorites-page">
			<div class='page-width'>

				<!-- panel -->
					<?php printPanel("my-favorites-panel"); ?>
				<!-- /panel -->

				<?php
					printHeader(3,"my-favorites");
				?>

				<article data-role="content">

					<center>
						<h1>My Favorites</h1>
					</center>

					<center>

					</center>

				</article>

				<?php
					include "resources/php/footer.php";
					printFooter(2);
				?>
			</div>
		</div>
<!-- MY FAVORITES PAGE end -->
	</body>
</html>