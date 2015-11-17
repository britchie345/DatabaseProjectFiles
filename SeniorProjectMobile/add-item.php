<?php	
	session_start();
	include "connection.php";
	include "resources/php/print-functions.php";
	include "resources/php/header.php";

	$id = $_POST['item-id'];
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

<!-- ADD ITEM PAGE begin... -->

		<div data-role="page" id="add-item-page" class="main-page">
			<div class='page-width'>

				<!-- panel -->
					<?php printPanel("add-item-panel"); ?>
				<!-- /panel -->

				<?php
					printHeader(2,"add-item");
				?>

				<center>
					<article data-role="content">

						<?php
							$queryType = "SELECT * FROM MENU_ITEM WHERE ITEM_ID = $id";
							if ($r = mysql_query($queryType))
							{
								while ($row = mysql_fetch_array($r))
								{
									echo "<h1>".$row['NAME']."</h1>";
									echo "<form action = index.php#item".$id." method = 'post' data-ajax = 'false'>";
									printOptionTypes($id);
									printSides($id);
									echo"
										<input type = 'hidden' name = 'item-id' value = $id style = 'width: 215px; margin-left: 20px;' data-inline='true'>
										<h3>Add Item to Cart?</h3>
										<input type = 'submit' name = 'add' value = 'Confirm' style = 'width: 215px; margin-left: 20px;' data-inline='true'>";
										//<input type = 'submit' name = 'cancel' value = 'Cancel' style = 'width: 215px; margin-left: 20px;' data-inline='true'>
									echo "</form>";
								}
							}
						?>
				        
					</article>
				</center>

				<?php
					include "resources/php/footer.php";
					printFooter(1);
				?>
			</div>
		</div>

<!-- ADD ITEM PAGE end -->

	</body>
</html>