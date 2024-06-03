<?php
#require "fun_get_properties.php";

function avgFinishTime($raceId, $distance) {

    // in reference to flag calculate average finish time?
    $properties = getProperties();

    $serverName = $properties["serverName"];
    $username = $properties["username"];
    $password = $properties["password"];
    $dbName = $properties["dbName"];

    $counter = 0;

    $result = [];

    // Create connection
    $conn = new mysqli($serverName, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);
    } // end if
    echo "Connection successful.";
// return results?
    $sql = "SELECT TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(raceTime))), '%H:%i:%s') as avgTime FROM Result where raceId = " . $raceId . " and distance = '" . $distance . "';";
    $resultResult = $conn->query($sql);

/*var_dump($resultResult->num_rows) . "<br />";

exit();
*/  
// fill data to result array?
if ($resultResult->num_rows > 0) {
    // output data of each row
    while($row = $resultResult->fetch_assoc()) {

      $result = $row;

    #  $counter++;
    }
#     echo "</table>";
  } else {
    echo "0 results";
  }

// close connection
$conn->close();

return ltrim($result["avgTime"], "0");

/*
$returnValues[0] = $race;
$returnValues[1] = $resultArr;

return $returnValues;
*/
/*
$times = array('17:29:53','16:00:32');

$totaltime = '';
foreach($times as $time){
        $timestamp = strtotime($time);
        $totaltime += $timestamp;
}

$average_time = ($totaltime/count($times));

echo date('H:i:s',$average_time);
*/

} // end function

#avgFinishTime("medium", 1);


?>