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
				print "$sideid";
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
		
		print_r($cookie_value2);
		
	}
?>