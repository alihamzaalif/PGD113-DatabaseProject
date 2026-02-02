<?php
    include ("db.php");
    session_start();
?>

<?php
    $username = $_POST["username"]; $username = htmlspecialchars($username);
    $password = $_POST["password"]; $password = htmlspecialchars($password);
    $sqlq = "select user_id, password, role, name from users where user_id='$username'";
    $result = $conn->query($sqlq);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($password == $row["password"]) {
            $role = $row["role"];
            if($role=="admin"){
                echo "Welcome admin";
                $_SESSION["token"]="admin";
                $conn->close();
                header("Location: admin_panel.php");
            }
            elseif($role=="teacher"){
                echo "Welcome dear ".$row["name"]." faculty"."<br/>";
                $sql2 = "select teacher_id from teachers where user_id='$username'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    $teacher_id = $row2['teacher_id'];
                    $_SESSION["token"] = $teacher_id;
                }
                echo "Your teacher_id is ".$teacher_id."<br/>";
                echo "<a href='teacher_portal.php'>Go to Portal</a>";
            }
            elseif($role== "student"){
                echo "Welcom dear student ".$row["name"]."<br/>";
                $sql2 = "select student_id from students where user_id='$username'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    $student_id = $row2['student_id'];
                    $_SESSION["token"] = $student_id;
                }
                echo "Your student_id is ".$student_id."<br/>";
                echo "<a href='student_portal.php'>Go to Portal</a>";
            }
            else{
                echo "Error, something went wrong";
            }
        } else {
            echo "please input valid password";
        }
        
    } 
    else {
        echo "Invalid username and password";
    }
    $conn->close();
?>