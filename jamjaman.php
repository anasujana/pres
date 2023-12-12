<?php
include './koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

    $tgl=date('Y-m-d');
    $time=date('H:i');
    $day = date('l', strtotime($tgl));
    
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
    if(isset($_GET['revisi_ot_akhir'])){
        $revisi_ot_akhir = $_GET['revisi_ot_akhir'];
        $_SESSION["revisi_ot_akhir"] = $revisi_ot_akhir;
    }

    if($day=="Friday"){
        if($time>='07:15' and $time<='20:29'){
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' 
                and tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'16:00' and tg.dept=1 
                and tg.star_day='jumat' ORDER BY tg.jam ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' 
                and tg.jam_mulai>='07:25' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and tg.star_day='jumat' ORDER BY tg.jam ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and tg.star_day='jumat' ORDER BY tg.jam ASC");
            }else{
               $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil FROM target tg 
                WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and tg.jam_mulai>='07:25' and tg.jam_akhir <='16:30' and tg.dept=1 and tg.star_day='jumat' ORDER BY tg.jam ASC ");
            }
        }else{
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='06:00')) and tg.dept=1 ORDER BY tg.jam ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 ORDER BY tg.jam ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_akhir<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 ORDER BY tg.jam ASC");
            }else{
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<'05:45')) and tg.dept=1 ORDER BY tg.jam ASC");
            }
        }
    
    }else if($day!=="Friday"){
        if($time>='07:15' and $time<='20:29'){
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' 
                and tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'16:00' and tg.dept=1 
                and star_day='senin' ORDER BY tg.jam ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' 
                and tg.jam_mulai>='07:25' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and star_day='senin' ORDER BY tg.jam ASC");
            }else if(isset($_SESSION['revisi_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' 
                and tg.jam_mulai>='07:25' and tg.jam_mulai<'$_SESSION[revisi_ot_akhir]' and tg.dept=1 
                and star_day='senin' ORDER BY tg.jam ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                and star_day='senin' ORDER BY tg.jam ASC");
            }else{
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$tgl') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$tgl' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='pagi' and tg.jam_mulai>='07:25' and tg.jam_akhir<='16:00' and tg.dept=1 and star_day='senin' ORDER BY tg.jam ASC");
            }
        }else{
            if(isset($_SESSION['mulai_ot_awal'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='06:00')) and tg.dept=1 
                and star_day='senin' ORDER BY tg.jam ASC");                                                    
            }else if(isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 
                and star_day='senin' ORDER BY tg.jam ASC");
            }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                ((tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_akhir<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<='$_SESSION[akhir_ot_akhir]')) and tg.dept=1 
                and star_day='senin' ORDER BY tg.jam ASC");
            }else{
                $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil FROM target tg 
                WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and  ((tg.jam_mulai>='21:00' and tg.jam_mulai<='23:59') or (tg.jam_mulai>='00:00' and tg.jam_mulai<'05:45')) and tg.dept=1 and star_day='senin' ORDER BY tg.jam ASC");
            }
        }   
    }
    
    $acm = 0;
    $acm1 = 0;
    $acm2 = 0;
    $acm3 = 0;
    $acm_menit = 0;
?>

