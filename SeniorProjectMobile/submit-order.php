	<?php	
	session_start();
	include "connection.php";
	include "resources/php/print-functions.php";
	include "resources/php/header.php";
	include "resources/php/footer.php";
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
						<h1>Your Order</h1>
					</center>

					<center>

						<p>
						<?php
							if (isset($_POST['confirm']))
							{
								if (!$customer_id)
								{
									echo "<font color=red>please log in!</font>";
								}
								else
								{
									echo "<h2>ORDER PLACED</h2>";
									//timestamp
									$customer_id = $_SESSION["customer_id"];
									$table_num = 1;
									$arrive_time = date("Y-m-d H:i:s");
									$date = date("Y-m-d H:i:s");

									mysql_query("INSERT INTO SALE (USER_ID, TABLE_NUM, DATE, ARRIVE_TIME) VALUES ('$customer_id', '$table_num', '$date', '$arrive_time')");
									$sale_id = mysql_insert_id();
									//populates archive for demo purposes
									mysql_query("INSERT INTO SALE_ARCHIVE (SALE_ID, USER_ID, TABLE_NUM, DATE, ARRIVE_TIME) VALUES ('$sale_id', '$customer_id', '$table_num', '$date', '$arrive_time')");
									

									foreach(unserialize($_COOKIE["cart"]) as $key => $cartItem)
									{
										$queryType = "SELECT * FROM MENU_ITEM WHERE ITEM_ID = $cartItem";
										
										if ($r = mysql_query($queryType))
										{
											while ($row = mysql_fetch_array($r))
											{
												$item_number = $key;
												$item_number = ++$item_number;
												//item
												echo "<ul data-role=listview data-split-icon=delete data-theme=a data-split-theme=b data-inset=true>";
												echo "<li><a><h1>" . $item_number . ". " . $row['NAME'] . "</h1>";
												$index = "option" . $key;

												//orders
												$item_id = $row['ITEM_ID'];
												$request = "REQUEST TEST";
												mysql_query("INSERT INTO ORDERS (SALE_ID, ITEM_ID, REQUEST) VALUES ('$sale_id', '$item_id', '$request')");
												$order_id = mysql_insert_id();
												//populates archive for demo purposes
												mysql_query("INSERT INTO ORDERS_ARCHIVE (ORDER_ID, SALE_ID, ITEM_ID, REQUEST) VALUES ('$order_id', '$sale_id', '$item_id', '$request')");
												

												if (isset($_COOKIE[$index]))
												{
													if (is_array(unserialize($_COOKIE[$index])))
													{
														foreach(unserialize($_COOKIE[$index]) as $key)
														{
															$q = "SELECT * FROM OPTIONS WHERE OPTION_ID = $key";
															if ($r2 = mysql_query($q))
															{
																while ($row2 = mysql_fetch_array($r2))
																{
																	$option_id = $row2['OPTION_ID'];
																	//order_options
																	mysql_query("INSERT INTO ORDER_OPTIONS (ORDER_ID, OPTION_ID) VALUES ('$order_id', '$option_id')");
																	//populates archive for demo purposes
																	mysql_query("INSERT INTO ORDER_OPTIONS_ARCHIVE (ORDER_ID, OPTION_ID) VALUES ('$order_id', '$option_id')");

																	//options
																	echo "<p> - ",$row2['NAME'],"</p>";
																}
															}
														}
													}
												}
												echo "</a></li>";
											}
										}
									}
									//clear cookies after submitting order
									foreach(unserialize($_COOKIE["cart"]) as $key => $cartItem)
									{
										$opIndex = "option".$key."";
										if (isset($_COOKIE[$opIndex]))
										{
											if (is_array(unserialize($_COOKIE[$opIndex])))
											{
												foreach(unserialize($_COOKIE[$opIndex]) as $op)
												{
													unset($_COOKIE[$opIndex]);
													// empty value and expiration one hour before
													$res = setcookie($cookie_name, '', time() - 3600, "/");
												}
											}
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
							}
						?>	
						
						</p>

						<?php

							$cookie_name = "item_count";
							if($_COOKIE[$cookie_name] != NULL)
							{
								echo "
								<form action = '' method = 'post' data-ajax = 'false' id='confirm-order-form'>

									<input type = 'submit' name = 'confirm' value = 'confirm' style = 'width: 215px; margin-left: 20px;' data-inline='true'>

			                    </form>
			                    ";
							}

		                 ?>

					</center>

				</article>

				<?php
					printFooter(2);
				?>
			</div>
		</div>
<!--