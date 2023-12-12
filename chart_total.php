<?php
include './koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$tgl=date('Y-m-d');
$time=date('H:i');  

if($time>='07:15' and $time<='20:14'){
    $sif = 'pagi';
}else{
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

$target2 = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tanggal from hasil_unit order by tanggal desc limit 1 "));   
$target3= $target2['tanggal'];

// TOTAL
$tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT SUM(`hasil`) as 'total' FROM `hasil_unit` where `tanggal`='$tgl' and `shift`='$shift'"));                                                    
$hasil = $tabel['total'];
if($hasil==0){
    $hasil=0;
}else{
    $hasil = $tabel['total'];  
}

// INTERNAL
// $INTERNAL = mysqli_fetch_array(mysqli_query ($cnts,"SELECT SUM(`hasil`) as 'total' FROM `hasil_unit` left join prob on prob.id_prob=hasil_unit.id_hasil where `tanggal`='2023-02-08' and `shift`='A'"));                                                    
// $hasil = $INTERNAL['total'];
// if($hasil==0){
//     $hasil=0;
// }else{
//     $hasil = $tabel['total'];  
// }

$plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT SUM(plan_produksi)as targett FROM plan where tgl='$tgl' and shift='$sif' "));
$target= $plan['targett'];
      
// TOTAL
if($target==0){
    $passrate=0;
}else{
$passrate = ($hasil/$target)*100;
$passrate = round($passrate,1).' %';
}


// INTERNAL
if($target==0){
    $passrate=0;
}else{
$passrate = ($hasil/$target)*100;
$passrate = round($passrate,1).' %';
}

// $tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT SUM(`unit`) as 'total' FROM `efficiency`")); 
$tabel = mysqli_query($cnts,"SELECT unit FROM efficiency");
$hasill = mysqli_num_rows($tabel)                                                   
// $hasil = $tabel['total'];
// if($hasill==0){
//     $hasil=0;
// }else{
//     $hasil = $hasil;  
// }
?>
<!-- <table  class="table table-bordered text-center" width="20%">
    <thead>
        <th style="font-size:12px">TOTAL UNIT</th>
    </thead>
    <tbody>  -->
    <?php echo $hasill ; ?>
    <!-- </tbody>
</table> -->


