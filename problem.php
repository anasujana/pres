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
    $tgl_prob = $_POST['stgl_prob'];
    $kategori = $_POST['skategori'];
    $jenis_problem = $_POST['sjenis_problem'];
    $sub_problem = $_POST['ssub_problem'];
    $area = $_POST['sarea'];
    $menit = $_POST['smenit'];
    $detail = $_POST['sdetail'];
     
    $add = mysqli_query($cnts,"INSERT INTO prob VALUES ('','$id_prob','$tgl_prob','$kategori','$jenis_problem','$sub_problem','$detail','','$menit','$area')");  
    $update = mysqli_query($cnts,"UPDATE target SET tgl_akhir='$tgl_edit' WHERE id='$id'");
?>

</body>
</html>