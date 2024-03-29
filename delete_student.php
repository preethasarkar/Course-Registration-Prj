<?php
include_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id=$_POST['student_id'];

    $sql="DELETE FROM student WHERE STUDENT_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Insertion successful
        echo "Student record deleted successfully.";
    } else {
        // Insertion failed
        echo "Error: Unable to delete student record.";
    }

    // Close the statement
    $stmt->close();
}else {
    // If the form was not submitted via POST method, return an error message
    echo "Error: Form submission method not recognized.";
}

// Close the database connection
$conn->close();
?>