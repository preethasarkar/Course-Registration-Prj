<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--FACULTY TABLE-->
    <!--INSERT-->
    <form id="insert_faculty" method="post" action="insert_faculty.php">
        <input type="text" id="username" placeholder="Username"><br>
        <input type="text" id="password" placeholder="Password"><br>
        <input type="text" id="dept_id_2" placeholder="Department ID"><br>
        <input type="text" id="faculty_name" placeholder="Faculty Name"><br>
        <input type="text" id="faculty_email" placeholder="Faculty Email address"><br>
        <button type="button" onClick="SQL_INSERT_FACULTY()">INSERT</button>
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
        $result = $conn->query($sql);
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

    <script>
        function SQL_INSERT_FACULTY() {
            var form = document.getElementById("insert_faculty");
            // Create hidden input fields for student ID and phone number
            var input1 = document.createElement("input");
            input1.setAttribute("type", "hidden");
            input1.setAttribute("name", "username");
            input1.value = document.getElementById("username").value;
            form.appendChild(input1);

            var input2 = document.createElement("input");
            input2.setAttribute("type", "hidden");
            input2.setAttribute("name", "dept_id");
            input2.value = document.getElementById("dept_id_2").value;
            form.appendChild(input2);

            var input3 = document.createElement("input");
            input3.setAttribute("type", "hidden");
            input3.setAttribute("name", "faculty_name");
            input3.value = document.getElementById("faculty_name").value;
            form.appendChild(input3);

            var input4 = document.createElement("input");
            input4.setAttribute("type", "hidden");
            input4.setAttribute("name", "faculty_email");
            input4.value = document.getElementById("faculty_email").value;
            form.appendChild(input4);

            var input5 = document.createElement("input");
            input5.setAttribute("type", "hidden");
            input5.setAttribute("name", "password");
            input5.value = document.getElementById("password").value;
            form.appendChild(input5);

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
            xhttp.open("POST", "insert_faculty.php", true);
            // Send the form data
            xhttp.send(new FormData(form));
        
        }

        function SQL_DELETE_FACULTY() {
            var form = document.getElementById("delete_faculty");

            var input1 = document.createElement("input");
            input1.setAttribute("type", "hidden");
            input1.setAttribute("name", "faculty_id");
            input1.value = document.getElementById("faculty_id_delete").value;
            form.appendChild(input1);

            form.submit();
        }

        function UPDATE_FACULTY(Faculty_id) {
            document.getElementById("updateForm2").style.display = "block";
            document.getElementById("faculty_id_update").value = Faculty_id;
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