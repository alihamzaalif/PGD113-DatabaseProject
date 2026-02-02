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
    $sql = "select user_id from users";
    $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Name</title>
</head>
<body>
    <form action="commit_change_name.php" method="POST">
        <select name="user_id">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row["user_id"]."'>".$row["user_id"]."</option>";
            }
            ?>
        </select>
        <input type="text" name="new_name">
        <input type="submit">
    </form>
</body>
</html>
<?php
    $conn->close();
?>