<?php	
	session_start();
	include "connection.php";
	include "resources/php/print-functions.php";
	include "resources/php/header.php";
	include "resources/php/footer.php";

	$id = $_POST['item-id'];
	
	if(count($_COOKIE) > 0) 
	{

	} 
	else 
	{
	    $cookie_name = "item_count";
		$cookie_value = 0;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
	}

	if (isset($_POST['add']))
	{
		$options;
		$sides;
		// Get all the options associated with the item, and see if there are any post
		// fields for that option.
		$query = "SELECT OPTION_TYPE.OPTIONTYPE_ID, DESCRIPTION, REQUIRED, PRICE FROM ITEM_OPTIONS, OPTION_TYPE WHERE ITEM_OPTIONS.OPTIONTYPE_ID = OPTION_TYPE.OPTIONTYPE_ID AND ITEM_OPTIONS.ITEM_ID = $id";
		if ($r = mysql_query($query))
		{	
			while ($row = mysql_fetch_array($r))
			{
				if ($row['REQUIRED'] != 1)
				{
					$query2 = "SELECT OPTIONS.OPTION_ID, NAME, DESCRIPTION FROM OPTIONS, OPTION_GROUPINGS WHERE OPTIONS.OPTION_ID = OPTION_GROUPINGS.OPTION_ID AND OPTIONTYPE_ID = ".$row['OPTIONTYPE_ID'];
					if ($r2 = mysql_query($query2))
					{

						while($optionRow = mysql_fetch_array($r2))
						{
							$opid = "op".$optionRow['OPTION_ID'];
							if (isset($_POST[$opid]))
							{
								$options[] = $optionRow['OPTION_ID'];
							}
						}
					}
				}
				else
				{
					$opid = "op".$row['OPTIONTYPE_ID'];
					if (isset($_POST[$opid]))
					{
						$q = "SELECT OPTION_ID FROM OPTIONS WHERE OPTION_ID = ".$_POST[$opid];
						if ($r2 = mysql_query($q))
						{
							while($optionRow2 = mysql_fetch_array($r2))
							{
								$options[] = $optionRow2['OPTION_ID'];
							}
						}
					}
				}
			}		
		}
		
		// Look at the side types associated with the item
		// and see what has been posted for each. Store as an array to be later
		// assigned to a cookie.
		$query = "SELECT TYPE_TWO FROM TYPE_INCLUDED WHERE TYPE_ONE = (SELECT TYPE_ID FROM ITEM_TYPE WHERE ITEM_ID = $id)";
		if ($r = mysql_query($query))
		{	
			while ($row = mysql_fetch_array($r))
			{
				$sideid = "side".$row['TYPE_TWO'];
				if (isset($_POST[$sideid]))
				{
					// This query is used to make sure that the posted item is a valid ID from the menu
					$validateQuery = "SELECT ITEM_ID FROM MENU_ITEM WHERE ITEM_ID = $_POST[$sideid]";
					if ($testQuery = mysql_query($validateQuery))
					{
						$sides[] = $_POST[$sideid];
					}
				}
			}		
		}

		$cookie_name = "item_count";
		$cookie_name2 = "cart";

		$cookie_value2 = unserialize($_COOKIE[$cookie_name2]);
		$cookie_value2[] = $id;
		
		// Increment the item count cookie once, and then again for each
		// additional side item
		$cookie_value = ++$_COOKIE[$cookie_name];
		$index = count($cookie_value2) - 1;
		
		if (isset($sides))
		{
			foreach ($sides as $sideItem)
			{
				$cookie_value = ++$_COOKIE[$cookie_name];
				$cookie_value2[] = $sideItem;
			}
		}
		
		// Set the item count cookie
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

		// Set the cart cookie. This is the cookie which contains all of the ids of the items in the order
		setcookie($cookie_name2, serialize($cookie_value2), time() + (86400 * 30), "/");
		
		// Create a cookie containing the IDs of all the options for the item
		// The cookie is labelled using the array index of the item, not the item id
		// so that multiple items of the same type will remain distinct
		$cookie_name3 = "option".$index."";
		setcookie($cookie_name3, serialize($options), time() + (86400 * 30), "/");		
	}

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
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<!-- custom js function file -->
		<script src="resources/js/functions.js"></script>
		<script src="js/main.js"></script>
		<script src="js/ajax.js"></script>
		<script>
			/*$( "#optionForm" ).on( "submit", function( event ) {
			event.preventDefault();
			window.alert("Form data: " + $( this ).serialize() );
			});*/
			
			function addItem()
			{
				var item = _("item-id").value;
				var formData = $('#optionForm').serialize();
				window.alert("Form data: " + item);
				
				$.ajax({
					url: "/process-order.php",
					type: "post",
					data: formData
				});				
			}
			
		</script>
		<style>
	    	<link rel="stylesheet" type="text/css" href="resources/css/restaurantapp.css"/>
	    </style>
		
	</head>
	<body>
