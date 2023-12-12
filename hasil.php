<?php
include './koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$tgl=date('Y-m-d');
$time=date('H:i');  

if($time>='07:15' and $time<='20:14'){
    $sif = 'pagi';
}else if($time>='20:30' and $time<='07:14'){
    $sif = 'malam';
}
                                        
$tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT day,night FROM shift_kerja where tanggal='$tgl'"));                    
$day = $tabel ['day'];
$night = $tabel ['night'];
if($time>='20:30' and $time<='23:59'){
    $shift = $night;
}else if($time>='00:00' and $time<='07:14'){
    $shift = $night;
}else if($time>='07:15' and $time<='20:29'){
    $shift = $day;
}   

$hasil = mysqli_fetch_array(mysqli_query ($cnts,"SELECT `type_unit`, SUM(`hasil`) as 'total' FROM `hasil_unit` where `tanggal`='$tgl' and `shift`='$shift' and `type_unit`='d14'"));                                                    
$terios = $hasil['total'];
$hasil = mysqli_fetch_array(mysqli_query ($cnts,"SELECT `type_unit`, SUM(`hasil`) as 'total' FROM `hasil_unit` where `tanggal`='$tgl' and `shift`='$shift' and `type_unit`='d26'"));                                                    
$xeva = $hasil['total'];
$hasil = mysqli_fetch_array(mysqli_query ($cnts,"SELECT `type_unit`, SUM(`hasil`) as 'total' FROM `hasil_unit` where `tanggal`='$tgl' and `shift`='$shift' and `type_unit`='d12'"));                                                    
$xenia = $hasil['total'];
$tot = $terios+$xeva+$xenia;

$tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT SUM(`hasil`) as 'total' FROM `hasil_unit` where `tanggal`='$tgl' and `shift`='$shift'"));                                                    
$hasil = $tabel['total'];
if($hasil==0){
    $hasil=0;
}else{
    $hasil = $tabel['total'];  
}
?>

<table class="table table-bordered text-center">
    <thead>
        <th style="font-size:12px">D26</th>
        <th style="font-size:12px">D14</th>
        <!-- <th>total</th> -->
    </thead>
    <tbody>
        <td style="font-size:20px"><img src="assets/images/xenia-new.png" width="40px" class="hasil"> <?php echo $terios; ?></td>
        <td style="font-size:20px"><img src="assets/images/terios.png" width="70px" class="hasil"><?php echo $xeva; ?></td>
        <!-- <td style="font-size:20px"><?php echo $hasil; ?></td> -->
    </tbody>
</table>

