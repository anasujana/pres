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
    
    $id_d14 = $_POST['sid_d14'];
    $d14 = $_POST['sd14'];
     
    $update = mysqli_query($cnts,"UPDATE plan SET plan_produksi='$d14' WHERE id='$id_d14'");
?>

</body>
</html>