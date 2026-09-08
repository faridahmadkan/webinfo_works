<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Create Student Database</h3>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $databaseName = trim($_POST["database_name"]);

                        $conn = new mysqli("localhost", "root", "");

                        if ($conn->connect_error) {
                            echo '<div class="alert alert-danger">Connection failed: ' .
                                 htmlspecialchars($conn->connect_error) . '</div>';
                        } elseif ($databaseName == "") {
                            echo '<div class="alert alert-warning">Please enter a database name.</div>';
                        } elseif (!preg_match("/^[A-Za-z0-9_]+$/", $databaseName)) {
                            echo '<div class="alert alert-warning">Database name can contain only letters, numbers, and underscores.</div>';
                        } else {
                            $sql = "CREATE DATABASE `$databaseName`";

                            if ($conn->query($sql) === TRUE) {
                                echo '<div class="alert alert-success">Database "' .
                                     htmlspecialchars($databaseName) . '" created successfully.</div>';
                            } else {
                                echo '<div class="alert alert-danger">Could not create database: ' .
                                     htmlspecialchars($conn->error) . '</div>';
                            }
                        }

                        $conn->close();
                    }
                    ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="database_name" class="form-label">Database Name</label>
                            <input type="text" name="database_name" id="database_name"
                                   class="form-control" placeholder="Example: wis_lab" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Database</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>

                    <p class="text-muted mt-3 mb-0">
                        After creating the database, run <strong>create_table.php</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
