<?php
    session_start();
    include "connection.php";

    /*
        EXTREMELY HARD CODED XD
    */

    function rand_date($min_date, $max_date) 
    {
        $min_epoch = strtotime($min_date);
        $max_epoch = strtotime($max_date);

        $rand_epoch = rand($min_epoch, $max_epoch);

        return date('Y-m-d H:i:s', $rand_epoch);
    }

    function generateRandomString($length = 4) 
    {
        //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '1234abcd';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $numOfSales = 1;
    echo "creating " . $numOfSales . " sales!<br>"; 
    for ($i = 0; $i < $numOfSales; $i++)
    {
        //randomUserId
        $randomUserIdNumber = rand(200000000, 200000200);
        $userId = $randomUserIdNumber;
        //echo "userId: " . $userId . " - (200000000-200001000)<br>";

        //randomTableNum
        $randomTableNumNumber = rand(1, 99);
        $tableNum = $randomTableNumNumber;
        //echo "tableNum: " . $tableNum . " - (1-99)<br>";

        //Min and Max Date for Orders
        $min_date = "2012-01-01 12:00";
        $max_date = "2015-02-01 12:00";
        $saleDate = rand_date($min_date, $max_date);
        //echo "saleDate: " . $saleDate . "<br>";

        //serveTime
        $serveTime = NULL;
        //echo "serveTime: " . $serveTime . "<br>";

        //ifApp
        $ifApp = 0;
        //echo "ifApp: " . $ifApp . "<br>";

        //ifCarry
        $ifCarry = 0;
        //echo "ifCarry: " . $ifCarry . "<br>";

        $populateSales = "INSERT INTO SALE (USER_ID, TABLE_NUM, DATE, ARRIVE_TIME) VALUES ('$userId', '$tableNum', '$saleDate', '$saleDate')";

        $query = mysql_query($populateSales);
        if ($query === TRUE) 
        {
            $sale_id = mysql_insert_id();
            echo "sale_id: " . $sale_id;
            $populateSalesArchive = "INSERT INTO SALE_ARCHIVE (SALE_ID, USER_ID, TABLE_NUM, DATE, ARRIVE_TIME) VALUES ('$sale_id', '$userId', '$tableNum', '$saleDate', '$saleDate')";
            $query = mysql_query($populateSalesArchive);
            if ($query == TRUE)
            {
                $deleteSales = "DELETE FROM SALE WHERE SALE_ID = '$sale_id' LIMIT 1";
                $query = mysql_query($deleteSales);
                if ($query == TRUE)
                {
                    echo "<h3>successfully added one record to SALE_ARCHIVE OK :) </h3>";
                }
            }
        } 
        else 
        {
            echo "<h3>unsuccessfully added one record to SALE_ARCHIVE :(:(:( </h3>"; 
        }

        //people per sale?
        $peopleAmount = rand(1, 4);
        echo "peopleAmount: " . $peopleAmount . "<br>";

        $numOfOrders = 0;

        echo "-------------------------<br><br>";
        for ($i = 0; $i < $peopleAmount; $i++)
        {
            $item1 = -1;
            $item2 = -1;
            $item3 = -1;
            $item4 = -1;
            $item5 = -1;
            $item6 = -1;
            $item7 = -1;
            $item8 = -1;
            $item9 = -1;
            $item10 = -1;

            $numOfOrdersPerCustomer = 0;
            echo "<b>Customer " . $i . "</b><br>";
            //beverage or alcohol? 0 beverage, 1 alcohol
            $beverageAlcohol = rand(0, 1);
            //echo "appetizerAmount: " . $beverageAlcohol . "<br>";
            if ($beverageAlcohol == 1) 
            {
                //echo "got alcohol - ";
                //alcohol
                $alcoholItemArray = array(120, 121, 122, 123, 124);
                $sizeOfAlcoholItemArray = sizeof($alcoholItemArray);
                $randomAlcoholNumber = rand(0, $sizeOfAlcoholItemArray - 1);
                $alcoholId = $alcoholItemArray[$randomAlcoholNumber];
                //echo "alcoholId: " . $alcoholId . " - (120-124)<br>";
                $numOfOrdersPerCustomer++;
                $item1 = $alcoholId;
            }
            else 
            {
                //echo "got a beverage - ";
                //beverages
                $beverageItemArray = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
                $sizeOfBeverageItemArray = sizeof($beverageItemArray);
                $randomBeverageNumber = rand(0, $sizeOfBeverageItemArray - 1);
                $beverageId = $beverageItemArray[$randomBeverageNumber];
                //echo "beverageId: " . $beverageId . " - (0-11)<br>";
                $numOfOrdersPerCustomer++;
                $item1 = $beverageId;
            }
            //appetizer? 0 no, 1 yes
            $appetizerAmount = rand(0, 3);
            //echo "appetizerAmount: " . $appetizerAmount . "<br>";
            if ($appetizerAmount == 1) 
            {
                //echo "got an appetizer - ";
                //appetizers
                $appetizerItemArray = array(20, 21, 22, 23, 24, 25, 26, 27);
                $sizeOfAppetizerItemArray = sizeof($appetizerItemArray);
                $randomAppetizerNumber = rand(0, $sizeOfAppetizerItemArray - 1);
                $appetizerId = $appetizerItemArray[$randomAppetizerNumber];
                //echo "appetizerId: " . $appetizerId . " - (20-27)<br>";
                $numOfOrdersPerCustomer++;
                $item2 = $appetizerId;
            }
            //else {echo "did not get an appetizer<br>";}

            //lunch or dinner? 0 lunch, 1 dinner
            $lunchOrDinner = rand(0, 1);
            //echo "lunchOrDinner: " . $lunchOrDinner . "<br>";
            if ($lunchOrDinner == 0) 
            {
                //echo "<b>got lunch</b><br>";
                //lunch: soupSalad? 0 soup, 1 salad
                $soupSalad = rand(0, 1);
                //echo "appetizerAmount: " . $appetizerAmount . "<br>";
                if ($soupSalad == 1) 
                {
                    //echo "got a salad - ";
                    //salads
                    $saladItemArray = array(30, 31, 32, 33, 34, 35, 36, 37);
                    $sizeOfSaladItemArray = sizeof($saladItemArray);
                    $randomSaladNumber = rand(0, $sizeOfSaladItemArray - 1);
                    $saladId = $saladItemArray[$randomSaladNumber];
                    //echo "saladId: " . $saladId . " - (30-37)<br>";
                    $numOfOrdersPerCustomer++;
                    $item3 = $saladId;
                }
                else 
                {
                    //echo "got a soup - ";
                    //soups
                    $soupItemArray = array(40, 41, 42, 43, 44);
                    $sizeOfSoupItemArray = sizeof($soupItemArray);
                    $randomSoupNumber = rand(0, $sizeOfSoupItemArray - 1);
                    $soupId = $soupItemArray[$randomSoupNumber];
                    //echo "soupId: " . $soupId . " - (40-44)<br>";
                    $numOfOrdersPerCustomer++;
                    $item3 = $soupId;
                }

                //lunch: sandwhich or burger? 0 sandwhich, 1 burger
                $sandBurger == rand(0, 1);
                //echo "sandBurger: " . $sandBurger . "<br>";
                if ($sandBurger == 1) 
                {
                    //echo "got a burger - ";
                    //sandwiches, burgers
                    $sandwichItemArray = array(50, 51, 52, 60, 61);
                    $sizeOfSandwichItemArray = sizeof($sandwichItemArray);
                    $randomSandwichNumber = rand(0, $sizeOfSandwichItemArray - 1);
                    $sandwichId = $sandwichItemArray[$randomSandwichNumber];
                    //echo "burgerId: " . $sandwichId . " - (50-61)<br>";
                    $numOfOrdersPerCustomer++;
                    $item4 = $sandwichId;
                }
                else 
                {
                    //echo "got a sandwhich - ";
                    //sandwiches, burgers
                    $sandwichItemArray = array(50, 51, 52, 60, 61);
                    $sizeOfSandwichItemArray = sizeof($sandwichItemArray);
                    $randomSandwichNumber = rand(0, $sizeOfSandwichItemArray - 1);
                    $sandwichId = $sandwichItemArray[$randomSandwichNumber];
                    //echo "sandwichId: " . $sandwichId . " - (50-61)<br>";
                    $numOfOrdersPerCustomer++;
                    $item4 = $sandwichId;
                }
            }
            else 
            {
                //echo "<b>got dinner</b> - ";
                //entrees
                $entreeItemArray = array(70, 71, 72, 73, 80, 81, 90, 91, 100, 101);
                $sizeOfEntreeItemArray = sizeof($entreeItemArray);
                $randomEntreeNumber = rand(0, $sizeOfEntreeItemArray - 1);
                $entreeId = $entreeItemArray[$randomEntreeNumber];
                //echo "entreeId: " . $entreeId . " - (70-101)<br>";
                $numOfOrdersPerCustomer++;
                $item5 = $entreeId;

                //dinner: dessert? 0 no, 1 yes
                $dessertAmount = rand(0, 3);
                //echo "dessertAmount: " . $dessertAmount . "<br>";
                if ($dessertAmount == 1) 
                {
                    //echo "got dessert - ";
                    //desserts
                    $dessertItemArray = array(110);
                    $sizeOfDessertItemArray = sizeof($dessertItemArray);
                    $randomDessertNumber = rand(0, $sizeOfDessertItemArray - 1);
                    $dessertId = $dessertItemArray[$randomDessertNumber];
                    echo "dessertId: " . $dessertId . " - (110-110)<br>";
                    $numOfOrdersPerCustomer++;
                    $item6 = $dessertId;
                }
                //else {echo "did not get dessert<br>";}
            }
            //query for adding orders

            //beverage
            if ($item1 != -1)
            {
                echo "beverage: " . $item1 . "<br>";

                $populateOrders = "INSERT INTO ORDERS (SALE_ID, ITEM_ID) VALUES ('$sale_id', '$item1')";

                $query = mysql_query($populateOrders);
                if ($query === TRUE) 
                {
                    $order_id = mysql_insert_id();
                    echo "order_id: " . $order_id;
                    $populateOrdersArchive = "INSERT INTO ORDERS_ARCHIVE (ORDER_ID, SALE_ID, ITEM_ID) VALUES ('$order_id', '$sale_id', '$item1')";
                    $query = mysql_query($populateOrdersArchive);
                    if ($query == TRUE)
                    {
                        $deleteOrders = "DELETE FROM ORDERS WHERE ORDER_ID = '$order_id' LIMIT 1";
                        $query = mysql_query($deleteOrders);
                        if ($query == TRUE)
                        {
                            //echo "<h3>successfully added one record to ORDERS_ARCHIVE OK :) </h3>";
                        }
                    }
                } 
                else 
                {
                    echo "<h3>unsuccessfully added one record to ORDERS_ARCHIVE :(:(:( </h3>"; 
                }
            }
            //appetizer
            if ($item2 != -1)
            {
                echo "appetizer: " . $item2 . "<br>";

                $populateOrders = "INSERT INTO ORDERS (SALE_ID, ITEM_ID) VALUES ('$sale_id', '$item2')";

                $query = mysql_query($populateOrders);
                if ($query === TRUE) 
                {
                    $order_id = mysql_insert_id();
                    echo "order_id: " . $order_id;
                    $populateOrdersArchive = "INSERT INTO ORDERS_ARCHIVE (ORDER_ID, SALE_ID, ITEM_ID) VALUES ('$order_id', '$sale_id', '$item2')";
                    $query = mysql_query($populateOrdersArchive);
                    if ($query == TRUE)
                    {
                        $deleteOrders = "DELETE FROM ORDERS WHERE ORDER_ID = '$order_id' LIMIT 1";
                        $query = mysql_query($deleteOrders);
                        if ($query == TRUE)
                        {
                            //echo "<h3>successfully added one record to ORDERS_ARCHIVE OK :) </h3>";
                        }
                    }
                } 
                else 
                {
                    echo "<h3>unsuccessfully added one record to ORDERS_ARCHIVE :(:(:( </h3>"; 
                }
            }
            //soup & salad
            if ($item3 != -1)
            {
                echo "soup or salad: " . $item3 . "<br>";

                $populateOrders = "INSERT INTO ORDERS (SALE_ID, ITEM_ID) VALUES ('$sale_id', '$item3')";

                $query = mysql_query($populateOrders);
                if ($query === TRUE) 
                {
                    $order_id = mysql_insert_id();
                    echo "order_id: " . $order_id;
                    $populateOrdersArchive = "INSERT INTO ORDERS_ARCHIVE (ORDER_ID, SALE_ID, ITEM_ID) VALUES ('$order_id', '$sale_id', '$item3')";
                    $query = mysql_query($populateOrdersArchive);
                    if ($query == TRUE)
                    {
                        $deleteOrders = "DELETE FROM ORDERS WHERE ORDER_ID = '$order_id' LIMIT 1";
                        $query = mysql_query($deleteOrders);
                        if ($query == TRUE)
                        {
                            //echo "<h3>successfully added one record to ORDERS_ARCHIVE OK :) </h3>";
                        }
                    }
                } 
                else 
                {
                    echo "<h3>unsuccessfully added one record to ORDERS_ARCHIVE :(:(:( </h3>"; 
                }
            }
            if ($item4 != -1)
            {   
                echo "sandwhich or burger: " . $item4 . "<br>";

                $populateOrders = "INSERT INTO ORDERS (SALE_ID, ITEM_ID) VALUES ('$sale_id', '$item4')";

                $query = mysql_query($populateOrders);
                if ($query === TRUE) 
                {
                    $order_id = mysql_insert_id();
                    echo "order_id: " . $order_id;
                    $populateOrdersArchive = "INSERT INTO ORDERS_ARCHIVE (ORDER_ID, SALE_ID, ITEM_ID) VALUES ('$order_id', '$sale_id', '$item4')";
                    $query = mysql_query($populateOrdersArchive);
                    if ($query == TRUE)
                    {
                        $deleteOrders = "DELETE FROM ORDERS WHERE ORDER_ID = '$order_id' LIMIT 1";
                        $query = mysql_query($deleteOrders);
                        if ($query == TRUE)
                        {
                            //echo "<h3>successfully added one record to ORDERS_ARCHIVE OK :) </h3>";
                        }
                    }
                } 
                else 
                {
                    echo "<h3>unsuccessfully added one record to ORDERS_ARCHIVE :(:(:( </h3>"; 
                }
            }
            if ($item5 != -1)
            {
                echo "entree: " . $item5 . "<br>";

                $populateOrders = "INSERT INTO ORDERS (SALE_ID, ITEM_ID) VALUES ('$sale_id', '$item5')";

                $query = mysql_query($populateOrders);
                if ($query === TRUE) 
                {
                    $order_id = mysql_insert_id();
                    echo "order_id: " . $order_id;
                    $populateOrdersArchive = "INSERT INTO ORDERS_ARCHIVE (ORDER_ID, SALE_ID, ITEM_ID) VALUES ('$order_id', '$sale_id', '$item5')";
                    $query = mysql_query($populateOrdersArchive);
                    if ($query == TRUE)
                    {
                        $deleteOrders = "DELETE FROM ORDERS WHERE ORDER_ID = '$order_id' LIMIT 1";
                        $query = mysql_query($deleteOrders);
                        if ($query == TRUE)
                        {
                            //echo "<h3>successfully added one record to ORDERS_ARCHIVE OK :) </h3>";
                        }
                    }
                } 
                else 
                {
                    echo "<h3>unsuccessfully added one record to ORDERS_ARCHIVE :(:(:( </h3>"; 
                }
            }
            if ($item6 != -1)
            {
                echo "dessert: " . $item6 . "<br>";

                $populateOrders = "INSERT INTO ORDERS (SALE_ID, ITEM_ID) VALUES ('$sale_id', '$item6')";

                $query = mysql_query($populateOrders);
                if ($query === TRUE) 
                {
                    $order_id = mysql_insert_id();
                    echo "order_id: " . $order_id;
                    $populateOrdersArchive = "INSERT INTO ORDERS_ARCHIVE (ORDER_ID, SALE_ID, ITEM_ID) VALUES ('$order_id', '$sale_id', '$item6')";
                    $query = mysql_query($populateOrdersArchive);
                    if ($query == TRUE)
                    {
                        $deleteOrders = "DELETE FROM ORDERS WHERE ORDER_ID = '$order_id' LIMIT 1";
                        $query = mysql_query($deleteOrders);
                        if ($query == TRUE)
                        {
                            //echo "<h3>successfully added one record to ORDERS_ARCHIVE OK :) </h3>";
                        }
                    }
                } 
                else 
                {
                    echo "<h3>unsuccessfully added one record to ORDERS_ARCHIVE :(:(:( </h3>"; 
                }
            }

            echo "numOfOrdersPerCustomer: " . $numOfOrdersPerCustomer . "<br>";
            $numOfOrders = $numOfOrders + $numOfOrdersPerCustomer;
            echo "<br>";
        }
        echo "-------------------------<br>";
        echo "numOfOrders: " . $numOfOrders;
    }
?>