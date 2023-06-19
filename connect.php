
<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'onlineexam';


$conn = new mysqli($hostname, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    echo 'Connected.';
}

echo"<br/>";

$sql = "SELECT * FROM onlineregister";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " -Name: " . $row["name"] . " Age: " . $row["age"] . " Phone_Number: " . $row["phonenum"] . " Email: " . $row["email"] . "<br>";
    }
} else {
    echo "No results found.";
}

//$conn->close();
?>