<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Students Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Create Students Table</h3>

                    <?php
                    $conn = new mysqli("localhost", "root", "", "wis_lab");

                    if ($conn->connect_error) {
                        echo '<div class="alert alert-danger">Connection failed: ' .
                             htmlspecialchars($conn->connect_error) . '</div>';
                    } else {
                        $sql = "CREATE TABLE students (
                            id INT PRIMARY KEY AUTO_INCREMENT,
                            full_name VARCHAR(100) NOT NULL,
                            email VARCHAR(120) NOT NULL,
                            department VARCHAR(80) NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                        )";

                        if ($conn->query($sql) === TRUE) {
                            echo '<div class="alert alert-success">Students table created successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Could not create table: ' .
                                 htmlspecialchars($conn->error) . '</div>';
                        }

                        $conn->close();
                    }
                    ?>

                    <p class="mb-0">
                        Database: <strong>wis_lab</strong><br>
                        Table: <strong>students</strong>
                    </p>

                    <a href="insert_student.php" class="btn btn-primary mt-3">Add Student</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
