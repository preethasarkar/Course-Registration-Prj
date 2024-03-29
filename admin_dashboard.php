<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .scrollable{
            overflow-y:auto;
            max-height:1500px;
        }
    </style>
</head>
<body>
<?php
// Start session (if not already started)
session_start();

// Check if admin is logged in
if (isset($_SESSION['admin_id'])) {
    if($_SESSION['role_id']==1) { ?>
    <div class="scrollable">
    <!--STUDENT TABLE-->
    <!--INSERT-->
    <form id="insert_student" method="post" action="insert_student.php">
        <input type="text" id="student_id" placeholder="Student ID"><br>
        <input type="text" id="student_name" placeholder="Student Name"><br>
        <input type="text" id="student_email" placeholder="Student Email address"><br>
        <input type="text" id="student_phone" placeholder="Student Phone number"><br>
        <input type="text" id="login_id" placeholder="Login ID">
        <input type="text" id="dept_id" placeholder="Department ID"><br>
        <button type="submit" onClick="SQL_INSERT_STUDENT()">INSERT</button>
    </form>
    <br>

    <!--UPDATE-->
    <table border="1">
        <tr>
            <th>Student ID</th>
            <th>Login ID</th>
            <th>Department ID</th>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Student Phone</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch existing records from the database and display them in a table
        include_once 'db.php'; // Include database connection
        $sql = "SELECT * FROM student";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['STUDENT_ID'] . "</td>";
                echo "<td>" . $row['Login_ID'] . "</td>";
                echo "<td>" . $row['Dept_ID'] . "</td>";
                echo "<td>" . $row['Student_Name'] . "</td>";
                echo "<td>" . $row['Student_Email'] . "</td>";
                echo "<td>" . $row['Student_Phone_No'] . "</td>";
                echo "<td>" . $row['Semester'] . "</td>";
                echo "<td><button onclick='updateRecord(" . $row['STUDENT_ID'] . ")'>Update</button></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <br>

    <div id="updateForm" style="display:none;">
        <h3>Update Student Record</h3>
        <form id="updateStudentForm" method="post">
            <input type="hidden" id="updateStudentId" name="studentId">
            <input type="text" id="updateStudentName" name="studentName" placeholder="Student Name"><br>
            <input type="text" id="updateStudentPhone" name="studentPhone" placeholder="Student Phone"><br>
            <input type="text" id="updateStudentEmail" name="studentEmail" placeholder="Student Email"><br>
            <input type="text" id="updateDeptId" name="dept_id" placeholder="Department ID"><br>
            <button type="button" onclick="submitUpdate()">Submit Update</button>
        </form>
    </div>
    
    <!--DELETE-->
    <form id="delete_student" method="post" action="delete_student.php">
        <input type="text" id="student_id_delete" placeholder="Student ID"><br>
        <button type="submit" onClick="SQL_DELETE_STUDENT()">DELETE</button>
    </form>
    

    <!--FACULTY TABLE-->
    <!--INSERT-->
    <form id="insert_faculty" method="post" action="insert_faculty.php">
        <input type="text" id="faculty_id" placeholder="Faculty ID"><br>
        <input type="text" id="dept_id_2" placeholder="Department ID"><br>
        <input type="text" id="faculty_name" placeholder="Faculty Name"><br>
        <input type="text" id="faculty_email" placeholder="Faculty Email address"><br>
        <input type="text" id="login_id_2" placeholder="Login ID"><br>
        <button type="submit" onClick="SQL_INSERT_FACULTY()">INSERT</button>
    </form>
    <br>

    <!--DELETE-->
    <form id="delete_faculty" method="post" action="delete_faculty.php">
        <input type="text" id="faculty_id_delete" placeholder="FACULTY ID"><br>
        <button type="submit" onClick="SQL_DELETE_FACULTY()">DELETE</button>
    </form>

    <!--UPDATE-->
    <table border="1">
        <tr>
            <th>Faculty ID</th>
            <th>Department ID</th>
            <th>Faculty Name</th>
            <th>Faculty Email</th>
            <th>Login ID</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch existing records from the database and display them in a table
        include_once 'db.php'; // Include database connection
        $sql = "SELECT * FROM faculty";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['FACULTY_ID'] . "</td>";
                echo "<td>" . $row['Dept_ID'] . "</td>";
                echo "<td>" . $row['Faculty_Name'] . "</td>";
                echo "<td>" . $row['Faculty_Email'] . "</td>";
                echo "<td>" . $row['Login_ID'] . "</td>";
                echo "<td><button onclick='UPDATE_FACULTY(" . $row['FACULTY_ID'] . ")'>Update</button></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <div id="updateForm2" style="display:none;">
        <h3>Update Faculty Record</h3>
        <form id="updateFacultyForm" method="post">
            <input type="hidden" id="faculty_id_update" name="faculty_id_update">
            <input type="text" id="dept_id_update" name="dept_id_update" placeholder="Department ID"><br>
            <input type="text" id="faculty_name_update" name="faculty_name_update" placeholder="Faculty Name"><br>
            <input type="text" id="faculty_email_update" name="faculty_email_update" placeholder="Faculty Email"><br>
            <input type="text" id="login_id_update" name="login_id_update" placeholder="Login ID"><br>
            <button type="button" onclick="SUBMIT_FACULTY()">Submit Update</button>
        </form>
    </div>
    <br>


    </div>


<?php
    } 
} ?>

