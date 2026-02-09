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
    $courseSql = "select courses.course_id from courses where course_id not in (select course_id from teaches)";
    $courseSqlResult = $conn->query($courseSql);
    $teacherSql = "select teacher_id from teachers";
    $teacherSqlResult = $conn->query($teacherSql);
    $semSql = "select semester_name from semester";
    $semSqlResult = $conn->query($semSql);
?>
<?php
    if(isset($_POST["set_assign_courses"])){
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
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Course</title>
</head>
<body>
    <form method="POST">
        Teach ID:<input type="text" name="teach_id"><br/>
        <select name="course_id">
            <?php
                if($courseSqlResult->num_rows>0){
                    while($row= $courseSqlResult->fetch_assoc()){
                        echo "<option value='".$row["course_id"]."'>".$row["course_id"]."</option>";
                    }
                }
            ?>
        </select><br/>
        <select name="teacher_id">
            <?php
                if($teacherSqlResult->num_rows>0){
                    while($row2= $teacherSqlResult->fetch_assoc()){
                        echo "<option value='".$row2["teacher_id"]."'>".$row2["teacher_id"]."</option>";
                    }
                }
            ?>
        </select><br/>
        <select name="semester_name">
            <?php
                if($semSqlResult->num_rows>0){
                    while($row3= $semSqlResult->fetch_assoc()){
                        echo "<option value='".$row3["semester_name"]."'>".$row3["semester_name"]."</option>";
                    }
                }
            ?>
        </select><br/>
        <input type="submit" name="set_assign_courses">
    </form>
    </form>
    <br/>
    <a href="logout.php">LogOut</a> <a href="admin_panel.php">Admin Panel</a>
</body>
</html>
<?php
    $conn->close();
?>