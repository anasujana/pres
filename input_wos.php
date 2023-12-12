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
?>

<table class="table-bordered table-sm text-center wosss" id="tablee" width="100%" cellspacing="0">
    <thead class="bg-secondary text-white">
        <tr>
            <th colspan="2" class='finish' data-toggle="modal" data-id='<?php echo $id; ?>' data-start='<?php echo $start; ?>' 
            data-finish='<?php echo $finish; ?>' data-target="#finish">START & FINISH WOS</th>
        </tr>
    </thead>
    <tr class="bg-white">
        <td data-toggle="modal" data-target="#wos">START : <?php echo $start; ?></td> 
        <td class='finish' data-toggle="modal" data-id='<?php echo $id; ?>' data-start='<?php echo $start; ?>' 
            data-finish='<?php echo $finish; ?>' data-target="#finish" >FINISH : <?php echo $finish; ?></td>
    </tr>                             
</table>

