<?php 
    include ("db.php");
?>
<?php
    session_start();
    $student_id = "";
    if (isset($_SESSION["token"])){
        $student_id = $_SESSION["token"];
        echo "".$student_id."<br/>";
    }
    else{
        echo "Token not found, please go back to login page";
    }
?>
<?php
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
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: student_portal.php");
?>
