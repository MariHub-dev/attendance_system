<?php
include_once 'config/db.php';

// Fetch existing data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $class = $_POST['class'];
    $sems = $_POST['sems'];

    $sql = "UPDATE students SET name=?, student_id=?, class=?, sems=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $student_id, $class, $sems, $id);

    if ($stmt->execute()) {
        header("Location: students.php?msg=updated"); // Replace with actual filename
        exit();
    } else {
        echo "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3>Edit Student Info</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $student['id'] ?>">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Student ID</label>
                <input type="text" name="student_id" value="<?= htmlspecialchars($student['student_id']) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Faculty</label>
                <input type="text" name="class" value="<?= htmlspecialchars($student['class']) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Semester</label>
                <select name="sems" class="form-select" required>
                    <?php
                    for ($i = 1; $i <= 8; $i++) {
                        $selected = ($student['sems'] == $i) ? "selected" : "";
                        echo "<option value='$i' $selected>Sems $i</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
            <a href="student.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
