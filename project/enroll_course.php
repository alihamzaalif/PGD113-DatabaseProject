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
<?php
    if (isset($_POST["set_enrollment"])){
        $course_id = $_POST["course_id"]; $course_id = htmlspecialchars($course_id);
        $semester_name = $_POST["semester_name"]; $semester = htmlspecialchars($semester_name);
        $teach_id = "";
        $getTeachID = "select teach_id from teaches where course_id='$course_id' and semester_name='$semester_name'";
        $teach_idResult = $conn->query($getTeachID);
        if( $teach_idResult->num_rows > 0){
            while($row = $teach_idResult->fetch_assoc()){
                $teach_id = htmlspecialchars($row["teach_id"]);
            }
        }
        $sql = "INSERT INTO enroll VALUES ('$student_id','$course_id','$semester_name')";
        $sql2 = "INSERT INTO grading (student_id, teach_id, course_id, semester_name) VALUES ('$student_id', '$teach_id', '$course_id','$semester_name')";
        $sql3 = "INSERT INTO marks (student_id, teach_id) VALUES ('$student_id', '$teach_id')";
        if (($conn->query($sql) === TRUE) and ($conn->query($sql2) === TRUE) and ($conn->query($sql3) === TRUE)) {
            echo "New record created successfully";
            $conn->close();
            header("Location: student_portal.php");
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
    <title>Grades</title>
</head>
<body>
    <h1>Enroll Course</h1>
    <?php 
        $sql = "select course_id, course_name from courses where course_id not in (select course_id from enroll where student_id='$student_id')";
        $result =$conn->query($sql);
        $semSql = "select semester_name from semester";
        $semSqlResult = $conn->query($semSql);
    ?>
    <form method="POST">
        <select name="course_id">
            <?php
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo "<option value='".$row["course_id"]."'>".$row["course_id"]."</option>";
                    }
                }
            ?>
        </select><br/>
        <select name="semester_name">
            <?php
                if($semSqlResult->num_rows>0){
                    while($row2=$semSqlResult->fetch_assoc()){
                        echo "<option value='".$row2["semester_name"]."'>".$row2["semester_name"]."</option>";
                    }
                }
            ?>
        </select><br/>
        <input type="submit" name="set_enrollment">
    </form>
    <a href="logout.php">LogOut</a> <a href="student_portal.php">Student Portal</a>
</body>
</html>
<?php
    $conn->close();
?>