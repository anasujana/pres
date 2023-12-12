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
    
    $tanggal = $_POST['stanggal'];
    $shift = $_POST['sshift'];

    $tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT *, FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='pagi' and `tg`.`jam_mulai`>='07:25' and `tg`.`jam_akhir`<='16:00' and `tg`.`dept`=1 and `star_day`='senin' ORDER BY `tg`.`jam` ASC"));
    $tgl=date("Y-m-d H:i:s");
    $id_hasil = strtotime($tgl);

     //loop
     $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=1");                    
     foreach($tabel AS $data){
         $type = $data['type'];
         $hasil = $_POST[$type];

     // tambahkan ke database   
    $add = mysqli_query($cnts,"INSERT INTO plan VALUES ('','$tanggal','$shift','$type','$hasil')");  
}

?>

</body>
</html>