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

$ot = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,mulai,selesai FROM ot_awal where tgl='$tgl' and shift='$shift'"));
$id_mulai= $ot['id'];
$awal_mulai= $ot['mulai'];
$awal_akhir= $ot['selesai'];  

$ot_akhir = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,mulai,selesai FROM ot_akhir where tgl='$tgl' and shift='$shift'"));
$id_akhir= $ot_akhir['id'];
$akhir_mulai= $ot_akhir['mulai'];
$akhir_akhir= $ot_akhir['selesai'];

if($awal_mulai==0){
    $awal_mulai = '-';
    $awal_akhir = '-'; 
    
    }else{
    $awal_mulai = date("H:i",strtotime ($awal_mulai)).'&ensp;&ensp;<strong class="text-info" data-toggle="tooltip" data-placement="top" title="REVISI OVERTIME">
    <i class="fa fa-edit edit1" aria-hidden="true" data-toggle="modal" data-id_awal='.$id_mulai.' data-target="#revisi_awal_awal"></i></strong>'; 
    $awal_akhir = date("H:i",strtotime ($awal_akhir)).'&ensp;&ensp;<strong class="text-info" data-toggle="tooltip" data-placement="top" title="REVISI OVERTIME">
    <i class="fa fa-edit edit1" aria-hidden="true" data-toggle="modal" data-id_awal='.$id_mulai.' data-target="#revisi_awal_akhir"></i></strong>'; ;
    }

    if($akhir_mulai==0){
    $akhir_mulai  = '-'; 
    $akhir_akhir = '-';
    
    }else{
    $akhir_mulai = date("H:i",strtotime ($akhir_mulai)).'&ensp;&ensp;<strong class="text-info" data-toggle="tooltip" data-placement="top" title="REVISI OVERTIME">
    <i class="fa fa-edit edit" aria-hidden="true" data-toggle="modal" data-id_akhir='.$id_akhir.' data-target="#revisi_akhir_awal"></i></strong>'; ; 
    $akhir_akhir = date("H:i",strtotime ($akhir_akhir)).'&ensp;&ensp;<strong class="text-info" data-toggle="tooltip" data-placement="top" title="REVISI OVERTIME">
    <i class="fa fa-edit edit" aria-hidden="true" data-toggle="modal" data-id_akhir='.$id_akhir.' data-target="#revisi_akhir_akhir"></i></strong>'; ;
    }

    $id = $_GET['id'];

    if($id == 1){
        echo $awal_mulai;
    }else if($id == 2){
        echo $awal_akhir;
    }else if($id == 3){
        echo $akhir_mulai;
    }else if($id == 4){
        echo $akhir_akhir;
    }
                        
?>
        