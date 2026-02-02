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
    $teach_id = $_POST["teach_id"]; $teach_id = htmlspecialchars($teach_id);
    $course_id = $_POST["course_id"]; $course_id = htmlspecialchars($course_id);
    $teacher_id = $_POST["teacher_id"]; $teacher_id = htmlspecialchars($teacher_id);
    $semester_name = $_POST["semester_name"]; $semester_name = htmlspecialchars($semester_name);
    $sql1="INSERT INTO teaches VALUES ('$teach_id', '$course_id', '$teacher_id', '$semester_name')";
    $sql2="INSERT INTO grading_weights (teach_id) VALUES ('$teach_id')";
    if (($conn->query($sql1) === TRUE) and ($conn->query($sql2) === TRUE)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: admin_panel.php");

?>
