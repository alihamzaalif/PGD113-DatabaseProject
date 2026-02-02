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
    $user_id = $_POST["user_id"]; $user_id = htmlspecialchars($user_id);
    $new_name = $_POST["new_name"]; $new_name = htmlspecialchars($new_name); 
    $sql = "UPDATE users SET name = '$new_name' WHERE user_id = '$user_id'";
    if($conn->query($sql)){
        echo "update successful";
        $conn->close();
        echo $user_id." ".$new_name;
        header("Location: admin_panel.php");
    }


    $conn->close();
?>