<!-- HOME PAGE begin... -->
		<div data-role="page" id="home-page" class="main-page">
			<div class="page-width">
				<!-- panel -->
					<?php printPanel("home-panel"); ?>
				<!-- /panel -->

				<?php
					printHeader(3,"home");
				?>

				<article data-role="content">

					<center>
						<img src="resources/images/restaurant_image.png" class="fullscreen" alt="Restaurant" align="middle" width=25% height="auto" style="padding-top: 1em; padding-bottom: 1em;" />
					</center>

				
					<ul data-role="listview" data-inset="true">
					
						<li><a href="#menu-page" data-transition=''><center>Our Menu</center></a></li>
						<li><a href="restaurant-locator.php" data-ajax="false"><center>Restaurant Locator</center></a></li>

					</ul>

				</article>

				<?php
					printFooter(1);
				?>
			</div>
		</div>
<!-- HOME PAGE end -->

<!-- MENU PAGE begin... -->
		<div data-role="page" id="menu-page">
			<div class="page-width">
				<!-- panel -->
					<?php printPanel("menu-panel"); ?>
				<!-- /panel -->
				<?php
					printHeader(2,"menu");
				?>

				<article data-role="content">
					<ul data-role="listview"  data-filter="true" data-inset="true">
					
					<?php
					
						// Only select types where are not a subtype to another type
						$queryType = "SELECT TYPE_ID, NAME FROM TYPE WHERE TYPE_ID NOT IN (SELECT SUBTYPE_ID FROM SUB_TYPE)";
					
						if ($r = mysql_query($queryType))
						{
							$num_rows = mysql_num_rows($r);

							while ($row = mysql_fetch_array($r))
							{
								echo
								"<li>
									<a href=#",$row['NAME']," data-transition=''>
									<h1>",$row['NAME'],"</h1>
									</a>
								</li>";
							}
						}
					?>

					</ul>
				</article>

				<?php
					printFooter(1);
				?>
			</div>
		</div>
<!-- MENU PAGE end -->
		
<!-- TYPE PAGE begin -->

			<?php				
				$queryType = "SELECT TYPE_ID, NAME FROM TYPE";
			
				if ($r = mysql_query($queryType))
				{
					while ($row = mysql_fetch_array($r))
					{
						printType($row['TYPE_ID'], $row['NAME']);
					}
				}
// INDIVIDUAL ITEM PAGE begin..
				$query = "SELECT * FROM MENU_ITEM";

				if ($r2 = mysql_query($query))
				{
					while($row2 = mysql_fetch_array($r2))
					{
						printItem($row, $row2);
					}
				}
// INDIVIDUAL ITEM PAGE end
			?>

<!--TYPE PAGE end -->
		
<!-- ABOUT US PAGE begin... -->
		<div data-role="page" id="aboutus-page">
			<div class="page-width">
				<!-- panel -->
					<?php printPanel("aboutus-panel"); ?>
				<!-- /panel -->
				
				<?php
					printHeader(3,"aboutus");
				?>

				<center>
					<h1>About Us</h1>
					<img src="resources/images/under_construction.png" class="fullscreen" alt="Restaurant" align="middle" width=25% height="auto" style="padding-top: 1em; padding-bottom: 1em;" />
					<h3>Under Construction. Check Back Next Semester! =)</h3>
				</center>

				<?php
					printFooter(1);
				?>
			</div>
		</div>
<!-- ABOUT US PAGE end... -->

<!-- CONTACT PAGE begin... -->
		<div data-role="page" id="contact-page">
			<div class="page-width">
				<!-- panel -->
					<?php printPanel("contact-panel"); ?>
				<!-- /panel -->
				<?php
					printHeader(3,"contact");
				?>

				<center>
					<h1>Contact Us</h1>
					<img src="resources/images/under_construction.png" class="fullscreen" alt="Restaurant" align="middle" width=25% height="auto" style="padding-top: 1em; padding-bottom: 1em;" />
					<h3>Under Construction. Check Back Next Semester! =)</h3>
				</center>

				<?php
					printFooter(1);
				?>
			</div>
		</div>
<!-- CONTACT PAGE end... -->

	</body>
</html>