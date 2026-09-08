<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Add Student</h3>

                    <?php
                    $fullName = "";
                    $email = "";
                    $department = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $fullName = trim($_POST["full_name"]);
                        $email = trim($_POST["email"]);
                        $department = trim($_POST["department"]);

                        $conn = new mysqli("localhost", "root", "", "wis_lab");

                        if ($conn->connect_error) {
                            echo '<div class="alert alert-danger">Connection failed: ' .
                                 htmlspecialchars($conn->connect_error) . '</div>';
                        } elseif ($fullName == "" || $email == "" || $department == "") {
                            echo '<div class="alert alert-warning">Please fill in all fields.</div>';
                        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo '<div class="alert alert-warning">Please enter a valid email address.</div>';
                        } else {
                            $stmt = $conn->prepare(
                                "INSERT INTO students (full_name, email, department) VALUES (?, ?, ?)"
                            );

                            if ($stmt) {
                                $stmt->bind_param("sss", $fullName, $email, $department);

                                if ($stmt->execute()) {
                                    echo '<div class="alert alert-success">Student added successfully.</div>';
                                    $fullName = "";
                                    $email = "";
                                    $department = "";
                                } else {
                                    echo '<div class="alert alert-danger">Could not add student: ' .
                                         htmlspecialchars($stmt->error) . '</div>';
                                }

                                $stmt->close();
                            } else {
                                echo '<div class="alert alert-danger">Could not prepare the SQL statement: ' .
                                     htmlspecialchars($conn->error) . '</div>';
                            }
                        }

                        $conn->close();
                    }
                    ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" name="full_name" id="full_name"
                                   class="form-control" value="<?php echo htmlspecialchars($fullName); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" name="department" id="department"
                                   class="form-control" value="<?php echo htmlspecialchars($department); ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Student</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>

                    <div class="mt-4">
                        <p class="text-muted mb-1">Test data from the lab:</p>
                        <small>Ahmad Rahimi — ahmad@example.com — Information Systems</small><br>
                        <small>Laila Noori — laila@example.com — Computer Science</small><br>
                        <small>Farid Hamidi — farid@example.com — Software Engineering</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
