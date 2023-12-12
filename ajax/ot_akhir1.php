<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="./../koneksi/adm.gif" width="100px" alt="" class="logo">

</body>
</html>
<?php
include './../koneksi/koneksi.php';


    $id_overtime_akhir = $_POST['sid_overtime_akhir'];
    $edit_overtime_akhir1 = $_POST['sedit_overtime_akhir1'];
    
    // edit   
     $edit_ot = mysqli_query($cnts,"UPDATE ot_akhir SET mulai='$edit_overtime_akhir1' WHERE id='$id_overtime_akhir'");

?>
