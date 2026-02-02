<?php
include("db.php");
?>
<?php
    session_start();
    $admin = "";
    if (isset($_SESSION["token"])){
        $admin = $_SESSION["token"];
        echo "".$admin."<br/>";
    }
    else{
        echo "Token not found, please go back to login page";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <form action="commit_student.php" method="POST">
        userID: <input type="text" name="user_id"><br/>
        StudentID: <input type="text" name="student_id"><br/>
        Name: <input type="text" name="name"><br/>
        Batch: <input type="text" name="batch"><br/>
        Password: <input type="text" name="password"><br/>
        <input type="submit">
    </form><br/>
    <a href="logout.php">LogOut</a> <a href="admin_panel.php">Admin Panel</a>
</body>
</html>
<?php
    $conn->close();
?>