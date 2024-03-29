<?php
// Include database connection
include_once 'db.php'; 

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $faculty_id = $_POST['faculty_id']; 
    $dept_id = $_POST['dept_id'];
    $faculty_name=$_POST['faculty_name'];
    $faculty_email=$_POST['faculty_email'];
    $login_id=$_POST['login_id'];
    
    // Prepare the SQL statement to insert data into the student table
    $sql = "INSERT INTO faculty(FACULTY_ID,Dept_ID,Faculty_Name,Faculty_Email,Login_ID) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("iissi", $faculty_id, $dept_id, $faculty_name, $faculty_email, $login_id);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        // Insertion successful
        echo "Faculty record inserted successfully.";
    } else {
        // Insertion failed
        echo "Error: Unable to insert student record.";
    }

    // Close the statement
    $stmt->close();
} else {
    // If the form was not submitted via POST method, return an error message
    echo "Error: Form submission method not recognized.";
}

// Close the database connection
$con->close();
?>
