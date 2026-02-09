<?php
    include("db.php")
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
    $teach_id=$_POST["teach_id"];$teach_id=htmlspecialchars($teach_id);
    $sql = "select * from grading_weights where teach_id='$teach_id'";
    $result = $conn->query( $sql );
?>
<?php
    if(isset($_POST["set_grade"])){
        $teach_id=$_POST["teach_id"];$teach_id=  htmlspecialchars($teach_id);
        $attendance = $_POST["attendance"]; $attendance = (float) htmlspecialchars($attendance);
        $ct_marks = $_POST["ct_marks"]; $ct_mark = (float) htmlspecialchars($ct_marks);
        $assignment = $_POST["assignment"]; $assignment = (float) htmlspecialchars($assignment);
        $midterm = $_POST["midterm"]; $midterm = (float) htmlspecialchars($midterm);
        $final = $_POST["final"]; $final = (float) htmlspecialchars($final);

        $sql = "UPDATE grading_weights SET attendance = $attendance, ct_marks = $ct_mark, assignment = $assignment, midterm = $midterm, final = $final WHERE teach_id = '$teach_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            $conn->close();
            header("Location: teacher_portal.php");

        } else {
            echo "Error updating record: " . $conn->error . "<br/>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading Settings</title>
</head>
<body>
    <h1>Set grading weights for the courses</h1>
    <h3>Make sure the total sum of the floats are equal to 1.</h3>
    <form method="POST">
    <table>
        <tr>
            <th>Attendance</th>
            <th>CT Marks</th>
            <th>Assignment</th>
            <th>Mid-Term</th>
            <th>Final</th>
        </tr>
        <tr>
                <?php
                    if($result->num_rows>0){
                        while($row = $result->fetch_assoc()){
                            echo "<td><input type='text' name='attendance' value='".$row["attendance"]."'></td>
                            <td><input type='text' name='ct_marks' value='".$row["ct_marks"]."'></td>
                            <td><input type='text' name='assignment' value='".$row["assignment"]."'></td>
                            <td><input type='text' name='midterm' value='".$row["midterm"]."'></td>
                            <td><input type='text' name='final' value='".$row["final"]."'></td>
                            <input type='hidden' name='teach_id' value='$teach_id'>
                            ";
                        }
                    }
                    else{
                        echo "No data can be shown";
                    }
                ?>
        </tr>
    </table>
    <input type="submit" name="set_grade">
    </form>
    <br/>
    <a href="logout.php">LogOut</a> <a href="teacher_portal.php">Teacher Portal</a>
</body>
</html>
