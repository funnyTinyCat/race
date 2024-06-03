

<?php

function getFile($fileName, $race) {

    $counter = 0;
    // id, fullName, date
    $results = [];

    $myFile = fopen("uploads/results.csv", "r") or die("Unable to open file!");
    
    // Output one line until end-of-file
    while(!feof($myFile)) {

        $tmp = fgets($myFile);

        $tmpArr = explode(",", $tmp);

        $results[$counter]["fullName"] = trim($tmpArr[0]);
        $results[$counter]["distance"] = trim($tmpArr[1]);
        $results[$counter]["raceTime"] = trim($tmpArr[2]);
        $results[$counter]["placement"] = 0;
 
        $counter++;
     
    } // end while


    fclose($myFile);

    return $results;

} // end function


?>