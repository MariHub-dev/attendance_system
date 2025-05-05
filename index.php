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

    .badge {
        padding: 30px;

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
                            <div class=" col-md-12 d-flex align-items-center gap-5 ">
                                <?php
                                include_once 'config/db.php';

                                $today = date('Y-m-d');
                                $sql = "SELECT status FROM attendance WHERE date = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $today);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $total = $present = $absent = 0;

                                while ($row = $result->fetch_assoc()) {
                                    $total++;
                                    if ($row['status'] === 'Present') $present++;
                                    if ($row['status'] === 'Absent') $absent++;
                                }
                                ?>

                                <div class="card col-md-3">
                                    <div class="badge bg-primary p-4">Total Students: <br>
                                        <p class="h4"><?php echo $total; ?></p>
                                    </div>
                                </div>
                                <div class="card col-md-3">
                                    <div class="badge bg-success p-4">Present: <br>
                                        <p class="h4"><?php echo $present; ?></p>
                                    </div>
                                </div>
                                <div class="card col-md-3">
                                    <div class="badge bg-danger p-4">Absent: <br>
                                        <p class="h4"><?php echo $absent; ?></p>
                                    </div>
                                </div>
                            </div>




                            <div class=" py-5">
                                <div class="card p-3 mt-4">
                                    <div class="card p-4 mt-4">
                                        <h5 class="mb-3">Today’s Attendance Summary (<?php echo $today; ?>)</h5>
                                        <div class="d-flex gap-4">
                                            <div class="badge bg-primary p-3">Total Students: <?php echo $total; ?></div>
                                            <div class="badge bg-success p-3">Present: <?php echo $present; ?></div>
                                            <div class="badge bg-danger p-3">Absent: <?php echo $absent; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>