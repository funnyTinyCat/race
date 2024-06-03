<?php

require "fun_get_properties.php";


function readData() {

    $properties = getProperties();

    $serverName = $properties["serverName"];
    $username = $properties["username"];
    $password = $properties["password"];
    $dbName = $properties["dbName"];

    $race = [];
    $resultArr = [];
    $resultMediumArr = [];
    $resultLongArr = [];

    $counter = 0;

    // Create connection
    $conn = new mysqli($serverName, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);
    } // end if
    echo "Connected successfully <br />";

    echo "<br /><br />";

// return races?
    $sql = "SELECT id, fullName, raceDate FROM Race;";
    $resultRace = $conn->query($sql);
    
// return results?
    $sql = "SELECT id, fullName, distance, raceTime, placement, raceId FROM Result;";
    $resultResult = $conn->query($sql);

// return medium distance results ?
    $sql = "SELECT id, fullName, distance, raceTime, placement, raceId FROM Result where distance = 'medium' order by placement asc;";
    $resultResultMedium = $conn->query($sql);

// return medium distance results ?
    $sql = "SELECT id, fullName, distance, raceTime, placement, raceId FROM Result where distance = 'long' order by placement asc;";
    $resultResultLong = $conn->query($sql);


// fill data to race array?
    if ($resultRace->num_rows > 0) {
      // output data of each row
      while($row = $resultRace->fetch_assoc()) {

        $race["fullName"] = $row["fullName"];
        $race["raceDate"] = $row["raceDate"];
        $race["id"] = $row["id"];
      } // end while

    } else {

      echo "0 results";
    } // end if

// fill data to result array?
    if ($resultResult->num_rows > 0) {
         // output data of each row
         while($row = $resultResult->fetch_assoc()) {

            $resultArr[$counter]["fullName"] = $row["fullName"];
            $resultArr[$counter]["distance"] = $row["distance"];
            $resultArr[$counter]["id"] = $row["id"];
            $resultArr[$counter]["raceTime"] = $row["raceTime"];
            $resultArr[$counter]["placement"] = $row["placement"];
            $resultArr[$counter]["raceId"] = $row["raceId"];

            $counter++;
         }
    #     echo "</table>";
    } else {
        echo "0 results";
    } // end if

    $counter = 0;

// fill data to medium distance result array?
    if ($resultResultMedium->num_rows > 0) {
    // output data of each row
    while($row = $resultResultMedium->fetch_assoc()) {

       $resultMediumArr[$counter]["fullName"] = $row["fullName"];
       $resultMediumArr[$counter]["distance"] = $row["distance"];
       $resultMediumArr[$counter]["id"] = $row["id"];
       $resultMediumArr[$counter]["raceTime"] = $row["raceTime"];
       $resultMediumArr[$counter]["placement"] = $row["placement"];
       $resultMediumArr[$counter]["raceId"] = $row["raceId"];

       $counter++;
    }
#     echo "</table>";
    } else {
        echo "0 results";
    } // end if

    $counter = 0;

// fill data to long distance result array?
if ($resultResultLong->num_rows > 0) {
    // output data of each row
    while($row = $resultResultLong->fetch_assoc()) {

       $resultLongArr[$counter]["fullName"] = $row["fullName"];
       $resultLongArr[$counter]["distance"] = $row["distance"];
       $resultLongArr[$counter]["id"] = $row["id"];
       $resultLongArr[$counter]["raceTime"] = $row["raceTime"];
       $resultLongArr[$counter]["placement"] = $row["placement"];
       $resultLongArr[$counter]["raceId"] = $row["raceId"];

       $counter++;
    }
#     echo "</table>";
    } else {
        echo "0 results";
    } // end if

// close connection
    $conn->close();

    $returnValues[0] = $race;
    $returnValues[1] = $resultArr;
    $returnValues[2] = $resultMediumArr;
    $returnValues[3] = $resultLongArr;

  return $returnValues;
} // end function



?>