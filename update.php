<!DOCTYPE html><html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Datepicker - Default functionality</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $( function() {
      $( "#datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy'
    });
    } );
    </script>   
</head>
<body>
<?php

require "functions/fun_update_data.php";
require "functions/fun_check_time_format.php";


$fullNameErr = "";
$raceTimeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // edit race data?
    if (isset($_POST["race"]) and ($_POST["race"] == "Edit")) {


        echo "It's Edit Race.";


        echo "<form method='POST' action=" . htmlspecialchars("update.php") . " enctype='multipart/form-data' >";

        echo "<input type='text' name='fullName' id='fullName' value='" . $_POST["fullName"] . "' />";
    
        echo "<input type='text' name='raceDate' id='datepicker' value='" . $_POST["raceDate"] . "' />";
    
        echo "<input type='hidden' name='id' id='id' value='" . $_POST["id"] . "' />";
    
        echo "<input type='submit' name='race' id='race' value='Save'  />";
    
        echo "</form>";

    } // end if

    // edit result data?
    if (isset($_POST["result"])) {

        // is it is save form?
        if ($_POST["result"] == "Save") {

            if ((trim($_POST["fullName"]) == "") ) {

                $fullNameErr = "Field must not be empty.";
            } elseif ((checkTimeFormat($_POST["raceTime"]) == 0) or $_POST["raceTime"] == "") {

                $raceTimeErr = "Field must not be empty, or time format is wrong.";
            } else {

                $flag = "result";

                $tmp = updateData(["id"=>$_POST["id"], "fullName"=>$_POST["fullName"], 
                "raceTime"=>$_POST["raceTime"], "raceId"=>$_POST["raceId"], "distance"=>$_POST["distance"]], $flag);

                if ($tmp) {

                    header("Location: http://127.0.0.1/race/view.php");
                    exit();  
                } // end if

            } // end if

        } // end if


        echo "It's Edit Result.";
        echo "<br />";


        echo "<form method='POST' action='" . htmlspecialchars("update.php") . "' enctype='multipart/form-data' >";

        echo "<input type='text' name='fullName' id='fullName' value='" . $_POST["fullName"] . "' />";

        if (isset($fullNameErr)) {
            echo "<span class='error'>* " . $fullNameErr . "</span>";   }
        

        echo "<input type='text' name='raceTime' id='raceTime' value='" . $_POST["raceTime"] . "' />";

        if (isset($raceTimeErr)) {
            echo "<span class='error'>* " . $raceTimeErr . "</span>";   }

/*     <label for="appt">Select a time:</label>
  <input type="time" id="appt" name="appt">
  preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $foo)
  */
        echo "<input type='hidden' name='id' id='id' value='" . $_POST["id"] . "' />";

        echo "<input type='hidden' name='raceId' id='raceId' value='" . $_POST["raceId"] . "' />";

        echo "<input type='hidden' name='distance' id='distance' value='" . $_POST["distance"] . "' />";
        
        echo "<input type='submit' name='result' id='result' value='Save'  />";
    
        echo "</form>";



    } // end if

    if (isset($_POST["race"]) and ($_POST["race"] == "Save")) {

        echo "It's Save race.";
        echo "<br />";
        echo $_POST["race"];
        echo "<br />";
        echo $_POST["result"];
        echo "<br />";

        exit();

        $flag = "race";

        $tmp = updateData(["id"=>$_POST["id"], "fullName"=>$_POST["fullName"], "raceDate"=>$_POST["raceDate"]], $flag);

        if ($tmp) {

            header("Location: http://127.0.0.1/race/view.php");
            exit();  
        } // end if

    } // end if

// update result row?
/*
    if (isset($_POST["result"]) and ($_POST["result"] == "Save")) {

        if (!isset($_POST["resultFullNameErr"])) {

#           header("Location: http://127.0.0.1/race/update.php?resultFullNameErr=");
 #           exit();  
        } // end if

        echo "It's Result Save Function.";
        echo "<br />";
        echo $_POST["id"];
        echo "<br />";
        echo $_POST["fullName"];
        echo "<br />";


    } // end if
*/

} // end if

?>


</body>