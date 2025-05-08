<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<style>
    body {
        background-color: #F0E5ED;
    }

    .card {

        border: none;
        border-radius: 16px;

    }

    select {
        width: 50px;
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
                    <div class=" ">
                        <div class="card p-3">
                            <?php
                            include_once 'config/db.php';
                            ?>
                            <form method="GET" class="mb-4 d-flex align-items-center gap-3">
                                <h5 class="me-5">Attendance Records</h5>

                                <input type="date" id="filter_date" name="date" class="form-control w-50" value="<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>" />






                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="view_att.php" class="btn btn-secondary">Reset</a>
                            </form>
                            <?php
                            $dateFilter = isset($_GET['date']) ? $_GET['date'] : null;

                            $sql = "SELECT a.date, a.status, s.name, s.student_id, s.sems
                            FROM attendance a
                            JOIN students s ON a.student_id = s.id";

                            if ($dateFilter) {
                                $sql .= " WHERE a.date = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $dateFilter);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            } else {
                                $sql .= " ORDER BY a.date DESC";
                                $result = $conn->query($sql);
                            }
                            ?>


                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Roll No</th>
                                        <th>Semester</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['sems']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center'>No attendance records found.</td></tr>";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <?php include_once 'includes/footer.php'; ?>
            </div>
           
        </div>
    </div>
    </div>
</body>

</html>