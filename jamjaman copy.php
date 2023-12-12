<?php
include './koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

    $tgl=date('Y-m-d');
    $time=date('H:i');
    $day = date('l', strtotime($tgl));

    // echo $tgl."<br>";
    // echo  $time."<br>";

    // $day = date('l', strtotime($tgl));

    // echo $day;

    // if($day=="Friday"){
    //     $hari ="yes";
    // }else if($day!=="Friday"){
    //     $hari="no";
        
    // }
    // echo $hari;
    
    if($time>='07:15' and $time<='20:29'){
        $sif = 'pagi';
    }else{
        $sif = 'malam';
    }

    $target2 = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tanggal from hasil_unit order by tanggal desc limit 1 "));   
    $target3= $target2['tanggal'];

    if(isset($_GET['mulai_ot_awal'])){
        $terima_mulai_ot = $_GET['mulai_ot_awal'];
        $_SESSION["mulai_ot_awal"] = $terima_mulai_ot;
        }
    if(isset($_GET['akhir_ot_akhir'])){
        $terima_akhir_ot = $_GET['akhir_ot_akhir'];
        $_SESSION["akhir_ot_akhir"] = $terima_akhir_ot;
    }

    if(isset($_GET['hari'])){
        $terima_hari = $_GET['hari']; 
        $_SESSION["hari"] = $terima_hari;
    }

    if($day=="Friday"){
        if($time>='07:15' and $time<='20:29'){
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' 
                and tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'16:00' and tg.dept=1 
                and tg.star_day='jumat' ORDER BY `tg`.`jam` ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' 
                and tg.jam_mulai>='07:25' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and tg.star_day='jumat'ORDER BY `tg`.`jam` ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and tg.star_day='jumat'ORDER BY `tg`.`jam` ASC");
            }else{
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' 
                and tg.jam_mulai>='07:25' and tg.jam_akhir<='16:30' and tg.dept=1 
                and tg.star_day='jumat' ORDER BY `tg`.`jam` ASC");
            }
        }else{
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='06:00')) and tg.dept=1 ORDER BY `tg`.`jam` ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 ORDER BY `tg`.`jam` ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_akhir<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 ORDER BY `tg`.`jam` ASC");
            }else{
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<'05:45')) and tg.dept=1 ORDER BY `tg`.`jam` ASC");
            }
        }
    
    }else if($day!=="Friday"){
        if($time>='07:15' and $time<='20:29'){
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' 
                and tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'16:00' and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' 
                and tg.jam_mulai>='07:25' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");
            }else{
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' 
                and tg.jam_mulai>='07:25' and tg.jam_akhir<='16:00' and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");
            }
        }else{
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='06:00')) and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_akhir<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");
            }else{
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and 
                ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<'05:45')) and tg.dept=1 
                and star_day='senin' ORDER BY `tg`.`jam` ASC");
            }
        }   
    }
    
    $acm = 0;
    $acm1 = 0;
    $acm2 = 0;
    $acm3 = 0;
    $acm_menit = 0;
?>

<table class="table table-bordered table-sm text-center monitor" height="50%" cellspacing="0">
    <thead>
        <tr >
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">No</th> 
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2"><?php echo $sif; ?></th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">Menit</th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">Acm Menit</th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">plan</th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">acm</th>
            <th style="width:2%">hasil</th>
            <th style="width:2%">unit</th>
            <th style="width:2%">menit</th>
            <th style="vertical-align : middle;text-align:center; width:1%" rowspan="2">Effisiensi</th>
            <th style="vertical-align : middle;text-align:center;" rowspan="4">problem</th>
            <th style="vertical-align : middle;text-align:center;" rowspan="2">countermeasure</th> 
            </tr>
            <tr>
            <th>acm</th>
            <th>acm</th>
            <th>acm</th>
            </tr>                                                                                                                                                                               
        </tr>
    </thead>
    <tbody>

        <?php

        foreach($tabel AS $data){
        $id = $data['id'];
        $shift = $data['shift'];
        $No = $data['jam'];
        $jam_start = $data['jam_mulai']; 
        $jam_mulai= date(" H:i",strtotime ($jam_start)); 
        $jam_end = $data['jam_akhir'];
        $jam_akhir=$jam_akhir_display= date(" H:i",strtotime ($jam_end));                        
        $plan = $data['plan'];
        $total = $data['total'];
        if($total==0){
            $unit = '';
            $menit1 = ''; 
            $acm  = ''; 
            $acm1 = '';
            $acm2 = '';
            $eff = '';
            
            }else{
            $unit = $total-$plan;
            $menit1 = $plan-$total;
            $acm = $acm+$total;
            $acm1 = $acm1+$unit;
            $acm2 = $acm2+$menit1;  
            $eff = ($total/$plan)*100 ;
            $eff = round($eff,1).' %';
            }
        $acm3 = $acm3+$plan;   

        if($jam_end=="00:00:00.000000"){
            $jam_akhir=$jam_akhir_display="24:00"; 
            }
        $jam_akhir= (strtotime($jam_akhir) - strtotime($jam_mulai))/60;
        $acm_menit = $acm_menit+$jam_akhir;

        ?>       

        <tr>
        <td style="vertical-align : middle;text-align:center; width:2%" class="text-center" rowspan="2"><?php echo $No; ?></td>
        <td style="vertical-align : middle;text-align:center; width:2%" rowspan="2"><?php echo $jam_mulai. " - " . $jam_akhir_display; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $jam_akhir; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $acm_menit; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $plan; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $acm3; ?></td>
        <td class="hasil" data-toggle="modal" data-jam='<?php echo $id; ?>'  data-no='<?php echo $No; ?>' data-target="#npk"><?php echo $total; ?></td>                                      
        <td><?php echo $unit;?></td>
        <td><?php echo $menit1; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo  $eff; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2" data-toggle="modal" data-problem='<?php echo $id; ?>' data-target="#problem"></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2" data-toggle="modal" data-jam='<?php echo $id; ?>'  data-no='<?php echo $No; ?>' data-target="#countermeasure"></td> 
        </tr>
        <tr>
        <td class="hasil" data-toggle="modal" data-jam='<?php echo $id; ?>'  data-no='<?php echo $No; ?>' data-target="#npk"><?php echo $acm; ?></td>
        <td><?php echo $acm1; ?></td>
        <td><?php echo $acm2; ?></td>
        </tr>                                                                                                                                                                               
        </tr>
        <?php  
        }
        // }

        ?>                      
    </tbody>
</table>
