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
    $course_id = $_POST["course_id"]; $course_id = htmlspecialchars($course_id);
    $semester_name = $_POST["semester_name"]; $semester_name = htmlspecialchars($semester_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Student</title>
</head>
<body>
    <form action="marking.php" method="POST">
        <select name="student_id">
            <?php
                $sql = "select student_id from enroll where course_id = '$course_id' and semester_name = '$semester_name'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row=$result->fetch_assoc()){
                        echo "<option value='".$row["student_id"]."'>".$row["student_id"]."</option>";
                    }
                }
            ?>
        </select>
        <?php
            echo "<input type='hidden' name='course_id' value='$course_id'>";
            echo "<input type='hidden' name='semester_name' value='$semester_name'>";
        ?>
        <input type="submit">
    </form>
    <br/>
    <a href="logout.php">LogOut</a>
</body>
<br/>
    <a href="logout.php">LogOut</a> <a href="teacher_portal.php">Teacher Portal</a>
</html>
<?php
    $conn->close();
?>