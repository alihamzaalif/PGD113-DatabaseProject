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
<?php
    if (isset($_POST["add_student"])){
        $role = "student";
        $user_id = $_POST["user_id"]; $user_id = htmlspecialchars($user_id);
        $student_id = $_POST["student_id"]; $student_id = htmlspecialchars($student_id);
        $name = $_POST["name"]; $name = htmlspecialchars($name);
        $batch = $_POST["batch"]; $batch = htmlspecialchars($batch);
        $password = $_POST["password"]; $password = htmlspecialchars($password);

        $sql1 = "insert into users VALUES('$user_id','$password','$role','$name')";
        $sql2 = "insert into students VALUES('$student_id','$user_id','$batch')";

        if (($conn->query($sql1) === TRUE) and ($conn->query($sql2) === TRUE)) {
            echo "New record created successfully";
            header("Location: admin_panel.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error."<br>";
        }
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
    <form method="POST">
        userID: <input type="text" name="user_id"><br/>
        StudentID: <input type="text" name="student_id"><br/>
        Name: <input type="text" name="name"><br/>
        Batch: <input type="text" name="batch"><br/>
        Password: <input type="text" name="password"><br/>
        <input type="submit" name="add_student">
    </form><br/>
    <a href="logout.php">LogOut</a> <a href="admin_panel.php">Admin Panel</a>
</body>
</html>
<?php
    $conn->close();
?>