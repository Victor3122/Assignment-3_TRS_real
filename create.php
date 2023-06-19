<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Online Registrations</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Online Registrations</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>E-Mail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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
                    $name = $_POST["name"];
                    $age = $_POST["age"];
                    $phonenum = $_POST["phonenum"];
                    $email = $_POST["email"];

                    $sql = "INSERT INTO onlineregister (name, age, phonenum, email) VALUES ('$name', '$age', '$phonenum', '$email')";

                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success" role="alert">Record created successfully.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error creating record: ' . $conn->error . '</div>';
                    }
                }

                $sql = "SELECT * FROM onlineregister";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["age"]; ?></td>
                            <td><?php echo $row["phonenum"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No results found.</td>
                    </tr>
                    <?php
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <h2>Create New Registration</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="phonenum" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phonenum" name="phonenum" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</body>
</html>



