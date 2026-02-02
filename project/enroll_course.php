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
    <h1>Enroll Course</h1>
    <?php 
        $sql = "select course_id, course_name from courses where course_id not in (select course_id from enroll where student_id='$student_id')";
        $result =$conn->query($sql);
        $semSql = "select semester_name from semester";
        $semSqlResult = $conn->query($semSql);
    ?>
    <form action="set_enrollment.php" method="POST">
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
        <input type="submit">
    </form>
    <a href="logout.php">LogOut</a> <a href="student_portal.php">Student Portal</a>
</body>
</html>
<?php
    $conn->close();
?>