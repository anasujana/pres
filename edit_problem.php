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
    
    $id_prob = $_POST['sid_prob'];
    $kategori = $_POST['sid'];
   
    $update = mysqli_query($cnts,"UPDATE prob SET menit_prob='$kategori' WHERE id_prob_hasil='$id_prob'");
?>

</body>
</html>