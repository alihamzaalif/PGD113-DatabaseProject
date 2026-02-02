<?php 
    include ("db.php");
?>
<?php
    session_start();
    $teacher_id = "";
    if (isset($_SESSION["token"])){
        $student_id = $_SESSION["token"];
        echo "".$student_id."<br/>";
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
    <title>Grades</title>
</head>
<body>
    <h1>Grades</h1>
    <table>
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Total</th>
            <th>Grade</th>
            <th>Semester</th>
        </tr>
        <?php
        $sql = "select grading.course_id, courses.course_name, total_marks, grade, semester_name from grading join courses on courses.course_id=grading.course_id where student_id='$student_id'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo"<tr>
                <td>".$row["course_id"]."</td>
                <td>".$row["course_name"]."</td>
                <td>".$row["total_marks"]."</td>
                <td>".$row["grade"]."</td>
                <td>".$row["semester_name"]."</td>
                </tr>";
            }
        }
        ?>
    </table><br/>
    <a href="logout.php">LogOut</a> <a href="student_portal.php">Student Portal</a>
</body>
</html>
<?php
    $conn->close();
?>