<?php
include_once 'config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // First delete related attendance records
    $deleteAttendance = $conn->prepare("DELETE FROM attendance WHERE student_id = ?");
    $deleteAttendance->bind_param("i", $id);
    $deleteAttendance->execute();

    // Now delete the student
    $deleteStudent = $conn->prepare("DELETE FROM students WHERE id = ?");
    $deleteStudent->bind_param("i", $id);
    
    if ($deleteStudent->execute()) {
        header("Location: students.php?msg=deleted");
        exit();
    } else {
        echo "Failed to delete student.";
    }
}
?>
