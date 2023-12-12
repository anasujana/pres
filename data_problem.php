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
                        and tg.star_day='jumat'ORDER BY tg.jam ASC");
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
                    }else if(isset($_SESSION['mulai_ot_awal']) and isset($_SESSION['akhir_ot_akhir'])){
                        $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                        (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil
                        FROM target tg WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='$sif' and 
                        tg.jam_mulai>='$_SESSION[mulai_ot_awal]' and tg.jam_mulai<'$_SESSION[akhir_ot_akhir]' and tg.dept=1 
                        and star_day='senin' ORDER BY tg.jam ASC");
                    }else{
                        $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(hasil) FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3') AS total,
                        (SELECT id_hasil FROM hasil_unit hu WHERE hu.id_target=tg.id AND hu.tanggal = '$target3' group by hu.id_hasil) AS id_hasil FROM target tg 
                        WHERE tg.tgl<='$tgl' and tg.tgl_akhir>='$tgl' AND tg.shift='pagi' and tg.jam_mulai>='07:25' and tg.jam_akhir<='16:00' and tg.dept=1 and star_day='senin' ORDER BY tg.jam ASC");
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
                        ?>

            <table class="table table-sm text-center monitor table-hover" height="200%" cellspacing="0">
            <thead >
                <tr>
                    <th>Jam</th>
                    <th>Kategori Problem</th>
                    <th>Jenis Problem</th>
                    <th>Sumber Problem</th>
                    <th>Area Problem</th>
                    <th>Menit Problem</th>
                    <th>Detail Problem</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach($tabel AS $data){
                    $jam_start = $data['jam_mulai']; 
                    $jam_mulai= date(" H:i",strtotime ($jam_start)); 
                    $jam_end = $data['jam_akhir'];
                    $jam_akhir=$jam_akhir_display= date(" H:i",strtotime ($jam_end));
                    $id_hasil = $data['id_hasil'];  
                
                ?>  
                <tr>
                    <td><?php echo $jam_mulai. " - " . $jam_akhir_display; ?></td>

                    <?php
                    $problem = mysqli_query ($cnts,"SELECT ar.area,p.id_prob,p.id_prob_hasil,p.detail_prob,p.countermeasure,p.menit_prob, p.kategori,
                            p.jenis_prob, p.problem, kp.jenis, jp.nama_prob, np.problem FROM prob p 
                    left join area ar on p.area=ar.id 
                    left join kategori_prob kp on p.kategori=kp.id 
                    left join jenis_prob jp on p.jenis_prob=jp.id
                    left join nama_prob np on p.problem=np.id 
                    where p.tgl_prob='$tgl' and p.id_prob='$id_hasil'");
                    ?>
                    <td>
                        <table class="table text-center">
                            <?php
                            foreach($problem AS $data1){
                                $kategori = $data1['jenis'];
                               ?>
                            <tr>
                                <td class="border-0 text-left">
                                    <?php echo $kategori;?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                    <td>
                        <table class="table text-center ">
                            <?php
                            foreach($problem AS $data1){
                                $jenis = $data1['nama_prob'];
                                ?>
                            <tr>
                                <td class="border-0 text-left">
                                    <?php echo $jenis;?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                    <td>
                        <table class="table text-center ">
                            <?php
                            foreach($problem AS $data1){
                                $problem3 = $data1['problem'];
                            ?>
                            <tr>
                                <td class="border-0 text-left">
                                    <?php echo $problem3;?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                    <td>
                        <table class="table text-center ">
                            <?php
                            foreach($problem AS $data1){
                                $area = $data1['area'];
                            ?>
                            <tr>
                                <td class="border-0 text-left">
                                    <?php echo $area;?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                    <td>
                        <table class="table text-center ">
                            <?php
                            foreach($problem AS $data1){
                                $menit_prob = $data1['menit_prob'];
                                ?>
                            <tr>
                                <td class="border-0 text-left">
                                    <?php echo $menit_prob;?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                    <td>
                        <table class="table text-center ">
                            <?php
                            foreach($problem AS $data1){
                                $problem1 = $data1['detail_prob'];
                            ?>
                            <tr>
                                <td class="border-0 text-left">
                                    <?php echo $problem1;?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                    <td >
                        <table class="table text-center ">
                            <?php
                            foreach($problem AS $data1){
                                $id = $data1['id_prob'];
                                $problem1 = $data1['detail_prob'];
                                $id_prob = $data1['id_prob_hasil'];
                                $countermeasure1 = $data1['countermeasure'];
                                $menit_prob = $data1['menit_prob'];
                                $area = $data1['area'];
                                $kategori = $data1['kategori'];
                                $jenis = $data1['jenis_prob'];
                                $problem3 = $data1['problem'];
                            ?>
                            <tr>
                                <td class="border-0 text-left">
                                <i data-toggle="modal" data-id_prob='<?php echo $id_prob; ?>' data-target="#edit_prob"
                                class='fa fa-edit text-info probprob' aria-hidden='true'></i>&nbsp;
                                <a href="history_problem.php?id_prob_hasil=<?= $id_prob ?>"><i class='fa fa-trash text-danger' aria-hidden='true'></i></a>&ensp;
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                </tr>                                                                                                                                                                             
                <?php  
                }
                ?>                      
            </tbody>
            </table> 