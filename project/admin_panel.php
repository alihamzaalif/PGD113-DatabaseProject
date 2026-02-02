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
    <title>Admin Panel</title>
</head>
<body>
    <a href="view_students.php">View Students</a><br/>
    <a href="add_student.php">Add Student</a><br/>
    <a href="delete_student.php">Delete Student</a><br/>
    <a href="view_teachers.php">View Teachers</a><br/>
    <a href="add_teacher.php">Add Teacher</a><br/>
    <a href="view_courses.php">View Courses</a><br/>
    <a href="add_course.php">Add Course</a><br/>
    <a href="create_semester.php">Create Semester</a><br/>
    <a href="assign_courses.php">Assign Teacher to Course</a><br/>
    <a href="change_name.php">Change Name</a><br/>
    <a href="logout.php">LogOut</a>
</body>
</html>
<?php
    $conn->close();
?>