<?php
session_start();
include("../include/db.php");


if (isset($_POST['login'])) {

    $error = array();

    if (empty($_POST['email'])) {
        $error['email'] = "Enter Email Address linked to your account";
    }
	 if (empty($_POST['hash'])) {
        $error['hash'] = "Enter Password";
    }
  

    if (empty($error)) {

        $stmt = $conn->prepare("SELECT * FROM teachers WHERE email=:em");
        $stmt->bindParam(":em", $_POST['email']);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_BOTH);

        if ($stmt->rowCount() > 0 && password_verify($_POST['hash'], $row['hash'])) {
            $_SESSION['student_id'] = $row['student_id'];
            $_SESSION['student_name'] = $row['fullname'];
            header("location:teacher_home.php");
            exit();
        } else {
            header("location:teacher_login.php?error=Either the Email or the Password Incorrect");
        }
    }
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<h3>Login Here</h3>
 <form action="" method="post">
 
 <?php
 
        if (isset($_GET['message'])) {
            echo '<p class="message">'.$_GET['message'] . '</p>';
        }
        if (isset($_GET['error'])) {
            echo '<p class="alert">'.$_GET['error'] .'</p>';
        }
        if (isset($error)) {
            foreach ($error as $value) {
                echo '<p class="alert">'.$value.'</p>';
            }
        }
	?>
    
     <p>Email: <input type="text" name="email"></p>

        <p>Password: <input type="password" name="hash"></p>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>