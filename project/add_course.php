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
if (isset($_POST["commit_course"])){
    $course_id = $_POST["course_id"]; $course_id=htmlspecialchars($course_id);
    $course_name = $_POST["course_name"]; $course_name=htmlspecialchars($course_name);

    $sql = "INSERT INTO courses VALUES ('$course_id', '$course_name')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $conn->close();
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
</head>
<body>
    <form method="POST">
        Course ID:<input type="text" name="course_id"><br/>
        Course Name:<input type="text" name="course_name"><br/>
        <input type="submit" name="commit_course">
    </form><br/>
    <a href="logout.php">LogOut</a> <a href="admin_panel.php">Admin Panel</a>
</body>
</html>
<?php
    $conn->close();
?>