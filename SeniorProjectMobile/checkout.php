<?php	
	session_start();
	include "connection.php";
	include "resources/php/print-functions.php";
	include "resources/php/header.php";
	
	// Removes a single item from the cart
	if (isset($_POST['removeItem']))
	{	
		// Unset the cookie containing the options at
		// the current index
		$optionIndex = "option".$_POST['toRemove'];
		setcookie($optionIndex, '', time() - 3600, "/");
		
		$cartItems = unserialize($_COOKIE["cart"]);
		unset($cartItems[$_POST['toRemove']]);
		
		setcookie("cart", serialize($cartItems), time() + (86400 * 30), "/");
		
		$cookie_name = "item_count";
		$cookie_value = --$_COOKIE[$cookie_name];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

		if ($cookie_value == 0)
		{
			foreach(unserialize($_COOKIE["cart"]) as $key => $cartItem)
			{
				$opIndex = "option".$key."";
				foreach(unserialize($_COOKIE[$opIndex]) as $op)
				{
					unset($_COOKIE[$opIndex]);
					// empty value and expiration one hour before
					$res = setcookie($cookie_name, '', time() - 3600, "/");
				}
			}
			$cookie_name = "item_count";
			unset($_COOKIE[$cookie_name]);
			// empty value and expiration one hour before
			$res = setcookie($cookie_name, '', time() - 3600, "/");
			
			$cookie_name2 = "cart";
			unset($_COOKIE[$cookie_name2]);
			$res2 = setcookie("cart",'', time() - 3600, "/");
		}
		
		/* A form submit refreshes the page, but it wasn't executing the php code again for some reason.
		   Without this the cookie updates, but the displayed cart is out of date */
		header("Location: http://acadweb1.salisbury.edu/~Restaurant/apptest/checkout.php");
	}
	if (isset($_POST['removeAll']))
	{	
		foreach(unserialize($_COOKIE["cart"]) as $key => $cartItem)
		{
			$opIndex = "option".$key."";
			foreach(unserialize($_COOKIE[$opIndex]) as $op)
			{
				unset($_COOKIE[$opIndex]);
				// empty value and expiration one hour before
				$res = setcookie($opIndex, '', time() - 3600, "/");
			}
		}

		$cookie_name = "item_count";
		unset($_COOKIE[$cookie_name]);
		// empty value and expiration one hour before
		$res = setcookie($cookie_name, '', time() - 3600, "/");
		
		$cookie_name2 = "cart";
		unset($_COOKIE[$cookie_name2]);
		$res2 = setcookie("cart",'', time() - 3600, "/");
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
					<?php printPanel("checkout-panel"); ?>
				<!-- /panel -->

				<?php
					printHeader(3,"checkout");
				?>

				<article data-role="content">

					<center>
						<h1>Checkout</h1>
					</center>

					<center>

						<p>
						<?php
							$total = 0;
							$cookie_name = "item_count";
							if(!isset($_COOKIE[$cookie_name])) 
							{
							    echo "<h1>Cart is empty!</h1>";
							} 
							else 
							{
							    echo "<h1>Items in cart: " . $_COOKIE[$cookie_name] . "</h1>";
							}

							if (isset($_COOKIE["cart"]))
							{
								// Create a delete option for each item in the cart
								foreach(unserialize($_COOKIE["cart"]) as $key => $cartItem)
								{
									$queryType = "SELECT NAME, PRICE FROM MENU_ITEM WHERE ITEM_ID = $cartItem";
									
									if ($r = mysql_query($queryType))
									{
										$row = mysql_fetch_array($r);
										
										echo 
										"<div data-role='popup' id=remove".$key." data-theme='a' data-overlay-theme='b' class='ui-content' style='max-width:340px; padding-bottom:2em;'>
											<h3>Remove ".$row['NAME']."?</h3>
												<form action = 'checkout.php' method = 'post' data-ajax = 'false'>

												  <center>
													<input type = 'hidden' name = 'toRemove' value = ".$key." style = 'width: 215px; margin-left: 20px;' data-inline='true'>
													<input action = '' type = 'submit' name = 'removeItem' value = 'Remove' style = 'width: 215px; margin-left: 20px;' data-inline='true'>
													<input action = '' type = 'submit' name = 'cancel' value = 'Cancel' style = 'width: 215px; margin-left: 20px;' data-inline='true'>
												  </center>

												</form>
										</div>";	
									}									
								}
								// Display all the items in the cart
								echo "<ul data-role=listview data-split-icon=delete data-theme=a data-split-theme=b data-inset=true>";
								foreach(unserialize($_COOKIE["cart"]) as $key => $cartItem)
								{
									$queryType = "SELECT * FROM MENU_ITEM WHERE ITEM_ID = $cartItem";
								
									if ($r = mysql_query($queryType))
									{
										while ($row = mysql_fetch_array($r))
										{
											echo"<li>
											<a href='index.php#item".$row['ITEM_ID']."' data-ajax='false'>
											<h1>",$row['NAME'],"</h1>
											<p><strong>$",$row['PRICE'],"</strong></p>";
											$opIndex = "option".$key."";
											if (isset($_COOKIE[$opIndex]))
											{
												if (is_array(unserialize($_COOKIE[$opIndex])))
												{
													foreach(unserialize($_COOKIE[$opIndex]) as $op)
													{
														$q = "SELECT NAME FROM OPTIONS WHERE OPTION_ID = $op";
														if ($r2 = mysql_query($q))
														{
															while ($row2 = mysql_fetch_array($r2))
															{
																echo "<p>- ",$row2['NAME'],"</p>";
															}
														}
													}	
												}
											}
											echo"</a><a href=#remove".$key." data-rel=popup data-position-to=window data-transition=pop>Remove Item</a>
											</li>";
											//echo "<h1 style='display: inline-block;'>Item: " . $row['NAME'] . "&nbsp;</h1><p style='display: inline-block;'>[Price: $" . $row['PRICE'] . "]<p>";
											$total = $total + $row['PRICE'];
										}
									}
								}
								echo "</ul>";
							}

							echo "<h2>Total: " . $total . "</h2>";

						?>	
						
						</p>

						<?php
							$cookie_name = "item_count";
							if($_COOKIE[$cookie_name] != NULL)
							{
								echo "
								<form action = '' method = 'post' data-ajax = 'false' id='confirm-order-form'>

									<input type = 'submit' name = 'removeAll' value = 'Empty Cart' style = 'width: 215px; margin-left: 20px;' data-inline='true'>

		                    	</form>
		                    	";
							}
                    	?>

					</center>

				</article>

				<?php
					include "resources/php/footer.php";
					printFooter(2);
				?>
			</div>
		</div>
<!-- CHECKOUT PAGE end -->
	</body>
</html>