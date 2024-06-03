<?php

function getProperties() {

    $counter = 0;
    $results = [];

 //   $myFile = fopen("../config/properties.ini", "r") or die("Unable to open file!");
    $myFile = fopen("config/properties.ini", "r") or die("Unable to open file!");

    // Output one line until end-of-file
    while(!feof($myFile)) {

        $tmp = fgets($myFile);

        $tmpArr = explode("=", $tmp);

        if ($tmpArr[0] == "serverName") {
    
            $results["serverName"] = trim($tmpArr[1]);
        } elseif ($tmpArr[0] == "username") {

            $results["username"] = trim($tmpArr[1]);
        } elseif ($tmpArr[0] == "password")  {

            $results["password"] = trim($tmpArr[1]);
        } elseif ($tmpArr[0] == "dbName") {

            $results["dbName"] = trim($tmpArr[1]);
        } // end if

        $counter++;
    
    } // end while


    fclose($myFile);

    return $results;

} // end function

//var_dump(getProperties());
?>