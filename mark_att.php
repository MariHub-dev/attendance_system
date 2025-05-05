<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<style>
    body {
        background-color: #F0E5ED;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 mt-2">
                <?php include_once 'includes/sidebar.php' ?>
            </div>
            <div class="col-md-10 mt-2">
                <?php include_once 'includes/navbar.php' ?>

                <div class="main-content">

                    <div class=" py-5">
                        <div class="card p-3 mt-4">
                            <form action="mark_att.php" method="POST">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Id</th>
                                            <th>Present</th>
                                            <th>Absent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'config/db.php';
                                        $query = "SELECT * FROM students";
                                        $result = $conn->query($query);
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                                            echo "<td><input type='radio' name='attendance[" . $row['id'] . "]' value='Present' required></td>";
                                            echo "<td><input type='radio' name='attendance[" . $row['id'] . "]' value='Absent'></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Submit Attendance</button>
                            </form>

                        </div>
                    </div>
                    <?php
                    include_once 'config/db.php';

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendance'])) {
                        $today = date('Y-m-d');

                        foreach ($_POST['attendance'] as $student_id => $status) {
                            $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)");
                            $stmt->bind_param("iss", $student_id, $today, $status);
                            $stmt->execute();
                        }

                        echo "<script>alert('Attendance marked successfully'); window.location.href='students.php';</script>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>