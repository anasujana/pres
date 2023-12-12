<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    include './koneksi/koneksi.php';
    $id = $_POST['sid'];
    $finish= $_POST['sedit_wos'];
   
    $update = mysqli_query($cnts,"UPDATE wos SET finish='$finish' WHERE id='$id'");
    header('location: db_body1.php');

?>


</body>
</html>