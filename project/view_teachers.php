<?php
include("db.php");
?>
<?php
    session_start();
    $admin = "";
    if (isset($_SESSION["token"])){
        $admin = $_SESSION["token"];
        echo "".$admin."";
    }
    else{
        echo "Token not found, please go back to login page";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teachers</title>
</head>
<body>
    <table>
        <tr>
            <th>Teacher_ID</th>
            <th>User_ID</th>
            <th>Name</th>
        </tr>
        <?php
            $sql = "select teachers.teacher_id, users.user_id, users.name from teachers, users where teachers.user_id=users.user_id";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    echo "<tr>
                    <td>".$row["teacher_id"]."</td>
                    <td>".$row["user_id"]."</td>
                    <td>".$row["name"]."</td>
                    </tr>";
                }
            }
        ?>
    </table><br/>
    <a href="logout.php">LogOut</a> <a href="admin_panel.php">Admin Panel</a>
</body>
</html>
<?php
    $conn->close();
?>