<?php
include './koneksi/koneksi.php';

    $dept_ot = $_GET['sdept_ot'];
    $date_ot = $_GET['sdate_ot'];
    $shift_ot = $_GET['sshift_ot'];
    $mulai_ot_akhir = $_GET['smulai_ot_akhir'];
    $akhir_ot_akhir = $_GET['sakhir_ot_akhir'];
    
    // tambahkan ke database   
    $add = mysqli_query($cnts,"INSERT INTO ot_akhir VALUES ('','$dept_ot','$date_ot','$shift_ot','$mulai_ot_akhir','$akhir_ot_akhir')");

?>
