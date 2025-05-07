
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <div class="card p-3 ">

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

                            <!-- You can insert this section at the top of your dashboard page -->
                            <div class="row mb-4">
                                <div class="col-md-4 ">
                                    <div class="card text-white bg-primary align-items-center p-3">
                                        <h5>Total Students</h5>
                                        <p class="fs-4"><?= $total ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-white bg-success justify-content-center align-items-center p-3">
                                        <h5>Present Today</h5>
                                        <p class="fs-4"><?= $present ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-white bg-danger align-items-center p-3">
                                        <h5>Absent Today</h5>
                                        <p class="fs-4"><?= $absent ?></p>
                                    </div>
                                </div>
                            </div>

                            <!--ss;s-->
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="card p-3">
                                        <h5 class="mb-3">Attendance Trend</h5>
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-3">
                                        <h5 class="mb-3">Weekly Summary</h5>
                                        <!-- e.g., small bar graph or list -->
                                        <canvas id="weeklyChart"></canvas>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card p-3">
                                        <h5 class="mb-3">Recent Students</h5>
                                        <ul class="list-group">
                                            <?php foreach ($recentStudents as $student): ?>
                                                <li class="list-group-item">
                                                    <?= htmlspecialchars($student['name']) ?> - <?= $student['student_id'] ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card p-3">
                                        <h5 class="mb-3">Calendar</h5>
                                        <div id="calendar"></div> <!-- Will be initialized with JS -->
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