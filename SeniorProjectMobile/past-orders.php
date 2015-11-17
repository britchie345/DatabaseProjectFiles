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
						<h1>Your Order History</h1>
					</center>

					<center>

						<p>

						<?php
							$customer_id = $_SESSION['customer_id'];
							$count = 1;

							$querySaleArchive = "SELECT * FROM SALE_ARCHIVE WHERE USER_ID = $customer_id";
							
							if ($customer_id != NULL)
							{
								if ($r = mysql_query($querySaleArchive))
								{
									while ($row = mysql_fetch_array($r))
									{
										echo "<hr>";
										$sale_id = $row["SALE_ID"];
										$table_num = $row["TABLE_NUM"];
										$date = $row["DATE"];
										$arrive_time = $row["ARRIVE_TIME"];
										echo "<h2>#" . $count . "</h2>";
										echo "<p><strong>sale_id:</strong> " . $sale_id . " | <strong>table:</strong> " . $table_num . " | <strong>date:</strong> " . $date . " | <strong>time:</strong> " . $arrive_time . "</p>";
										$queryOrdersArchive = "SELECT * FROM ORDERS_ARCHIVE WHERE SALE_ID = $sale_id";

										if ($r2 = mysql_query($queryOrdersArchive))
										{
											while ($row2 = mysql_fetch_array($r2))
											{
												$order_id = $row2['ORDER_ID'];
												$item_id = $row2['ITEM_ID'];
												if ($r22 = mysql_query("SELECT * FROM MENU_ITEM WHERE ITEM_ID = $item_id"))
												{
													$row22 = mysql_fetch_array($r22);
													$item_name = $row22['NAME'];
													echo "<h3>" . $item_name . "</h3>";
												}
												$queryOrderOptionsArchive = "SELECT * FROM ORDER_OPTIONS_ARCHIVE WHERE ORDER_ID = $order_id";
												
												if ($r3 = mysql_query($queryOrderOptionsArchive))
												{
													while ($row3 = mysql_fetch_array($r3))
													{
														$option_id = $row3["OPTION_ID"];
														if ($r33 = mysql_query("SELECT * FROM OPTIONS WHERE OPTION_ID = $option_id"))
														{
															$row33 = mysql_fetch_array($r33);
															$option_name = $row33['NAME'];
															echo "<p>- " . $option_name . "</p>";
														}
													}
												}	
											}

											echo "<br>";
										}
										$count = ++$count;	
									}
								}
							}
							else
							{
								echo "<font color=red>please log in or sign up to view past orders</font>";
							}

						?>	
						
						</p>

					</center>

				</article>

				<?php
					printFooter(2);
				?>
			</div>
		</div>
<!-- CHECKOUT PAGE end -->
	</body>
</html>