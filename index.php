<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    .main-content {}
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 mt-2">
                <?php include_once 'includes/sidebar.php' ?>
            </div>
            <div class="col-md-10 mt-2">
                <?php include_once 'includes/navbar.php' ?>

                <div class="main-content ">
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
                                    <div class="card text-white bg-primary justify-content-center align-items-center p-3">
                                        <p class="m-0 p-0">Total Students</p>
                                        <p class="h1 m-0 p-0"><?= $total ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-white bg-success justify-content-center align-items-center p-3">
                                        <p class="m-0 p-0">Present Today</p>
                                        <p class="h1 m-0 p-0"><?= $present ?></p>

                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="card text-white bg-danger d-flex align-items-center p-3">
                                        
                                        
                                            <p class="m-0 p-0">Absent Today</p>
                                            <p class="h1 m-0 p-0"><?= $absent ?></p>
                                       



                                    </div>
                                </div>
                            </div>

                            <!--ss;s-->
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="card p-3">
                                        <h5 class="mb-3">Attendance Trend</h5>
                                        <?php
                                        // Current month and year
                                        $month = date('m');
                                        $year = date('Y');

                                        $query = "SELECT status, COUNT(*) as count 
                                        FROM attendance 
                                        WHERE MONTH(date) = ? AND YEAR(date) = ?
                                        GROUP BY status";

                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("ii", $month, $year);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        $attendanceData = ['Present' => 0, 'Absent' => 0];
                                        while ($row = $result->fetch_assoc()) {
                                            $status = $row['status'];
                                            $attendanceData[$status] = $row['count'];
                                        }
                                        ?>

                                        <canvas id="monthlyAttendanceChart"></canvas>
                                        <script>
                                            const ctx = document.getElementById('monthlyAttendanceChart').getContext('2d');
                                            const monthlyAttendanceChart = new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: ['Present', 'Absent'],
                                                    datasets: [{
                                                        label: 'Number of Days',
                                                        data: [
                                                            <?= $attendanceData['Present']; ?>,
                                                            <?= $attendanceData['Absent']; ?>
                                                        ],
                                                        backgroundColor: ['#4CAF50', '#F44336']
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true,
                                                            stepSize: 1
                                                        }
                                                    }
                                                }
                                            });
                                        </script>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-3">
                                    <h5 class="mb-3">Weekly Summary</h5>
                                        <?php

                                        $startOfWeek = date('Y-m-d', strtotime('sunday last week'));
                                        $endOfWeek = date('Y-m-d', strtotime('saturday this week'));

                                        $query = "
                                                SELECT DATE(date) as day, status, COUNT(*) as count
                                                FROM attendance
                                                WHERE DATE(date) BETWEEN ? AND ?
                                                GROUP BY DATE(date), status
                                        ";

                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("ss", $startOfWeek, $endOfWeek);
                                        $stmt->execute();
                                        $result = $stmt->get_result();


                                        $weeklyData = [];

                                        while ($row = $result->fetch_assoc()) {
                                            $day = $row['day'];
                                            $status = $row['status'];
                                            $count = $row['count'];

                                            if (!isset($weeklyData[$day])) {
                                                $weeklyData[$day] = ['Present' => 0, 'Absent' => 0];
                                            }
                                            $weeklyData[$day][$status] = $count;
                                        }
                                        ?>

                                       

                                        <canvas id="weeklyAttendanceChart"></canvas>
                                        <script>
                                            const weekLabels = <?= json_encode(array_keys($weeklyData)); ?>;
                                            const presentData = <?= json_encode(array_map(fn($d) => $d['Present'], $weeklyData)); ?>;
                                            const absentData = <?= json_encode(array_map(fn($d) => $d['Absent'], $weeklyData)); ?>;

                                            const weeklyChart = new Chart(document.getElementById('weeklyAttendanceChart').getContext('2d'), {
                                                type: 'line',
                                                data: {
                                                    labels: weekLabels,
                                                    datasets: [{
                                                            label: 'Present',
                                                            data: presentData,
                                                            borderColor: '#4CAF50',
                                                            fill: true,
                                                            tension: 0.3
                                                        },
                                                        {
                                                            label: 'Absent',
                                                            data: absentData,
                                                            borderColor: '#F44336',
                                                            fill: false,
                                                            tension: 0.3
                                                        }
                                                    ]
                                                },
                                                options: {
                                                    responsive: true,
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            });
                                        </script>


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