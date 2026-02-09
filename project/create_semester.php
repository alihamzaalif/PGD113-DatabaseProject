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
    if(isset($_POST["set_semester"])){
        $semester_name = $_POST["semester_name"]; $semester_name = htmlspecialchars($semester_name);
        $sql = "insert into semester values ('$semester_name')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            $conn->close();
            header("Location: admin_panel.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Semester</title>
</head>
<body>
    <form method="POST">
        Semester Name: <input type="text"name="semester_name"><br/>
        <input type="submit" name="set_semester">
    </form><br/>
    <a href="logout.php">LogOut</a> <a href="admin_panel.php">Admin Panel</a>
</body>
</html>
<?php
    $conn->close();
?>