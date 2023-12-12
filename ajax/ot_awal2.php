<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="../../koneksi/adm.gif" width="100px" alt="" class="logo">

</body>
</html>
<?php
include './../koneksi/koneksi.php';


    $id_overtime_awal = $_POST['sid_overtime_awal'];
    $edit_overtime_awal2 = $_POST['sedit_overtime_awal2'];
    
    // edit   
    $edit_ot_awal = mysqli_query($cnts,"UPDATE ot_awal SET selesai='$edit_overtime_awal2' WHERE id='$id_overtime_awal'");

    // $edit_ot = mysqli_query($cnts,"UPDATE ot_awal SET selesai='$edit_overtime_awal2' WHERE id='$id_overtime_akhir'");

?>
