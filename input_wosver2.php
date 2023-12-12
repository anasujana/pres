<?php
include './koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

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
   
$wos = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,group_shift,shift,tgl,start,finish,pic FROM wos where tgl='$tgl' and shift='$shift'"));
$id= $wos['id'];
$start= $wos['start'];  
$finish= $wos['finish'];             

$id = $_GET['id'];

if((isset($start) AND $start != '')){
$add ="";
}else{
$add = "<i class='fa fa-plus text-success' aria-hidden='true'></i>";
}

if((isset($finish) AND $finish != '')){
$addd ="";
}else{
$addd = "<i class='fa fa-plus text-success' aria-hidden='true'></i>";
}

if($id == 1){
    echo '<strong class="text-success" data-toggle="tooltip" data-placement="top" title="INPUT START WOS">'.'&ensp;'. $add.'</strong>'.$start;
}elseif($id == 2){
    echo '<strong class="text-success" data-toggle="tooltip" data-placement="top" title="INPUT FINISH WOS">'.'&ensp;'. $addd.'</strong>'.$finish;
    
}

?>


