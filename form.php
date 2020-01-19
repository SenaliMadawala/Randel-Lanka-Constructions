<?php

$servername = "localhost";
$username = "randel_test";
$password = "?-@HcI5J^oqF";
$dbname = "randel_test";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//UPLOAD THE CV into a folder
$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

$sql = "INSERT INTO applicants (name, email,cv) VALUES ("
        //Repeat THIS BLOCK according to the passing POST data
        . "'" . $_POST['fname'] . "',"
        . "'" . $_POST['email'] . "',"
        //END line to close the bracket properly       
        . "'" . $target_file . "')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
