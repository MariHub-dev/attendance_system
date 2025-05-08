<?php
include_once 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $class = $_POST['class'];
    $sems = $_POST['sems'];

    $sql = "INSERT INTO students (name, student_id, class, sems) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $student_id, $class, $sems);

    $stmt->execute();
        
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <style>
         .card {
        
        border: none;
        border-radius: 16px;

    }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 mt-2">
                <?php include_once 'includes/sidebar.php' ?>
            </div>
            <div class="col-md-10 mt-2 gap-3">
                <?php include_once 'includes/navbar.php' ?>
                <div class="main-content">
                    <div class=" ">
                        <div class="card p-3 ">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>Students Info</h6>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover  table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>R/N</th>
                                            <th>Faculty</th>
                                            <th>Sems</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Repeat this row with PHP or manually -->
                                        <?php
                                        include_once 'config/db.php';
                                        $query = "SELECT * FROM students order by id asc";

                                        $result = $conn->query($query);

                                        if ($result->num_rows > 0) {
                                            while ($rown = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $rown['id'] . "</td>";
                                                echo "<td>" . htmlspecialchars($rown['name']) . "</td>";
                                                echo "<td>" . htmlspecialchars($rown['student_id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($rown['class']) . "</td>";
                                                echo "<td>" . htmlspecialchars($rown['sems']) . "</td>";

                                                echo "<td>
                                                        <div class='action-buttons'>
                                                            <a href='update.php?id=" . $rown['id'] . "' class=' btn btn-primary'>Edit</a>
                                                            <a href='delete.php?id=" . $rown['id'] . "' class='btn btn-danger'>Delete</a>
                                                        </div>
                                                    </td>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No users found</td></tr>";
                                        }
                                        $conn->close();


                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-sm justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>

                            
                            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="" method="POST" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="student_id" class="form-label">Student ID</label>
                                                <input type="text" class="form-control" id="student_id" name="student_id" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="class" class="form-label">Foculty</label>
                                                <input type="text" class="form-control" id="class" name="class" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="sems" class="form-label">Semester</label>
                                                <select class="form-select" id="sems" name="sems" required>
                                                    <option value="">Select Semester</option>
                                                    <option value="1">Sems 1</option>
                                                    <option value="2">Sems 2</option>
                                                    <option value="3">Sems 3</option>
                                                    <option value="4">Sems 4</option>
                                                    <option value="5">Sems 5</option>
                                                    <option value="6">Sems 6</option>
                                                    <option value="7">Sems 7</option>
                                                    <option value="8">Sems 8</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" >Add Student</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            

                        </div>
                    </div>



                </div>
                <?php include_once 'includes/footer.php'; ?>
            </div>
        </div>
    </div>



    <style>
    body {
        background-color: #F0E5ED;
    }

    .card {
        border: none;
        border-radius: 12px;
    }
    .action-buttons a {
        margin-right: 8px;
        text-decoration: none;
    }

    
</style>

</body>

</html>
