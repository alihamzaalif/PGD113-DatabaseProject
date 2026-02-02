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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Course</title>
</head>
<body>
    <form action="select_grading.php" method="POST">
        <table>
            <tr>
                <th>Course ID</th>
                <th>Semester</th>
            </tr>
            <tr>
                <td><select name="course_id">
                    <?php
                        $sql = "select * from teaches where teacher_id='$teacher_id'";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while( $row = $result->fetch_assoc() ){
                                echo "<option value='".$row["course_id"]."'>".$row["course_id"]."</option>";
                            }
                        }
                    ?>
                </select></td>
                <td><select name="semester_name">
                    <?php
                        $sql = "select semester_name from teaches where teacher_id='$teacher_id'";
                        $result= $conn->query($sql);
                        if($result->num_rows > 0){
                            while( $row = $result->fetch_assoc() ){
                                echo "<option value='".$row["semester_name"]."'>".$row["semester_name"]."</option>";
                            }
                        }
                    ?>
                </select></td>
            </tr>
        </table>
      
    <input type="submit">
    </form>
    <br/>
    <a href="logout.php">LogOut</a> <a href="teacher_portal.php">Teacher Portal</a>
</body>
</html>
<?php
    $conn->close();
?>