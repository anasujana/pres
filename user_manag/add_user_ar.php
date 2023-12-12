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
    include './../koneksi/koneksi.php';
    
    $npk = $_POST['snpk'];
    $nama = $_POST['snama'];
    $password = $_POST['spassword'];

     // tambahkan ke database   
     $add = mysqli_query($cnts,"INSERT INTO user VALUES ('$npk','$nama','$password')"); 
?>

</body>
</html>