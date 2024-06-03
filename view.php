<html>
<head>

</head>

<body>
<?php

require "functions/fun_read_data.php";
require "functions/fun_avg_finish_time.php";

$returnedValues = readData();


?>

<div><h3>Race</h3></div>

<form method="POST" action=<?php echo htmlspecialchars("update.php"); ?> >

<?php

$race = $returnedValues[0];
$resultArr = $returnedValues[1];
$resultMediumArr = $returnedValues[2];
$resultLongArr = $returnedValues[3];
/*
var_dump($resultMediumArr);
echo "<br />";  
echo $resultMediumArr[0]["id"];
exit();
*/
$returnedTimeMedium = avgFinishTime($race["id"], "medium");
$returnedTimeLong = avgFinishTime($race["id"], "long");

$resultFullNameErr = "";




echo "<div>";

echo "<input type='hidden' name='id' value='" . $race["id"] . "' />";
echo "<input type='text' name='fullName' value='" . $race["fullName"] . "' readonly />";
echo "<input type='text' name='raceDate' value='" . date("d/m/Y", strtotime($race["raceDate"])) . "' readonly />";

echo "<input type='submit' name='race' id='race' value='Edit'  />";
echo "</div>";

?>
</form>


<div><h3>Results</h3></div>
<div><p>Average Finish Time - medium: <?php echo $returnedTimeMedium; ?> </p> </div>
<?php

for ($i = 0; $i < count($resultMediumArr); $i++) {

    echo "<form style='margin: 0px 0px 0px 0px;' method='POST' action='" . htmlspecialchars('update.php') . "' >";

    #echo "<div>";

    echo "<input type='hidden' name='id' value='" . $resultMediumArr[$i]["id"] . "' />";
    echo "<input type='text' name='fullName' value='" . $resultMediumArr[$i]["fullName"] . "' readonly />";
    echo "<input type='hidden' name='distance' value='" . $resultMediumArr[$i]["distance"] . "' readonly />";
    echo "<input type='text' name='raceTime' value='" . $resultMediumArr[$i]["raceTime"] . "' readonly />";
    echo "<input type='text' name='placement' value='" . $resultMediumArr[$i]["placement"] . "' readonly />";
    echo "<input type='hidden' name='raceId' value='" . $resultMediumArr[$i]["raceId"] . "' />";
    
    echo "<input type='submit' name='result' id='result' value='Edit'  />";

   # echo "</div>";

    echo "</form>";
} // end for
?>
<?php
echo "<div><p>Long Distance - Average Time: " . $returnedTimeLong . "</p></div>";
?>

<?php

for ($i = 0; $i < count($resultLongArr); $i++) {

  echo "<form style='margin: 0px 0px 0px 0px' method='POST' action='" . htmlspecialchars("update.php") ."' >";

    echo "<input type='hidden' name='id' value='" . $resultLongArr[$i]["id"] . "' />";
    echo "<input type='text' name='fullName' value='" . $resultLongArr[$i]["fullName"] . "' readonly />";
    echo "<input type='hidden' name='distance' value='" . $resultLongArr[$i]["distance"] . "' readonly />";
    echo "<input type='text' name='raceTime' value='" . $resultLongArr[$i]["raceTime"] . "' readonly />";
    echo "<input type='text' name='placement' value='" . $resultLongArr[$i]["placement"] . "' readonly />";
    echo "<input type='hidden' name='raceId' value='" . $resultLongArr[$i]["raceId"] . "' />";
    
    echo "<input type='submit' name='result' id='result' value='Edit'  />";

    echo "</form>";
} // end for
?>
<br />
<a href="http://127.0.0.1/race/index.php">Race</a>
<br />


</body>
</html>

