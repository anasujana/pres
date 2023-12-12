<?php
include './koneksi/koneksi.php';

    $start = $_POST['swos_awal'];
    $tgl = $_POST['stgl_wos'];
    $shif = $_POST['sshift_wos'];
    $group_shif = $_POST['sgroup_shift'];
    $pic = $_POST['spic_wos'];
    
    // tambahkan ke database   
    $add = mysqli_query($cnts,"INSERT INTO wos VALUES ('','$group_shif','$shif','$tgl','$start','','$pic')");

    $lastrecord = mysqli_fetch_array(mysqli_query($cnts,"SELECT id FROM wos ORDER BY id DESC LIMIT 1"));
    $idx = $lastrecord['id'];

    $data = array(
        'id' => $idx
    );
    echo json_encode($data);
?>
