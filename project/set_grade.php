<?php
    include("db.php")
?>
<?php
    session_start();
    $teacher_id = "";
    if (isset($_SESSION["token"])){
        $teacher_id = $_SESSION["token"];
        echo "".$teacher_id."<br/>";
    }
    else{
        echo "Token not found, please go back to login page";
    }
    $teach_id=$_POST["teach_id"];$teach_id=  htmlspecialchars($teach_id);
    $attendance = $_POST["attendance"]; $attendance = (float) htmlspecialchars($attendance);
    $ct_marks = $_POST["ct_marks"]; $ct_mark = (float) htmlspecialchars($ct_marks);
    $assignment = $_POST["assignment"]; $assignment = (float) htmlspecialchars($assignment);
    $midterm = $_POST["midterm"]; $midterm = (float) htmlspecialchars($midterm);
    $final = $_POST["final"]; $final = (float) htmlspecialchars($final);

    $sql = "UPDATE grading_weights SET attendance = $attendance, ct_marks = $ct_mark, assignment = $assignment, midterm = $midterm, final = $final WHERE teach_id = '$teach_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: teacher_portal.php");

    } else {
        echo "Error updating record: " . $conn->error;
    }
?>
<?php
    $conn->close();
?>