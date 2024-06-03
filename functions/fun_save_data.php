<?php
//require "fun_read_file.php";
require "fun_get_placement.php";
require "fun_get_properties.php";
require "helpers/fun_adapt_date.php";

# function saveData($raceName, $date){
function saveData($race, $date){
    // if (($raceNameErr == "") and ($dateErr == "") and ($fileToUpload == "") ) {
    if (1 == 1) {

        // save to database
    //    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (1 == 1) {

    //        if(isset($_POST["submit"])) {
            if (1 == 1) {

    /*
            echo $_POST['raceName'];
            echo $_POST['date'];
    */
// get properties:
                $properties = getProperties();

                $serverName = $properties["serverName"];
                $username = $properties["username"];
                $password = $properties["password"];
                $dbName = $properties["dbName"];
/*
                var_dump($race);

                var_dump($date);


                echo $date;

                exit();
*/
                $date = adaptDate($date, "/");

                $raceId = 0;
                $fullName = "";
                $raceDate = "";
                
                $returnedValues = getFile("a", "b");

                $returnedValues = getPlacement($returnedValues);

                // connect to database:
                // Create connection
                $conn = new mysqli($serverName, $username, $password, $dbName);
                
                // Check connection
                if ($conn->connect_error) {

                   die("Connection failed: " . $conn->connect_error);
                } // end if
                echo "Connected successfully <br />";


                // prepare and bind
                $stmt = $conn->prepare("INSERT INTO race (fullName, raceDate) VALUES (?, ?);");
                $stmt->bind_param("ss", $fullName, $raceDate);

                // set parameters and execute
                $fullName = $race;
                $raceDate = $date;
                $stmt->execute();

                echo "New record created successfully";
                $raceLastId = $conn->insert_id;
                
                $stmt->close();
  #              $conn->close();


/*

// prepare and bind
$stmt = $conn->prepare("INSERT INTO race (id, fullName, date) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $id, $fullName, $date);

// set parameters and execute
$firstname = "John";
$lastname = "Doe";
$email = "john@example.com";
$stmt->execute();

echo "New records created successfully";

$stmt->close();

*/

                $tmpLength = count($returnedValues);
                $tmpColLength = count($returnedValues[0]);

                echo "<br />";
                echo "Row length: " . $tmpLength . " Col length: " . $tmpColLength;

                // prepare and bind
                $stmt = $conn->prepare("INSERT INTO Result (fullName, distance, raceTime, placement, raceId) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssii", $fullName, $distance, $raceTime, $placement, $raceId);

// save results in database:
                for ($row = 0; $row < $tmpLength; $row++) {

                    if ($row != 0) {

#                        echo "<p><b>Row number $row</b></p>";

                        // set parameters and execute
                        $fullName = $returnedValues[$row]["fullName"];
                        $distance = $returnedValues[$row]["distance"];
                        $raceTime = $returnedValues[$row]["raceTime"];
                        $placement = $returnedValues[$row]["placement"];
                        $raceId = $raceLastId;
                        $stmt->execute();

 #                       echo "New records created successfully";
                    } // end if

                } // end for

                $stmt->close();
                $conn->close();
            } // end if

        } // end if


    // read data from database:
        header("Location: http://127.0.0.1/race/view.php");
        exit();    
    } // end if

} // end function

# saveData("test 1", date("Y-m-d"));

?>