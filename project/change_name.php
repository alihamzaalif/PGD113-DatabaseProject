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
<?php
    if(isset($_POST["commit_change_name"])){
        $user_id = $_POST["user_id"]; $user_id = htmlspecialchars($user_id);
        $new_name = $_POST["new_name"]; $new_name = htmlspecialchars($new_name); 
        $sql = "UPDATE users SET name = '$new_name' WHERE user_id = '$user_id'";
        if($conn->query($sql)){
            echo "update successful";
            $conn->close();
            echo $user_id." ".$new_name;
            header("Location: admin_panel.php");
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Name</title>
</head>
<body>
    <form method="POST">
        <select name="user_id">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row["user_id"]."'>".$row["user_id"]."</option>";
            }
            ?>
        </select>
        <input type="text" name="new_name">
        <input type="submit" name="commit_change_name">
    </form>
</body>
</html>
<?php
    $conn->close();
?>