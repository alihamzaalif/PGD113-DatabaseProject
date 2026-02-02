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
    $student_id = $_POST["student_id"];
    $marksDelete = "delete from marks where student_id = '$student_id'";
    $gradingDelete = "delete from grading where student_id = '$student_id'";
    $enrollDelete = "delete from enroll where student_id = '$student_id'";
    $userID = "select user_id from students where student_id='$student_id'";
    $userIDResult = $conn->query("$userID");
    $userIDResult = $userIDResult->fetch_assoc();
    // echo"".$userIDResult["user_id"]."";
    $user_id = $userIDResult["user_id"];
    $studentIdDelete = "delete from students where student_id='$student_id'";
    $userDelete = "delete from users where user_id='$user_id'";
    if(($conn->query("$marksDelete")) and ($conn->query("$gradingDelete")) and ($conn->query("$enrollDelete")) and ($conn->query("$studentIdDelete")) and ($conn->query("$userDelete"))){
        echo "Delete sucessful";
        header("Location: admin_panel.php");
        $conn->close();
    }
    else{
        echo "could not delete";
        $conn->close();
    }
?>