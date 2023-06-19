<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Registration</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Registration</h1>

        <?php
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $db_name = 'onlineexam';

        $conn = new mysqli($hostname, $username, $password, $db_name);

        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $age = $_POST["age"];
            $phonenum = $_POST["phonenum"];
            $email = $_POST["email"];

            
            $sql = "UPDATE onlineregister SET name='$name', age='$age', phonenum='$phonenum', email='$email' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Record updated successfully.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error updating record: ' . $conn->error . '</div>';
            }
        } else {
            $id = $_GET["id"];

          
            $sql = "SELECT * FROM onlineregister WHERE id='$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row["name"];
                $age = $row["age"];
                $phonenum = $row["phonenum"];
                $email = $row["email"];
            } else {
                echo '<div class="alert alert-danger" role="alert">Record not found.</div>';
            }
        }

        $conn->close();
        ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phonenum" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phonenum" name="phonenum" value="<?php echo $phonenum; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
