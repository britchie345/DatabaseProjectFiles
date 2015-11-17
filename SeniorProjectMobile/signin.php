<?php 
  session_start();
  include "connection.php";
  include "resources/php/print-functions.php";
  include "resources/php/header.php";

  $username = $_POST['username'];
  $password = $_POST['password'];

  /*
    if ($username != NULL & $password != NULL & $access_level != NULL)
    {
      $cookie_name1 = "username";

      $cookie_value1 = $username;

      setcookie($cookie_name1, $cookie_value2, time() + (86400 * 30), "/");

      $cookie_name2 = "access_level";

      $cookie_value2 = $access_level;

      setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/");
    }
  */
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

    <!-- SIGN IN PAGE begin... -->
    <div data-role="page" id="signin-page">
      <div class='page-width'>

        <!-- panel -->
          <?php printPanel("signin-panel"); ?>
        <!-- /panel -->

        <?php
          printHeader(1,"signin");
        ?>

        <center>
        <div style="padding: 5px;">
          <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post" data-ajax = "false">
            
            <div class="ui-field-contain">
              <label><center>Username or Email:</center></label><input type="text" name="username" id="username" value="<? echo $username ?>" style="padding">
            </div>
            <div class="ui-field-contain">
              <label><center>Password:</center></label><input type="password" name="password" id="password" value="<? echo $password ?>" autocomplete="off">
            </div>

            <input type = "submit" name = "signin" value = "Sign In" style = "width: 215px; margin-left: 20px;" data-inline="true">

          </form>

        </div>

          <!--
          <a href="testLocalStorage.php" target="_blank">check storage</a>
          <a href="testPass.php" target="_blank">check pass</a>
          -->

        </center>

        <article data-role="content">

          <?php

            if (isset($_POST['signin']))
            {
              if (empty($username) && !empty($password)) 
              {
                echo "<br><center><font color='red'>please fill in a username.</font></center>";
              }

              else if (empty($password) && !empty($username))
              {
                echo "<br><center><font color='red'>please fill in a password.</font</center>";
              }

              else if(empty($username) && empty($password))
              {
                echo "<br><center><font color='red'>please fill in a username and password.</font</center>";
              }
              else
              {
                $query = "SELECT CUSTOMER_ID, USERNAME, PASSWORD, ACCESS_LEVEL, EMAIL FROM LOGIN_INFO WHERE (USERNAME = '$username') OR (EMAIL = '$username')";

                if ($r = mysql_query($query)) 
                {
                  if (mysql_num_rows($r) != 0) 
                  {
                    $row = mysql_fetch_array($r);

                    if ($row['PASSWORD'] == $password)
                    {
                      $customer_id = $row['CUSTOMER_ID'];
                      $email = $row['EMAIL'];

                      $query2 = "SELECT FIRSTNAME, LASTNAME, EMAIL FROM CUSTOMER WHERE CUSTOMER_ID = '$customer_id'";
                      
                      $row2 = mysql_fetch_array(mysql_query($query2));

                      $customer_name = $row2['FIRSTNAME'] . " " . $row2['LASTNAME']; 

                      $access_level = $row['ACCESS_LEVEL'];

                      $_SESSION['name'] = $customer_name;
                      $_SESSION['customer_id'] = $customer_id;
                      $_SESSION['access_level'] = $access_level;
                      $_SESSION['username'] = $username;
                      $_SESSION['password'] = $password;
                      $_SESSION['email'] = $email;

                      //customer access
                      if ($access_level == 1)
                      {
                        //echo "<br><center>in access level 1</center>";
                        
                        header('Location: http://acadweb1.salisbury.edu/~Restaurant/apptest/my-account.php');
                      }

                      else if ($access_level == 2)
                      {
                        //echo "<br><center>in access level 2</center>";
                        
                        header('Location: http://acadweb1.salisbury.edu/~Restaurant/apptest/my-account.php');
                      }
                    }
                    else
                    {
                      print "<br><center><font color='red'>invalid username and/or password. please try again.</font></center>";
                    }
                  } 
                  else
                  {
                    print "<br><center><font color='red'>invalid username and/or password. please try again.</font></center>";
                  }
                }
              } 
            }

          ?> 

        </article>

        <?php
          include "resources/php/footer.php";
          printFooter(1);
        ?>

      </div>

    </div> 
  </body>
</html>