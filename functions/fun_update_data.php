<?php
require "fun_get_properties.php";
require "helpers/fun_adapt_date.php";
require "fun_get_placement.php";

function updateData($dataArr, $flag) {


    echo "I'm in the update function.";
    echo "<br />";

    $properties = getProperties();

    $serverName = $properties["serverName"];
    $username = $properties["username"];
    $password = $properties["password"];
    $dbName = $properties["dbName"];

    $race = [];
    $results = [];
    $resultArr = [];
    // Create connection
    $conn = new mysqli($serverName, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);
    } // end if
    echo "Connected successfully <br />";
    

    if ($flag == "race") {
        // prepare and bind
        // $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
        $date02 = adaptDate($dataArr["raceDate"],"/");

        $stmt = $conn->prepare(" UPDATE Race SET fullName = ?, raceDate = ? WHERE id = ? ");
        $stmt->bind_param("ssi", $fullName, $raceDate, $id);

        // set parameters and execute
        $fullName = $dataArr["fullName"];
        $raceDate = $date02;
        $id = $dataArr["id"];

        $status = $stmt->execute();

        if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
        }
        
        printf("%d Row inserted.\n", $stmt->affected_rows);

        echo "New records created successfully";

        $stmt->close();
    } elseif ($flag == "result") {

        echo $flag;
        echo "<br />";
        
        // prepare and bind
        $stmt = $conn->prepare(" UPDATE Result SET fullName = ?, raceTime = ? WHERE id = ? ");
        $stmt->bind_param("ssi", $fullName, $raceTime, $id);

        // set parameters and execute
        $fullName = $dataArr["fullName"];
        $raceTime = $dataArr["raceTime"];
        $id = $dataArr["id"];

        $status = $stmt->execute();

        if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
        }
        
        printf("%d Row inserted.\n", $stmt->affected_rows);

        echo "New records created successfully";

        $stmt->close();
    } // end if

#    update result's placement: $_POST["raceId"]
        // prepare and bind
    $sql = "SELECT * from Result WHERE raceId = " . $dataArr["raceId"] . " and distance = '" . $dataArr["distance"] . "' ";
    $resultResult = $conn->query($sql);

    // fill data to medium distance result array?
    if ($resultResult->num_rows > 0) {

        $counter = 0;
        // output data of each row
        while($row = $resultResult->fetch_assoc()) {
    
           $resultArr[$counter]["fullName"] = $row["fullName"];
           $resultArr[$counter]["distance"] = $row["distance"];
           $resultArr[$counter]["id"] = $row["id"];
           $resultArr[$counter]["raceTime"] = $row["raceTime"];
           $resultArr[$counter]["placement"] = $row["placement"];
           $resultArr[$counter]["raceId"] = $row["raceId"];
    
           $counter++;
        } // end while
    #     echo "</table>";
    } else {
        echo "0 results";
        echo "<br />";
    } // end if
    

    $returnedArr = getPlacement($resultArr);

    $sortedArrLength = count($returnedArr);
// update placements?
        
    // prepare and bind
    $stmt = $conn->prepare(" UPDATE Result SET placement = ? WHERE id = ? ");
    $stmt->bind_param("si", $placement, $id);

    // set parameters and execute
    for ($i = 0; $i < $sortedArrLength; $i++) {
  
        $placement = $returnedArr[$i]["placement"];
        $id = $returnedArr[$i]["id"];

        $status = $stmt->execute();

        if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
        }
        
        printf("%d Row inserted.\n", $stmt->affected_rows);

        echo "New records created successfully";
    } // end for

    $stmt->close();

    $conn->close();



    return True;

} // end function

?>