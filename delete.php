<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'onlineexam';

$conn = new mysqli($hostname, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

  
    $sql = "DELETE FROM onlineregister WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
