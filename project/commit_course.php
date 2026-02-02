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
    $course_id = $_POST["course_id"]; $course_id=htmlspecialchars($course_id);
    $course_name = $_POST["course_name"]; $course_name=htmlspecialchars($course_name);

    $sql = "INSERT INTO courses VALUES ('$course_id', '$course_name')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $conn->close();
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
