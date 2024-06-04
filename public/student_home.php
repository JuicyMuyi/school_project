<?php
session_start();
include('../include/db.php');
//include('../include/student_auth.php'); 

$statement= $conn->prepare("SELECT * FROM students WHERE student_id=:sid");
$statement->bindParam(":sid", $_SESSION['student_id']); 
$statement->execute(); 

$sdata = $statement->fetchAll(PDO::FETCH_BOTH);



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Homepage</title>
</head>

<body>

<?php
//include("../include/student_header.php"); 
?>

   <div class="profile-container">
        <h3>Your Profile</h3>
        <table>
            <tr>
                <th>Name:</th>
                <td><?= $sdata[0]['student_name'] ?></td>
            </tr>
           
            <tr>
                <th>Email:</th>
                <td><?= $sdata[0]['email'] ?></td>
            </tr>
            <tr>
                <th>Department:</th>
                <td><?= $sdata[0]['department'] ?></td>
            </tr>
        </table>
</body>
</html>