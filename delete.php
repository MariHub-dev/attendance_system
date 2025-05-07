<?php
include_once 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM students WHERE id=$id";

    if ($conn->query($deleteQuery) === true) {
        header('Location: add_students.php');
        exit;
    } else {
        echo "Error deleting Student : " . $conn->error;
    }
}

$conn->close();
?>
