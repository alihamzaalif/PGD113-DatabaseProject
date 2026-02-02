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
    $attendance = $_POST["attendance"]; $attendance = (float) htmlspecialchars( $attendance );
    $attendance_outof = $_POST["attendance_outof"]; $attendance_outof = (float) htmlspecialchars( $attendance_outof );
    $ct_marks = $_POST["ct_marks"]; $ct_marks = (float) htmlspecialchars($ct_marks);
    $ct_marks_outof = $_POST["ct_marks_outof"]; $ct_marks_outof = (float) htmlspecialchars($ct_marks_outof);
    $assignment = $_POST["assignment"]; $assignment = (float) htmlspecialchars($assignment);
    $assignment_outof = $_POST["assignment_outof"]; $assignment_outof = (float) htmlspecialchars($assignment_outof);
    $midterm = $_POST["mid_term"]; $midterm = (float) htmlspecialchars($midterm);
    $midterm_outof = $_POST["mid_term_outof"]; $midterm_outof = (float) htmlspecialchars($midterm_outof);
    $final = $_POST["final"]; $final = (float) htmlspecialchars( $final );
    $final_outof = $_POST["final_outof"]; $final_outof = (float) htmlspecialchars( $final_outof );
    $course_id = $_POST["course_id"]; $course_id = htmlspecialchars($course_id);
    $semester_name = $_POST["semester_name"]; $semester_name = htmlspecialchars($semester_name);
    $student_id = $_POST["student_id"]; $student_id = htmlspecialchars($student_id);
    $teach_id = "";
    $statement = "select teach_id from teaches where course_id='$course_id' and semester_name='$semester_name'";
    $state_result = $conn->query($statement);
    if($state_result->num_rows>0){
        while($row = $state_result->fetch_assoc()){
            $teach_id = htmlspecialchars($row["teach_id"]);
        }
    }
    $total_mark = (float) htmlspecialchars("0");
    $sql = "select * from grading_weights where teach_id='$teach_id'";
    $result = $conn->query($sql);
    if($result->num_rows> 0){
        while($row = $result->fetch_assoc()){
            $total_mark = (((100/$attendance_outof)*$attendance)*$row["attendance"])+(((100/$ct_marks_outof)*$ct_marks)*$row["ct_marks"]) + (((100/$assignment_outof)*$assignment)*$row["assignment"]) + (((100/$midterm_outof)*$midterm)*$row["midterm"]) + (((100/$final_outof)*$final)*$row["final"]);
        }
    }
    $marks_set = "UPDATE marks SET attendance = $attendance, ct_marks = $ct_marks, assignment = $assignment, midterm = $midterm, final = $final WHERE student_id = '$student_id' and teach_id = '$teach_id'";
    if ($conn->query($marks_set) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
    }
    $grade = "";
    $gpa = (float) htmlspecialchars("0");
    if($total_mark>=80){
        $grade="A+";
        $gpa = 4.0;
    }
    elseif($total_mark<80 && $total_mark>=75){
        $grade="A";
        $gpa = 3.75;
    }
    elseif($total_mark<75 && $total_mark>=70){
        $grade="A-";
        $gpa = 3.5;
    }
    elseif($total_mark<70 && $total_mark>=65){
        $grade="B+";
        $gpa = 3.25;
    }
    elseif($total_mark<65 && $total_mark>=60){
        $grade="B";
        $gpa = 3.0;
    }
    elseif($total_mark<60 && $total_mark>=55){
        $grade="B-";
        $gpa = 2.75;
    }
    elseif($total_mark<55 && $total_mark>=50){
        $grade="C+";
        $gpa = 2.5;
    }
    elseif($total_mark<50 && $total_mark>=45){
        $grade="C";
        $gpa = 2.25;
    }
    elseif($total_mark<45 && $total_mark>=40){
        $grade="D";
        $gpa = 2.0;
    }
    else{
        $grade="F";
        $gpa = 0.0;
    }
    $grade_set = "UPDATE grading SET total_marks = $total_mark, grade = '$grade', gpa=$gpa WHERE student_id = '$student_id'";
    if ($conn->query($grade_set) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
    }
?>
<?php
    $conn->close();
    header("Location: teacher_portal.php")
?>