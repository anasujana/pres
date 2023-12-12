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
    $tgl_shift=date('Y-m-d');
    $time_now=date('H:i');

    if($time_now>='20:30' and $time_now<='23:59'){
        $shift = 'malam';
    }else if($time_now>='00:00' and $time_now<='07:14'){
        $shift = 'malam';
    }else if($time_now>='07:15' and $time_now<='20:29'){
        $shift = 'pagi';
    }   
    
    $id_d14 = $_POST['id_d14'];
    $d14 = $_POST['d14'];
    // $d26 = $_POST['d26'];
    // $d12= $_POST['d12'];

     //loop
    //  $plan1 = mysqli_query ($cnts,"SELECT id,unit FROM plan where tgl='$tgl_shift' and shift='$shift'");                    
    //  foreach($plan1 AS $data){
    //      $id = $data['id'];
    //      $terima_id = $_POST[$id];
    //      $plan_produksi = $data['unit'];
    //      $terima_plan_produksi = $_POST[$plan_produksi];
    $update = mysqli_query($cnts,"UPDATE plan SET plan_produksi='$d14' WHERE id='$id_d14'");
    // }
    $id_d26 = $_POST['id_d26'];
    $d26 = $_POST['d26'];
    $update = mysqli_query($cnts,"UPDATE plan SET plan_produksi='$d26' WHERE id='$id_d26'");

    $id_d12 = $_POST['id_d12'];
    $d12 = $_POST['d12'];
    $update = mysqli_query($cnts,"UPDATE plan SET plan_produksi='$d12' WHERE id='$id_d12'");
    header('location: db_body1.php');

?>


</body>
</html>