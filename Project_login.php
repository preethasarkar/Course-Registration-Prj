<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>ONLINE COURSE REGISTRATION SYSTEM</h1>
    <h2>PLEASE LOGIN TO ENTER</h2>

    <div>
        <h3 onclick="toggleoptions('admin')">Admin Login</h3>
    </div>

    <div>
        <h3>Student Login</h3>
    </div>
    
    <div>
        <h3>Teacher Login</h3>
    </div>
    
    <script>
        function toggleoptions(type){
            window.location.href='index.php';
        }
    </script>
</body>
</html>