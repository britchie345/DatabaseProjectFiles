<?php 
  session_start();
  include "connection.php";
  include "resources/php/print-functions.php";
  include "resources/php/header.php";
  include "verify-access.php";

  $customer_id = $_SESSION['customer_id'];
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
    <script src="resources/js/jquery.maskedinput.js"></script>

    <script type="text/javascript">
      jQuery(function($)
      {
        $("#phone").mask("(999) 999-9999",{placeholder:" "});
        $("#dob").mask("9999 - 99 - 99",{placeholder:" "});
      });
    </script>

    <style>
      <link rel="stylesheet" type="text/css" href="resources/css/restaurantapp.css"/>
    </style>
    
  </head>

  <body>

    <!-- SIGN IN PAGE begin... -->
    <div data-role="page" id="myaccount-page">
      <div class='page-width'>

        <!-- panel -->
          <?php printPanel("myaccount-panel"); ?>
        <!-- /panel -->
        <?php
          printHeader(3,"myaccount");
        ?>

        <?php
        //FOR SEARCHING DATA______________________________________________________________________________________________________________________
          
            $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = '$customer_id'";

            if($r = mysql_query($query))
            {
              $row = mysql_fetch_array($r);

              $firstname = $row['FIRSTNAME'];
              $lastname = $row['LASTNAME'];
              $phone = $row['PHONE'];
              $dob = $row['DOB'];
              $street = $row['STREET'];
              $city = $row['CITY'];
              $state = $row['STATE'];
              $zip = $row['ZIP'];
              $points = $row['REWARDS'];
              $subscribed = $row['SUBSCRIBED'];
            }

            $query = "SELECT * FROM LOGIN_INFO WHERE CUSTOMER_ID = '$customer_id'";

            if($r = mysql_query($query))
            {
              $row = mysql_fetch_array($r);

              $username = $row['USERNAME'];
              $password = $row['PASSWORD'];
              $email = $row['EMAIL']; 
            }

            $query = "SELECT SUBSCRIBED FROM CUSTOMER WHERE CUSTOMER_ID = '$customer_id'";
            $r = mysql_query($query);
            $row = mysql_fetch_assoc($r);
            $subscribed = $row['SUBSCRIBED'];
        
        //FOR UPDATING DATA______________________________________________________________________________________________________________________

          if(isset($_POST['save']))
          { 
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $points = $_POST['points'];
            //$subscribed = $_POST['subscribed'];
            $subscribed2 = $_POST['subscribed2'];
            if ($subscribed2 == ""){$subscribed2 = 0;}

            if (mysql_query("UPDATE CUSTOMER SET FIRSTNAME = '$firstname', LASTNAME = '$lastname', PHONE = '$phone', DOB = '$dob', STREET = '$street', CITY = '$city', STATE = '$state', ZIP = '$zip', SUBSCRIBED = '$subscribed2' WHERE CUSTOMER_ID = '$customer_id'"))
            {
            }
            else
            {
              echo "failed query1";
            }
            if (mysql_query("UPDATE LOGIN_INFO SET EMAIL = '$email', USERNAME = '$username', PASSWORD = '$password' WHERE CUSTOMER_ID = '$customer_id'"))
            {
            }
            else
            {
              echo "failed query2";
            }

            echo "<center><br>information saved.</center>";
          }
      
        ?>


          <article data-role="content">
            <div style="padding: 5px;">
              <div data-role="tabs" id="tabs">
                <div data-role="navbar">
                  <ul>
                    <li><a href="#one" data-ajax="false">account</a></li>
                    <li><a href="#two" data-ajax="false">rewards</a></li>
                    <li><a href="#three" data-ajax="false">favorites</a></li>
                  </ul>
                </div>
                <div id="one" class="ui-body-d ui-content">
                  <h3>Your Account</h3>
                  <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post" data-ajax = "false">
                    <div class  = "" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
                      <h3>Personal</h3>
                      <label>First Name:</label><input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" data-clear-btn="true">
                      <label>Last Name:</label><input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" data-clear-btn="true">
                      <label>Email:</label><input type="email" name="email" id="email" value="<?php echo $email; ?>" data-clear-btn="true">
                      <label>Username:</label><input type="text" name="username" id="username" value="<?php echo $username; ?>" data-clear-btn="true">
                      <label>Phone:</label><input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>" data-clear-btn="true" maxlength="10">
                      <label>Birthday:</label><input type="tel" name="dob" id="dob" value="<?php echo $dob; ?>" data-clear-btn="true">
                    </div>
                    <div class  = "" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
                      <h3>Account</h3>
                      <label>Password:</label><input type="text" name="password" id="password" value="<?php echo $password; ?>" data-clear-btn="true">
                      <label>My Customer ID:</label><input type="text" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>" readonly>
                      <!-- <label>Subscribed:</label><input type="text" name="subscribed" id="subscribed" value="<?php if ($subscribed == 1){ echo 'yes';} else {echo 'no';} ?>" readonly> -->
                      <?php
                      if ($subscribed == 0){echo '<label><input type="checkbox" name="subscribed2" id="subscribed2" value="1">Subscribe?</label>';}
                      else{echo '<label><input type="checkbox" name="subscribed2" id="subscribed2" value="1" checked>Subscribed.</label>';}
                      ?>
                    </div>
                    <div class  = "" data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
                      <h3>Address</h3>
                      <label>Street:</label><input type="text" name="street" id="street" value="<?php echo $street; ?>" data-clear-btn="true">
                      <label>City:</label><input type="text" name="city" id="city" value="<?php echo $city; ?>" data-clear-btn="true">
                      <label>State:</label><input type="text" name="state" id="state" value="<?php echo $state; ?>" data-clear-btn="true" maxlength="2">
                      <label>Zip:</label><input type="tel" name="zip" id="zip" value="<?php echo $zip; ?>" data-clear-btn="true" maxlength="2">
                    </div>
                    <center><input type = "submit" name = "save" value = "save" style = "width: 215px; margin-left: 20px;" data-inline="true"></center>
                  </form>
                </div>
                <div id="two">
                  <h3>Your Rewards</h3>
                  <label>Rewards:</label><input type="text" name="points" id="points" value="<?php echo $points; ?>" readonly>
                  <!--
                  <ul data-role="listview" data-inset="true">
                  </ul>
                  -->
                </div>
                <div id="three">
                  <h3>Your Favorites</h3>
                  <!--
                  <ul data-role="listview" data-inset="true">
                  </ul>
                  -->
                </div>
              </div>
            </div>

          </article>


        <?php
          include "resources/php/footer.php";
          printFooter(1);
        ?>
      </div>
    </div> 
  </body>
</html>