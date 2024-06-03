<?php

require "fun_read_file.php";

function getPlacement($resultsArr) {

    $resultsValuesArr = [];
    $mediumArr = [];

    $rows = count($resultsArr);

    if ($rows > 0){

        $cols = count($resultsArr[0]);
    } else {

        echo "There is no data.<br />";
        echo "Bye, bye...<br />";

        exit();
    } // end if
 

    // calculate placement?
    for ($i = 0; $i < $rows; $i++) {

        if ($resultsArr[$i]["distance"] == "medium" ) {

            $mediumArr[$i] = strtotime($resultsArr[$i]["raceTime"]);
        } elseif ($resultsArr[$i]["distance"] == "long") {
            
            $longArr[$i] = strtotime($resultsArr[$i]["raceTime"]);
        }// end if

    } // end for

    if (isset($mediumArr)) {
        // sort time
        sort($mediumArr);

        $mediumLength = count($mediumArr);


        // set placement value - medium distance:
        for ($i = 0; $i < $rows; $i++) {

            for ($m = 0; $m < $mediumLength; $m++) {
            
                if (($mediumArr[$m]  == strtotime($resultsArr[$i]["raceTime"])) and ($resultsArr[$i]["distance"] == "medium")) {

                    $resultsArr[$i]["placement"] = $m + 1;
                } // end if

            } // end for
        
        } // end for

    } // end if


    // long distance
    if (isset($longArr)) {

        sort($longArr);

        $longLength = count($longArr);




        // set placement value - medium distance:
        for ($i = 0; $i < $rows; $i++) {

            for ($l = 0; $l < $longLength; $l++) {

                if (($longArr[$l]  == strtotime($resultsArr[$i]["raceTime"])) and ($resultsArr[$i]["distance"] == "long")) {

                    $resultsArr[$i]["placement"] = $l + 1;
                } // end if
                
            } // end for
        
        } // end for

    } // end if
/*
// show data:
    for ($i = 0; $i < $rows; $i++) {
        
        echo $resultsArr[$i]["placement"] . "  ";
        echo $resultsArr[$i]["distance"] . "  ";

        echo "Vrijeme: " . $resultsArr[$i]["time"] . "<br />";
    } // end for
*/
    return $resultsArr;

} // end function

/*
$returnedValuesArr = getFile("fileName", "Race");

getPlacement($returnedValuesArr);
*/

?>