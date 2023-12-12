<?php
include '../../koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$wos = array();
$row = 0;

$time_now=date('H:i');

if($time_now>='00:00' and $time_now<='07:15'){
    $tgl= date('Y-m-d', strtotime('-1 days'));
}else if($time_now>='07:15' and $time_now<='23:59'){
    $tgl=date('Y-m-d');  
}  

if($time_now>='20:30' and $time_now<='23:59'){
    $shift = 'malam';
}else if($time_now>='00:00' and $time_now<='07:14'){
    $shift = 'malam';
}else if($time_now>='07:15' and $time_now<='20:29'){
    $shift = 'pagi';
}   
   
$woss = mysqli_query ($cnts,"SELECT id,group_shift,shift,tgl,start,finish,pic FROM wos where tgl='$tgl' and shift='$shift'");   

foreach($woss AS $data){
    $id = $data['id'];
    $start = $data['start'];
    $finish = $data['finish'];
    
    $wos[$row][0]=$start;
    $wos[$row][1]=$finish;
    $row++;
}

$data = array(
            'data' => $wos         
            );
echo json_encode($data);
?>