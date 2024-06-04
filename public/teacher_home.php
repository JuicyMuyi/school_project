<?php
session_start();
//include '../include/teacher_auth.php';
include '../include/db.php';

// fetch teacher's data
$statement = $conn->prepare("SELECT * FROM teachers WHERE teacher_id=:tid");
$statement->bindParam(":tid", $_SESSION['teacher_id']);
$statement->execute();

$tdata = $statement->fetchAll(PDO::FETCH_ASSOC); // Use FETCH_ASSOC to fetch associative array

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's Homepage</title>
  
</head>

<body>
    <?php
    //include '../include/teacher_header.php';
    ?>

    <div class="profile-container">
        <h3>Your Profile</h3>
        <table>
            <?php foreach ($tdata as $value) : ?>
                <tr>
                    <th>Name:</th>
                    <td><?= $tdata['teacher_name'] ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?= $tdata['email'] ?></td>
                </tr>
                <tr>
                    <th>Department:</th>
                    <td><?= $tdata['department_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>
