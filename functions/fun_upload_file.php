<?php




// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {


    # C:\Users\palig\Documents\CSV 
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    echo $target_file;
    echo "<br />";


    # exit("the end");

    # we use it later
    $uploadOk = 0;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


  # $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);

    if($check !== false) {

        echo "File exists - **$check bytes** .";
        $uploadOk = 1;

    } else {

        echo "File does not exist.";
        $uploadOk = 0;

    } # end if

/////////////////////////////////////////////////////////////////////////////////////



    // Check if file already exists
    if (file_exists($target_file)) {

      echo "Sorry, file already exists.";
      $uploadOk = 0;

    } // end if

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {

      echo "Sorry, your file is too large.";
      $uploadOk = 0;

    } // end if

    // Allow certain file formats
    if($fileType != "csv" ) {

      echo "Sorry, only CSV files are allowed.";
      $uploadOk = 0;

    } // end if

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    // C:\wamp\www\race\
    echo "<br /><br />";

    if (empty($_POST["fileToUpload"])) {

      $fileToUploadErr = "CSV file must be uploaded.";
  } else {

      $fileToUpload = test_input($_POST("fileToUpload"));
  } // end if
  


} # end if


/*
$myfile = fopen("uploads/results.csv", "r") or die("Unable to open file!");
echo fread($myfile,filesize("uploads/results.csv"));
fclose($myfile);
*/

/*
$myfile = fopen("uploads/results.csv", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
*/

?>