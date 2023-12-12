<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>
<?php
include './../koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$tgl_shift=date('Y-m-d');
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
?>
<table class="table-bordered table-sm  text-center revisi" width="100%" cellspacing="0">
    <thead class="bg-secondary text-white">
        <tr>
            <?php
            $tabel22 = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=1"); 
            $jml_type =  mysqli_num_rows($tabel22);
            ?> 
            <th colspan="<?php  echo  $jml_type; ?>" data-toggle="modal"  data-target="#plan">TARGET PRODUKSI &ensp; <strong class="text-success" data-toggle="tooltip" data-placement="top" title="INPUT TARGET"><i class='fa fa-plus' aria-hidden='true'></i></strong></th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tr class="bg-white">
    <?php
    
    $plan = mysqli_query ($cnts,"SELECT *, (SELECT p.plan_produksi FROM plan p WHERE p.unit=t.type and p.tgl='$tgl' and p.shift='$shift' and t.dept=1) AS plan,
    (SELECT p.id FROM plan p WHERE p.unit=t.type and p.tgl='$tgl' and p.shift='$shift' and t.dept=1) AS id_plan
    FROM type_unit t where t.dept=1 ");                   
    foreach($plan AS $data){
        $id = $data['id_plan'];
        $jml = $data['plan'];
        $type1 = $data['type'];

        if((isset($jml) AND $jml != '')){
            $edit  = "<strong class='text-info' data-toggle='tooltip' data-placement='top' title='REVISI TARGET'><i class='fa fa-edit' aria-hidden='true'></i></strong>"; 
        }else{
        $edit = "<strong class='text-dark' data-toggle='tooltip' data-placement='top' title='REVISI TARGET'>-</strong>";
        }
    ?>
        <td class="rev" data-toggle="modal" data-id='<?php echo $id; ?>' data-target="#plan_d14"><?php echo $type1 ?>: <strong><?php echo $jml; ?></strong> &ensp; <?php echo $edit;?></td>  
    <?php
    }
    ?>
    <?php
        $tabel2 = mysqli_fetch_array(mysqli_query ($cnts,"SELECT SUM(plan_produksi)as tot FROM plan where tgl='$tgl' and shift='$shift'")); 
    
        if($tabel2['tot']!=''){
            $total = $tabel2['tot'];
        }else{
            $total = '-';
        }
    ?>
    <td><strong><?php  echo  $total; ?></strong></td> 
    </tr> 
                         
</table>
