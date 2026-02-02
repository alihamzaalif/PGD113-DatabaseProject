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
    $semester_name = $_POST["semester_name"]; $semester_name = htmlspecialchars($semester_name);
    $sql = "insert into semester values ('$semester_name')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $conn->close();
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>