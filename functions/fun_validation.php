<?php


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  } // end function
// define variables and set to empty values



$raceName = $date = $fileToUpload = "";
$raceNameErr = $dateErr = $fileToUploadErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if(isset($_POST["submit"])) {


        if (empty($_POST['raceName'])) {

            $raceNameErr = "Name field is required.";
        } else {

            $raceName = test_input($_POST["raceName"]);
        } // end if
    
        if (empty($_POST["date"])) {

            $dateErr = "Date field is required.";
        } else {

            $date = test_input($_POST["date"]);
        } // end if

/*        
        if (empty($_POST["fileToUpload"])) {

            $fileToUploadErr = "CSV file must be uploaded.";
        } else {

            $fileToUpload = test_input($_POST("fileToUpload"));
        } // end if
*/
        // and ($fileToUploadErr == ""


    } // end if
    
} // end if

?>