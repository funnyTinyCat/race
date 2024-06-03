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

<h1>Test</h1>

<!--    <p>Date: <input type="text" id="datepicker"></p>
-->
<?php

require "functions/fun_validation.php";

require "functions/fun_upload_file.php";

require "functions/fun_save_data.php";
// turn into function!

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submit"]) and ($_POST["submit"] == "Save Data")) {


        saveData($_POST["raceName"], $_POST["date"]);
    } // end if

} // END IF


?>
 

    <form action="<?php echo htmlspecialchars("index.php"); ?>" method="POST" enctype="multipart/form-data">
        Name: <input type="text" name="raceName" value="<?php echo $raceName  ?>" />
        <span class="error">* <?php echo $raceNameErr;?></span>        
        <br /><br />
        Date: <input type="text" id="datepicker" name="date" value="<?php echo $date ?>" />
        <span class="error">* <?php echo $dateErr;?></span>                
        <br /><br />
        Select a CSV file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $fileToUpload ?>" />
        <span class="error">* <?php echo $fileToUploadErr;?></span>                
        <br /><br />
        <input type="submit" value="Save Data" name="submit" />
    </form>

</body>
</html>


