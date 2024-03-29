<?php
// Include database connection
include_once 'db.php'; 

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $student_id = $_POST['student_id']; 
    $student_phone = $_POST['student_phone'];
    $student_email=$_POST['student_email'];
    $student_name=$_POST['student_name'];
    $dept_id=$_POST['dept_id'];
    $login_id=$_POST['login_id'];
    
    // Prepare the SQL statement to insert data into the student table
    $sql = "INSERT INTO student(STUDENT_ID,Login_ID,Dept_ID,Student_Name,Student_Email,Student_Phone_No) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("iiisss", $student_id,$login_id,$dept_id,  $student_name,  $student_email,$student_phone);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        // Insertion successful
        echo "Student record inserted successfully.";
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