<script>
    function SQL_INSERT_STUDENT(){
        
        var form = document.getElementById("insert_student");
        
        // Create hidden input fields for student ID and phone number
        var input1 = document.createElement("input");
        input1.setAttribute("type", "hidden");
        input1.setAttribute("name", "student_id");
        input1.value = document.getElementById("student_id").value;
        form.appendChild(input1);

        var input2 = document.createElement("input");
        input2.setAttribute("type", "hidden");
        input2.setAttribute("name", "student_phone");
        input2.value = document.getElementById("student_phone").value;
        form.appendChild(input2);

        var input3=document.createElement("input");
        input3.setAttribute("type","hidden");
        input3.setAttribute("name","student_email");
        input3.value=document.getElementById("student_email").value;
        form.appendChild(input3);

        var input4=document.createElement("input");
        input4.setAttribute("type","hidden");
        input4.setAttribute("name","student_name");
        input4.value=document.getElementById("student_name").value;
        form.appendChild(input4);

        var input5=document.createElement("input");
        input5.setAttribute("type","hidden");
        input5.setAttribute("name","dept_id");
        input5.value=document.getElementById("dept_id").value;
        form.appendChild(input5);

        var input6=document.createElement("input");
        input6.setAttribute("type","hidden");
        input6.setAttribute("name","login_id");
        input6.value=document.getElementById("login_id").value;
        form.appendChild(input6);
        
        // Submit the form
        // Create an AJAX request
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // Alert the user about the success message
            alert(this.responseText);
            // Reset the form after successful insertion
            location.reload();
            }
        };
        // Open a POST request to insert_student.php
        xhttp.open("POST", "insert_student.php", true);
        // Send the form data
        xhttp.send(new FormData(form));
    }

    function updateRecord(Student_id){
        document.getElementById("updateForm").style.display = "block";
        document.getElementById("updateStudentId").value=Student_id;
    }

    function submitUpdate() {
            // Get form data
            var formData = new FormData(document.getElementById("updateStudentForm"));
            
            // Make AJAX request to update record
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText); // Display response from server
                    // Hide the update form
                    document.getElementById("updateForm").style.display = "none";
                    // Refresh the page to see updated records
                    location.reload();
                }
            };
            xhttp.open("POST", "update_student.php", true);
            xhttp.send(formData);
        }

        function SQL_DELETE_STUDENT(){
            var form=document.getElementById("delete_student");
            
            var input1 = document.createElement("input");
            input1.setAttribute("type", "hidden");
            input1.setAttribute("name", "student_id");
            input1.value = document.getElementById("student_id_delete").value;
            form.appendChild(input1);

            form.submit();
        }

        function SQL_INSERT_FACULTY(){
            var form = document.getElementById("insert_faculty");
            // Create hidden input fields for student ID and phone number
            var input1 = document.createElement("input");
            input1.setAttribute("type", "hidden");
            input1.setAttribute("name", "faculty_id");
            input1.value = document.getElementById("faculty_id").value;
            form.appendChild(input1);

            var input2 = document.createElement("input");
            input2.setAttribute("type", "hidden");
            input2.setAttribute("name", "dept_id");
            input2.value = document.getElementById("dept_id_2").value;
            form.appendChild(input2);

            var input3=document.createElement("input");
            input3.setAttribute("type","hidden");
            input3.setAttribute("name","faculty_name");
            input3.value=document.getElementById("faculty_name").value;
            form.appendChild(input3);

            var input4=document.createElement("input");
            input4.setAttribute("type","hidden");
            input4.setAttribute("name","faculty_email");
            input4.value=document.getElementById("faculty_email").value;
            form.appendChild(input4);

            var input5=document.createElement("input");
            input5.setAttribute("type","hidden");
            input5.setAttribute("name","login_id");
            input5.value=document.getElementById("login_id_2").value;
            form.appendChild(input5);
            
            // Submit the form
            form.submit();
        }

        function SQL_DELETE_FACULTY(){
            var form=document.getElementById("delete_faculty");
            
            var input1 = document.createElement("input");
            input1.setAttribute("type", "hidden");
            input1.setAttribute("name", "faculty_id");
            input1.value = document.getElementById("faculty_id_delete").value;
            form.appendChild(input1);

            form.submit();
        }

        function UPDATE_FACULTY(Faculty_id){
            document.getElementById("updateForm2").style.display = "block";
            document.getElementById("faculty_id_update").value=Faculty_id;
        }

        function SUBMIT_FACULTY() {
            // Get form data
            var formData = new FormData(document.getElementById("updateFacultyForm"));
            // Make AJAX request to update record
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText); // Display response from server
                    // Hide the update form
                    document.getElementById("updateForm2").style.display = "none";
                    // Refresh the page to see updated records
                    location.reload();
                }
            };
            xhttp.open("POST", "update_faculty.php", true);
            xhttp.send(formData);
        }
</script>
    
</body>
</html>
