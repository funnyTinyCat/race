<?php

echo "Tu sam fun_test";
echo "<br /><br />";

// connect to database:
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "task01";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
} // end if
echo "Connected successfully";

$sql = "INSERT INTO race (id, fullName, date)
VALUES (2, 'Trka', '" . date("Y-m-d") . "')";
// VALUES ('" . $_POST["fullName"] . "', " . date("Y-m-d h:i:sa") . ")";
/*
INSERT INTO race (id, fullName, date)
VALUES (1, 'Trka', CURRENT_TIMESTAMP);
*/



if ($conn->query($sql) === TRUE) {
    echo "New record created successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} // end if


/*
// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
*/

/*
INSERT INTO table_name (column1, column2, column3,...)
VALUES (value1, value2, value3,...)
*/



$conn->close();

?>