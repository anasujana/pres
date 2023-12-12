<?php
include('conn/konneksi.php');
session_start();

$id_area=$_SESSION["id_area"];

if(isset($_GET['tanggal_mulai']) and isset($_GET['tanggal_akhir'])){
    $tanggal_mulai = $_GET['tanggal_mulai'];
    $tanggal_akhir = $_GET['tanggal_akhir'];

    $_SESSION["star_date"] = $tanggal_mulai;
    $_SESSION["end_date"] = $tanggal_akhir;
}

$tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC limit 1");
$tgl=mysqli_fetch_array($tanggal);
$tgl = $tgl['tgls'];

$_SESSION["tgl_awal"] =  $tgl;


                if($_SESSION["id_area"]==1){
                    if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                        $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                        where (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                        $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                        where (Result='OK' OR tagane='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                        $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                        where (Result='NG' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                        $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                        where (Result='N.A.' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                        }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                        $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                        where me.Date='$tgl'");
                        $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                        where (Result='OK' OR tagane='OK') and me.Date='$tgl'");
                        $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                        where (Result='NG' AND tagane!='OK')");
                        $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                        where (Result='N.A.' AND tagane!='OK')");
                        }
                        $total = mysqli_num_rows ($tabeltotal);
                        $ok = mysqli_num_rows ($tabelok);
                        $ng = mysqli_num_rows ($tabelng);
                        $na = mysqli_num_rows ($tabel_na);
                }else{
                    if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                    where rp.id_area='$id_area' and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND
                                                                                    (Result='OK' OR tagane='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND 
                                                                                    (Result='NG' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' 
                                                                                    AND (Result='N.A.' AND tagane!='OK') and (Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]')");
                    }else if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                    $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                                    where rp.id_area='$id_area' and me.Date='$tgl'");
                    $tabelok =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND
                                                                                    (Result='OK' OR tagane='OK') and me.Date='$tgl'");
                    $tabelng =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' AND 
                                                                                    (Result='NG' AND tagane!='OK') ");
                    $tabel_na =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                    where rp.id_area='$id_area' 
                                                                                    AND (Result='N.A.' AND tagane!='OK') ");
                    }
                    $total = mysqli_num_rows ($tabeltotal);
                    $ok = mysqli_num_rows ($tabelok);
                    $ng = mysqli_num_rows ($tabelng);
                    $na = mysqli_num_rows ($tabel_na);
                }

                $data = array(
                    'total' => $total,
                    'ok' => $ok,
                    'ng' => $ng,
                    'na' => $na,
    );
    echo json_encode($data);
?> 
