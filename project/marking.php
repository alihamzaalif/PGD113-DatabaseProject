<?php 
    include ("db.php");
?>
<?php
    session_start();
    $teacher_id = "";
    if (isset($_SESSION["token"])){
        $teacher_id = $_SESSION["token"];
    }
    else{
        echo "Token not found, please go back to login page";
    }
    $student_id = $_POST["student_id"]; $student_id = htmlspecialchars($student_id);
    $course_id = $_POST["course_id"]; $course_id = htmlspecialchars($course_id);
    $semester_name = $_POST["semester_name"]; $semester_name = htmlspecialchars($semester_name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Numbers</title>
</head>
<body>
    <h1>Mark everything out of 100</h1>
    <form action="setting_marks.php" method="POST">
        <Table>
            <tr>
                <th>Particulars</th>
                <th>Marks</th>
                <th>Out Of</th>
            </tr>
            <tr>
                <td>Attendance:</td>
                <td><input type="text" name="attendance"></td>
                <td><input type="text" name="attendance_outof"></td>
            </tr>
            <tr>
                <td>CT Marks:</td>
                <td><input type="text" name="ct_marks"></td>
                <td><input type="text" name="ct_marks_outof"></td>
            </tr>
            <tr>
                <td>Assignment:</td>
                <td><input type="text" name="assignment"></td>
                <td><input type="text" name="assignment_outof"></td>
            </tr>
            <tr>
                <td>Mid Term:</td>
                <td><input type="text" name="mid_term"></td>
                <td><input type="text" name="mid_term_outof"></td>
            </tr>
            <tr>
                <td>Final:</td>
                <td><input type="text" name="final"></td>
                <td><input type="text" name="final_outof"></td>
            </tr>
        </Table>
        <?php
            echo "<input type='hidden' name='student_id' value='$student_id'>";
            echo "<input type='hidden' name='course_id' value='$course_id'>";
            echo "<input type='hidden' name='semester_name' value='$semester_name'>";
        ?>
        <input type="submit">
    </form>
    <br/>
    <a href="logout.php">LogOut</a> <a href="teacher_portal.php">Teacher Portal</a>x
</body>
</html>
<?php
    $conn->close();
?>