<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $father_name = trim($_POST["father_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $program = trim($_POST["program"]);

    if ($full_name != "" && $father_name != "" && $email != "" && $phone != "" && $program != "") {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $stmt = $conn->prepare("INSERT INTO applications (full_name, father_name, email, phone, program) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $full_name, $father_name, $email, $phone, $program);
            $stmt->execute();
            $stmt->close();

            header("Location: admission.php");
            exit;
        }
    }
}

$result = $conn->query("SELECT * FROM applications ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Application</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-body p-4">

            <h2 class="text-center mb-4">Student Admission Application</h2>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Father's Name</label>
                    <input type="text" name="father_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Program</label>
                    <select name="program" class="form-select" required>
                        <option value="">Select Program</option>
                        <option value="Information Systems">Information Systems</option>
                        <option value="Software Engineering">Software Engineering</option>
                        <option value="Computer Science">Computer Science</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Submit Application
                    </button>
                </div>

            </form>

        </div>
    </div>

    <div class="mt-5">

        <h3 class="mb-3">Submitted Applications</h3>

        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Father's Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Program</th>
                    </tr>
                </thead>

                <tbody>

                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["full_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["father_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                        <td><?php echo htmlspecialchars($row["program"]); ?></td>
                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>