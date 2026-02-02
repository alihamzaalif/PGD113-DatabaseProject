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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
</head>
<body>
    <form action="confirm_student_delete.php" method="POST">
        <select name="student_id">
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["student_id"]."'>".$row["student_id"]."</option>";
                }
            ?>
            <input type="submit">
        </select>
    </form>
</body>
</html>
<?php
    $conn->close();
?>