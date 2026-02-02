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
    $role = "teacher";
    $user_id = $_POST["user_id"]; $user_id = htmlspecialchars($user_id);
    $teacher_id = $_POST["student_id"]; $student_id = htmlspecialchars($student_id);
    $name = $_POST["name"]; $name = htmlspecialchars($name);
    $password = $_POST["password"]; $password = htmlspecialchars($password);

    $sql1 = "insert into users VALUES('$user_id','$password','$role','$name')";
    $sql2 = "insert into teachers VALUES('$teacher_id','$user_id')";

    if (($conn->query($sql1) === TRUE) and ($conn->query($sql2) === TRUE)) {
        echo "New record created successfully";
        $conn->close();
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
