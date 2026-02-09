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
    $sql = "select student_id from students";
    $result = $conn->query($sql);

?>
<?php
    if(isset($_POST["confirm_student_delete"])){
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
            $conn->close();
            header("Location: admin_panel.php");
        }
        else{
            echo "could not delete";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
</head>
<body>
    <form method="POST">
        <select name="student_id">
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["student_id"]."'>".$row["student_id"]."</option>";
                }
            ?>
            <input type="submit" name="confirm_student_delete">
        </select>
    </form>
</body>
</html>
<?php
    $conn->close();
?>