<?php 
    include ("db.php");
?>
<?php
    session_start();
    $teacher_id = "";
    if (isset($_SESSION["token"])){
        $teacher_id = $_SESSION["token"];
        echo "".$teacher_id."";
    }
    else{
        echo "Token not found, please go back to login page";
    }
    $courses_sql = "select * from teaches where teacher_id='$teacher_id'";
    $courselist = $conn->query($courses_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal</title>
</head>
<body>
    <a href="grade_students.php">Grade Students</a></br>
    <table>
        <tr>
            <th>Course ID</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>
        <?php
            if($courselist->num_rows>0){
                while($row = $courselist->fetch_assoc()){
                    echo "<tr>
                        <td>".$row["course_id"]."<td>
                        <td>".$row["semester_name"]."<td>
                        <td><form action='grade_setting.php' method='POST'>
                        <input type='hidden' name='teach_id' value='".$row["teach_id"]."'>
                        <input type='submit' value='change grading'>
                        </form>
                        </td>
                    </tr>
                    ";
                }
            }
        ?>
    </table>
    <br/>
    <a href="logout.php">LogOut</a>
</body>
</html>
<?php
    $conn->close();
?>