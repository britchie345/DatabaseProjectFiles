<?php 
  session_start();
  include "connection.php";
  include "resources/php/print-functions.php";
  include "resources/php/header.php";

  $username = $_POST['username'];
  $password = $_POST['password'];

  echo "state: " . $state;
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
    <div data-role="page" id="signup-page">
      <div class='page-width'>

        <!-- panel -->
          <?php printPanel("signup-panel"); ?>
        <!-- /panel -->

        <?php
          printHeaderTitle("signup","Sign Up");
        ?>

        <article data-role="content">

           <?php

            if (isset($_POST['create']))
            {
              if (empty($_REQUEST['username'])||empty($_REQUEST['password'])||empty($_REQUEST['passwordconfirm'])||empty($_REQUEST['firstname'])||
                empty($_REQUEST['lastname'])||empty($_REQUEST['email'])) 
              {
                echo "<center><font color='red'>please fill out all fields before continuing.</font></center>";
                $username = $_POST['username'];
                $password = $_POST['password'];
                $passwordconfirm = $_POST['passwordconfirm'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
              } 
              else 
              {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $passwordconfirm = $_POST['passwordconfirm'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $street = $_POST['street'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $zip = $_POST['zip'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $dob = $_POST['dob'];

                if ($password == $passwordconfirm) 
                {
                  $queryUsername = "SELECT * FROM LOGIN_INFO WHERE (USERNAME = '$username')";

                  $r1 = mysql_query($queryUsername);

                  $queryEmail = "SELECT * FROM LOGIN_INFO WHERE (EMAIL = '$email')";

                  $r2 = mysql_query($queryEmail);
                  
                  if (mysql_num_rows($r1) != 0)
                  {
                    echo "<center><font color='red'>";
                    echo "username ";
                    if (mysql_num_rows($r2))
                    {
                      echo "and email ";
                    }
                    echo " is already in use, please try again.";
                    echo "</font></center>";
                  }

                  else if (mysql_num_rows($r2) != 0)
                  {
                    echo "<center><font color='red'>";
                    echo "email ";
                    if (mysql_num_rows($r1))
                    {
                      echo "and username ";
                    }
                    echo " is already in use, please try again.";
                    echo "</font></center>";

                  }

                  else
                  {
                    mysql_query("INSERT INTO CUSTOMER (FIRSTNAME, LASTNAME, PHONE, STREET, CITY, STATE, ZIP, DOB, SUBSCRIBED, REWARDS) VALUES ('$firstname', '$lastname','$phone', '$street', '$city', '$state', '$zip', '$dob', 1, 0)");
                    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = last_insert_id()";
                    $r = mysql_query($query);
                    $row = mysql_fetch_array($r);
                    $customer_id = $row['CUSTOMER_ID'];
                    mysql_query("INSERT INTO LOGIN_INFO (CUSTOMER_ID, USERNAME, PASSWORD, EMAIL, ACCESS_LEVEL) VALUES ('$customer_id', '$username', '$password', '$email', 1)");
                    
                    echo "<center>successfully added user.</center>";

                    $_SESSION['customer_id'] = $customer_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['access_level'] = 1;

                    header('Location: http://acadweb1.salisbury.edu/~Restaurant/apptest/my-account.php');
                  } 
                }

                else
                {
                  echo "passwords do not match";
                }
              }
            }

          ?>

                <center>

                  <div id = "form">
                    <div style="padding: 5px;">
                      <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post" data-ajax = "false" id="signup-form">
                        <!-- for same line <div class="ui-field-contain"> </div> -->
                        <div class="">  
                          <label><font color="red">*</font>Email:</label><input type = "email" name = "email" value = "<? echo $email ?>" placeholder = "john@doe.com" data-clear-btn="true">

                          <label><font color="red">*</font>Username:</label><input type = "text" name = "username" value = "<? echo $username ?>" placeholder = "username" data-clear-btn="true">

                          <label><font color="red">*</font>Password:</label><input type = "password" name="password" value = "<? echo $password ?>" placeholder = "password" data-clear-btn="true">
   
                          <label><font color="red">*</font>Confirm Password:</label><input type = "password" name="passwordconfirm" value = "<? echo $passwordconfirm ?>" placeholder = "confirm password" data-clear-btn="true">

                          <label><font color="red">*</font>First Name:</label><input type = "text" name = "firstname" value = "<? echo $firstname ?>" placeholder = "first name" data-clear-btn="true">

                          <label><font color="red">*</font>Last Name:</label><input type = "text" name = "lastname" value = "<? echo $lastname ?>" placeholder = "last name" data-clear-btn="true">

                          <label>Street:</label><input type = "text" name = "street" value = "<? echo $street ?>" placeholder = "street" data-clear-btn="true">
   
                          <label>City:</label><input type = "text" name = "city" value = "<? echo $city ?>" placeholder = "city" data-clear-btn="true">

                          <!-- <label>State:</label><input type = "text" name = "state" value = "<? echo $state ?>" placeholder = "state" data-clear-btn="true"> -->
                          <label>State:</label>
                          <select name="state">
                            <option>state</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                          </select>

                          <label>Zip:</label><input type = "tel" name = "zip" value = "<? echo $zip ?>" placeholder = "zip" data-clear-btn="true">

                          <label>Phone Number:</label><input type = "tel" name = "phone" value = "<? echo $phone ?>" placeholder = "xxxxxxxxxx" data-clear-btn="true">

                          <label>Birthday:</label><input type = "tel" data-role="date" name = "dob" value = "<? echo $dob ?>" placeholder = "yyyy-mm-dd" data-clear-btn="true">

                        </div>
                        
                        <br>
                        <input type = "submit" name = "create" value = "create account" style = "width: 215px; margin-left: 20px;" data-inline="true">

                      </form>
                    </div>

                  </div>

                    <p>items marked with an asterisk must be filled in.<font color="red">*</font></p>

                </center>

        </article>

        <?php
          include "resources/php/footer.php";
          printFooter(1);
        ?>
      </div>

    </div> 
  </body>
</html>