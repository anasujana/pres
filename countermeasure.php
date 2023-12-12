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
    
    $id_counter = $_POST['sid_counter'];
    $detail_prob = $_POST['sdetail_prob'];
     
    $update = mysqli_query($cnts,"UPDATE prob SET countermeasure='$detail_prob' WHERE id_prob_hasil='$id_counter'");
?>

</body>
</html>