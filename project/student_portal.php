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
    <title>Student Portal</title>
</head>
<body>
        <h1>Student Portal</h1>
        <p>Welcome <?php 
        echo $student_id?></p><br/>
        <p>Your CGPA is: 
            <?php 
            $sql = "select avg(gpa) from grading where student_id='$student_id' AND grade IS NOT NULL";
            $result =$conn->query($sql);
            $gpa = (float) 0.0;
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $gpa = $row["avg(gpa)"];
                }
            }
            echo "".$gpa."";
            ?>
        </p><br/>
        <a href="view_grades.php">View Grades</a><br/>
        <a href="enroll_course.php">Enroll Course</a>
        <br/>
    <a href="logout.php">LogOut</a>
</body>
</html>
<?php
    $conn->close();
?>