<table class="table table-bordered table-sm text-center monitor" height="200%" cellspacing="0">
    <thead >
        <tr >
            <th style="vertical-align : middle;text-align:center; width:2%; height:10%;" rowspan="2">No</th> 
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2"><?php echo $sif; ?></th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">Menit</th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">Acm Menit</th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">plan</th>
            <th style="vertical-align : middle;text-align:center; width:2%" rowspan="2">acm</th>
            <th style="width:2%" colspan="2">hasil</th>
            <th style="width:2%" colspan="2">unit</th>
            <th style="width:2%" colspan="2">menit</th>
            <th style="vertical-align : middle;text-align:center; width:1%" rowspan="2">Eff</th>
            <th style="vertical-align : middle;text-align:center;" rowspan="4">problem</th>
            <th style="vertical-align : middle;text-align:center;" rowspan="2">countermeasure</th> 
            </tr>
            <tr>
            <th class="">act</th>
            <th>acm</th>
            <th>act</th>
            <th>acm</th>
            <th>act</th>
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
        $id_hasil = $data['id_hasil'];

        if($total==0){
            $unit = '0';
            $menit1 = '0'; 
            $acm  = '0'; 
            $acm1 = '0';
            $acm2 = '0';
            $eff = '0';
            
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
        <td style="vertical-align : middle;text-align:center; height:10%" class="text-center" rowspan="2"><?php echo $No; ?></td>
        <td style="vertical-align : middle;text-align:center; width:2%" rowspan="2"><?php echo $jam_mulai. " - " . $jam_akhir_display; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $jam_akhir; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $acm_menit; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $plan; ?></td>
        <td style="vertical-align : middle;text-align:center;" rowspan="2"><?php echo $acm3; ?></td>
        </tr>
        <tr>
        <?php
            if((isset($id_hasil) AND $id_hasil != '')){
            $del = "<a href='db_body1.php?id_hasil=$id_hasil'><i class='fa fa-trash text-danger' aria-hidden='true'></i></a>";
            $add ="";
            }else{
            $add = "<i class='fa fa-plus text-success' aria-hidden='true'></i>";
            $del = "";
            }
        ?>
        <td class="hasil" style="vertical-align : middle;text-align:center;" data-toggle="modal" data-jam='<?php echo $id; ?>'  data-no='<?php echo $No; ?>' data-target="#npk">
        <?php echo $del; ?>&nbsp;&nbsp;
        <?php echo $total; ?> 
        <strong class="text-success" data-toggle="tooltip" data-placement="top" title="INPUT HASIL PRODUKSI"><?php echo $add; ?></strong>
        </td>                                      
        <td  style="vertical-align : middle;text-align:center; height: 2px;"><?php echo $acm;?></td>
        <td  style="vertical-align : middle;text-align:center;"><?php echo $unit; ?></td>
        <td  style="vertical-align : middle;text-align:center;"><?php echo  $acm1; ?></td>
        <td  style="vertical-align : middle;text-align:center;"><?php echo $menit1; ?></td>
        <td  style="vertical-align : middle;text-align:center;"><?php echo $acm2; ?></td>   
        <td  style="vertical-align : middle;text-align:center;"><?php echo  $eff; ?></td>   
        <?php
            $problem = mysqli_query ($cnts,"SELECT ar.area,p.id_prob,p.id_prob_hasil,p.detail_prob,p.countermeasure,p.menit_prob, jp.nama_prob, p.kategori FROM prob p 
            left join area ar on p.area=ar.id 
            left join jenis_prob jp on p.jenis_prob=jp.id
            where p.tgl_prob=' $tgl' and p.id_prob='$id_hasil' ");
            $no=1;

            if(((isset($id_hasil) AND $id_hasil != '') and (isset($problem1)) AND $problem1 != '')){
                $add_prob = "";
                }else{
                $add_prob = "<i  class='fa fa-plus text-success hasil' aria-hidden='true'></i>";
                }

        ?>
        <td class="hasil" data-toggle="modal" data-jam='<?php echo $id; ?>' data-problem='<?php echo $id_hasil; ?>' data-target="#problem">
            <table class="table text-center ">
                <?php
                foreach($problem AS $data1){
                    $id = $data1['id_prob'];
                    $problem1 = $data1['detail_prob'];
                    $id_prob = $data1['id_prob_hasil'];
                    $countermeasure1 = $data1['countermeasure'];
                    $menit_prob = $data1['menit_prob'];
                    $area = $data1['area'];

                    if(((isset($id_hasil) AND $id_hasil != '') and (isset($problem1)) AND $problem1 != '')){
                    $add_prob = "- ".$problem1." "."(".$menit_prob." menit".")";
                    }else{
                    $add_prob = "<i  class='fa fa-plus text-success hasil' aria-hidden='true'></i>";
                    }
                ?>
                <tr>
                    <td class="border-0 text-left">
                        <!-- <i 
                        data-toggle="modal" data-id_prob='<?php echo $id_prob; ?>' data-target="#edit_prob"
                        class='fa fa-edit text-info problem' aria-hidden='true'></i>&nbsp;
                        <a href="db_body1.php?id_prob_hasil=<?= $id_prob ?>"><i class='fa fa-trash text-danger' aria-hidden='true'></i></a>&ensp; -->
                        <?php echo $add_prob;?>
                    </td>
                </tr>
                <?php
                $no++;
                }
                ?>
            </table>

        </td>
        
        <td class=''>
            <table class="table text-center ">
                <?php
                $no_c=1;
                foreach($problem AS $data1){
                    $problem1 = $data1['detail_prob'];
                    $id_prob = $data1['id_prob_hasil'];
                    $countermeasure1 = $data1['countermeasure'];
                    $area = $data1['area'];
                    $nama_prob = $data1['nama_prob'];
                    $kategori = $data1['kategori'];

                if(((isset($id_hasil) AND $id_hasil != '') and (isset($problem1)) AND $problem1 != '') and (isset($countermeasure1) AND $countermeasure1 != '') and (isset($kategori) AND $kategori != 2)){
                    $class ="";
                    $ar = "";
                    $prob_ar = "";
                    $nama_prob = "";
                    }else{
                    $class = "text-danger";
                    $ar = "<strong>$area</strong>";
                    $nama_prob = "<strong>$nama_prob</strong>";
                    $prob_ar = "<strong>NB: Problem</strong> ";
                    }
                ?>
                <tr>
                <td class='<?php echo $class?> border-0 hasil text-left' data-toggle="modal"  data-id_prob='<?php echo $id_prob; ?>' data-detail_problem='<?php echo $problem1; ?>' data-target="#countermeasure"><?php echo $prob_ar.$nama_prob." ".$ar."".$countermeasure1;?></td>
                </tr>
                <?php
                $no_c++;
                }
                ?>
            </table>
        </td>
        
        </tr>                                                                                                                                                                               
        </tr>
        <?php  
        }
        ?>                      
    </tbody>
</table>

<script>
$(document).ready(function() {
 window.setInterval(function() {
  $(".blink-bg").fadeIn(1000).fadeOut(1000);
 }, 2000)
});
</script>

