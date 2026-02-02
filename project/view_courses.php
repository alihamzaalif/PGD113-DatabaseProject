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
    <title>View Courses</title>
</head>
<body>
    <table>
        <tr>
            <th>Course_ID</th>
            <th>Course Name</th>
            <th>Teach ID</th>
            <th>Teacher ID</th>
            <th>Teacher Name</th>
        </tr>
        <?php
            $sql = "select courses.course_id, courses.course_name, teaches.teach_id, teaches.teacher_id, users.name from courses left join teaches on courses.course_id = teaches.course_id left join teachers on teaches.teacher_id=teachers.teacher_id left join users on teachers.user_id = users.user_id;";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    echo "<tr>
                    <td>".$row["course_id"]."</td>
                    <td>".$row["course_name"]."</td>
                    <td>".$row["teach_id"]."</td>
                    <td>".$row["teacher_id"]."</td>
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