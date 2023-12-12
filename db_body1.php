<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require "session.php";
    date_default_timezone_set('Asia/Jakarta');
    function generateRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength= strlen($characters);
        $randomstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randomstring = $characters[rand(0, $charactersLength - 1)];
        }
        return $randomstring;
    }
    require './vendor/autoload.php';
?>
<head>
    <title>Production Result</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

    <!-- prism css -->
    <link rel="stylesheet" href="assets/css/plugins/prism-coy.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    </style>

</head>
<body>
    <?php
    include './koneksi/koneksi.php';
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    
    <!-- [ Header ] start -->
    <?php 
    include './element/header_nav.php';
    ?>
    <!-- [ Header ] end -->
    <br>
    
    <script>
        setInterval (function(){
            $('#passrate').load('passrate.php').fadeIn("fast");
        },500
        )
        ;

        setInterval (function(){
            $('#hasil').load('hasil.php').fadeIn("fast");
        },500
        )
        ;
        
        setInterval (function(){
            $('#id_lku_prob').load('id.php').fadeIn("fast");
        },500
        )
        ;

        setInterval (function(){
            $('#target_produksi').load('ajax_target/target.php').fadeIn("fast");
        },500
        )
        ;

        setInterval (function(){
        $('#awal_mulai').load('overtime.php?id=1').fadeIn("fast");
        $('#awal_akhir').load('overtime.php?id=2').fadeIn("fast");
        $('#akhir_mulai').load('overtime.php?id=3').fadeIn("fast");
        $('#akhir_akhir').load('overtime.php?id=4').fadeIn("fast");
        },500
        )
        ;

        setInterval (function(){
        $('#startwosx').load('input_wosver2.php?id=1').fadeIn("fast");
        $('#endwosx').load('input_wosver2.php?id=2').fadeIn("fast");
        },500
        )

        setInterval (function(){
            $('#jamjaman').load('jamjaman.php<?php            
            if(isset($_GET['mulai_ot_awal'])){
                $terima_mulai_ot = $_GET['mulai_ot_awal'];
                echo '?mulai_ot_awal='.$terima_mulai_ot;
            }else if(isset($_GET['akhir_ot_akhir'])){
                $terima_akhir_ot = $_GET['akhir_ot_akhir'];
                echo '?akhir_ot_akhir='.$terima_akhir_ot;
            }else if(isset($_GET['revisi_ot_akhir'])){
                $revisi_ot_akhir = $_GET['revisi_ot_akhir'];
                echo '?akhir_ot_akhir='.$revisi_ot_akhir;
            }else if(isset($_GET['mulai_ot_awal']) and isset($_GET['akhir_ot_akhir'])){
                $terima_mulai_ot = $_GET['mulai_ot_awal'];
                $terima_akhir_ot = $_GET['akhir_ot_akhir'];
                echo '?mulai_ot_awal='.$terima_mulai_ot;
                echo '&akhir_ot_akhir='.$terima_akhir_ot;
            }?>
        ').fadeIn("fast");
        },500
        )
        ;
        
    </script>
    <div class="row">
        <!-- kolom acm hasil produksi -->
        <div class="col-sm-3" id="hasil">
        </div>
        <div class="col-sm-6">       
            <br>
            <h5 class=" align-middle text-center font-weight-bold ">PRODUCTION RESULT </h5>
            <h1 class=" align-middle text-center font-weight-bold ">MAIN BODY MIX LINE </h1>
        </div>
        <!-- kolom passrate acm -->
        <div class="col-sm-3" id="passrate">
        </div>
    </div>
    <div class="row">
        <!-- kolom night shift -->
        <div class="col-sm-3"> 
            <table class=" table-sm table-bordered text-center" id="" width="100%" cellspacing="0">
                <?php                                   
                    $tgl_shift=date('Y-m-d');
                    $time_now=date('H:i');

                    $tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT day,night FROM shift_kerja where tanggal='$tgl_shift'"));                    
                    $day = $tabel ['day'];
                    $night = $tabel ['night'];
                    if($time_now>='20:30' and $time_now<='23:59'){
                        $shift = $night;
                    }else if($time_now>='00:00' and $time_now<='07:14'){
                        $shift = $night;
                    }else if($time_now>='07:15' and $time_now<='20:29'){
                        $shift = $day;
                    }  
                    
                    $t_time = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tacktime FROM target WHERE `tgl`<='$tgl_shift' and `tgl_akhir`>='$tgl_shift'"));
                    $tt= $t_time['tacktime'];

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
                    
                    if($time_now>='07:25' and $time_now<='20:29'){
                        $header = 'DAY SHIFT';
                    }else{
                        $header = 'NIGHT SHIFT';
                    }

                    $pic = mysqli_fetch_array(mysqli_query ($cnts,"SELECT pic FROM wos where tgl='$tgl_shift' and shift='$shift' "));
                    $name_pic= $pic['pic'];
                ?>
                <thead class="bg-secondary text-white">
                    <tr>
                        <th style="vertical-align : middle;text-align:center;" colspan="3"><?php echo $header; ?></th>
                    </tr>
                </thead>
                <tr class="bg-white">
                    <td data-toggle="modal" data-jam='<?php echo $jam_mulai; ?>' data-target="#setting">SHIFT : <?php echo $shift; ?></td> 
                    <td>T/TIME : <?php echo $tt; ?></td>
                    <td>PIC : <?php echo $name_pic; ?></td>
                </tr>               
            </table>
        </div>
        <!-- kolom target produuksi -->
        <div class="col-sm-3 revisi" id="target_produksi">
            
        </div>      
        <!-- kolom overtime -->
        <div class="col-sm-3">
            <table class=" table-sm table-bordered text-center ot" id="" width="100%" cellspacing="0">
                <?php 
                $ot = mysqli_fetch_array(mysqli_query ($cnts,"SELECT mulai,selesai FROM ot_awal where tgl='$tgl' and shift='$shift'"));
                $awal_mulai= $ot['mulai'];
                $awal_akhir= $ot['selesai'];  

                $ot_akhir = mysqli_fetch_array(mysqli_query ($cnts,"SELECT mulai,selesai FROM ot_akhir where tgl='$tgl' and shift='$shift'"));
                $akhir_mulai= $ot_akhir['mulai'];
                $akhir_akhir= $ot_akhir['selesai'];

                if($awal_mulai==0){
                    $awal_mulai = '-';
                    $awal_akhir = '-'; 
                    
                    }else{
                    $awal_mulai = date("H:i",strtotime ($awal_mulai)); 
                    $awal_akhir = date("H:i",strtotime ($awal_akhir));
                    }

                    if($akhir_mulai==0){
                    $akhir_mulai  = '-'; 
                    $akhir_akhir = '-';
                    
                    }else{
                    $akhir_mulai = date("H:i",strtotime ($akhir_mulai)); 
                    $akhir_akhir = date("H:i",strtotime ($akhir_akhir));
                    }
                      
                    if((isset($akhir_mulai) AND $akhir_mulai != '')){
                    $addd ="";
                    }else{
                    $addd = "<i class='fa fa-plus' aria-hidden='true'></i>";
                    }
                ?>
                <thead class="bg-secondary text-white">
                    <tr>
                        <th colspan="2" data-toggle="modal" data-target="#ot_awal">O/T AWAL  &ensp; <strong class="text-success" data-toggle="tooltip" data-placement="top" title="INPUT OT AWAL"><i class='fa fa-plus' aria-hidden='true'></i></strong></th>
                        <th colspan="2" data-toggle="modal" data-target="#ot_akhir">O/T AKHIR &ensp; <strong class="text-success" data-toggle="tooltip" data-placement="top" title="INPUT OT AKHIR"><i class='fa fa-plus' aria-hidden='true'></i></strong></th>
                    </tr>
                </thead>
                <tr class="bg-white">
                    <td><span id="awal_mulai"></span></td> 
                    <td><span id="awal_akhir"></span></td>
                    <td><span id="akhir_mulai"></span></td>
                    <td><span id="akhir_akhir"></span></td>
                </tr>                             
            </table>
        </div>
        <!-- kolom wos -->
        <div class="col-sm-3" id="input_wos">   
            <table class="table-bordered table-sm text-center wosss" id="tablee" width="100%" cellspacing="0">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th colspan="2" >START & FINISH WOS</th>
                    </tr>
                </thead>
                <tr class="bg-white">

                    <?php             
                    $wos = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,group_shift,shift,tgl,start,finish,pic FROM wos where tgl='$tgl' and shift='$shift'"));
                    $id= $wos['id'];
                    $start= $wos['start'];  
                    $finish= $wos['finish']; 

                    if((isset($start) AND $start != '')){
                    $add ="";
                    }else{
                    $add = "<i class='fa fa-plus' aria-hidden='true'></i>";
                    }
                    ?>

                    <td data-toggle="modal" data-target="#wos">START :
                    <span id="startwosx"></span></td> 
                    <td  class='finish' data-toggle="modal" data-id='<?php echo $id; ?>' data-start='<?php echo $start; ?>' 
                    data-finish='<?php echo $finish; ?>' data-target="#finish">FINISH : 
                    <span id="endwosx"></span></td>
                </tr>                             
            </table>
        </div>
    </div>
   
    <!-- [ Main Content ] start -->
            <br>
            <div class="card">
                <div class="card-header">
                    <h5 class=" align-middle text-center font-weight-bold ">LINE #1</h5>
                    <?php
                    $tgl=date('d-F-Y h:i');
                    ?>
                    <h5 class=" align-middle float-right  font-weight-bold "><?php echo $tgl ?> &nbsp;&nbsp;&nbsp;</h5>
                    <?php
                    ?>
                    <div class="card-header-right">
                        <div class="btn-group card-option"> 
                            <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a>
                                </li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                </ul> 
                        </div>
                    </div>
                </div>

                <?php
                if(isset($_GET ['id_hasil'])){
                    $iddelete  = $_GET ['id_hasil'];
                    $delete =  mysqli_query ($cnts,"DELETE FROM hasil_unit where id_hasil='$iddelete'");  
                }
                ?>

                 <!-- Modal rev produksi-->
                 <div class="modal fade" id="plan_d14" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="revisi">
                                <div class="form-row"> 
                                    <input type="hidden" name="id_d14" class="form-control"  id="id_d14" placeholder="" value="" >
                                    <div class="form-group col-md-12">
                                        <label for="Nama">Revisi</label>
                                        <input type="number" name="d14" class="form-control" id="d14" placeholder="" value="">
                                    </div>                                
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" class="btn btn-primary" value="Save" id="edit_target">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <!-- Modal plan produksi-->
                <div class="modal fade" id="plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Planing Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="close_plan">
                                <div class="form-row"> 
                                        <?php                                   
                                            $time_now=date('H:i');
                                            if($time_now>='00:00' and $time_now<='07:15'){
                                               $tgl= date('Y-m-d', strtotime('-1 days', strtotime( $tgl )));
                                            }else if($time_now>='07:15' and $time_now<='23:59'){
                                                $tgl=date('Y-m-d');  
                                            }                                       
                                        ?>
                                        <input type="hidden" name="tanggal" value=<?php echo $tgl?> class="form-control" placeholder="<?php echo $tgl?>"  id="tanggal_target" readonly>
                                    
                                        <?php                                   
                                            $tgl_shift=date('Y-m-d');
                                        
                                            if($time_now>='07:15' and $time_now<='20:29'){
                                                $sif = 'pagi';
                                            }else{
                                                $sif = 'malam';
                                            }      
                                        ?>
                                        <input type="hidden" name="shift1" value="<?php echo $sif?>" class="form-control" id="shift_target" placeholder="" readonly>
                                   
                                    
                                        <?php          
                                        $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=1");                    
                                        foreach($tabel AS $data){
                                        $type = $data['type'];
                                        ?>
                                        <div class="form-group col-md-6">
                                        <label for="Nama">Plan : <?php echo $type?></label>
                                        <input type="number" name="" value="" class="form-control" id="<?php echo $type.'1'?>" placeholder="<?php echo $type?>" required>
                                        </div>    
                                        <?php
                                        }
                                        ?> 
                                                              
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" class="btn btn-primary" value="Save" id="input_target">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                 <!-- Modal O/T awal-->
                 <div class="modal fade" id="ot_awal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Overtime Awal Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="GET">
                               
                                <?php
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
                                    
                                       <input type="hidden" name="dept" class="form-control" id="" placeholder="dept" value="1">
                                      
                                    
                                        <input type="hidden" name="date_ot" class="form-control" id="" placeholder="date" value="<?php echo $tgl?>">
                                    
                                    
                                        <input type="hidden" name="shift_ot" class="form-control"  id="" placeholder="shift" value="<?php echo $shift?>" >
                                    
                                    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Nama">Jam Mulai</label>
                                        <input type="time" name="mulai_ot_awal" class="form-control" id="" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputpictagane">Jam Akhir</label>
                                        <input type="time" name="akhir_ot_awal" class="form-control"  id="" placeholder="" value="" >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <?php
                    // cek ada/tidak nya data
                    if(isset($_GET['dept']) and isset($_GET['date_ot']) and isset($_GET['shift_ot']) and isset($_GET['mulai_ot_awal'])and isset($_GET['akhir_ot_awal'])){
                    // terima data        
                    $terima_dept = $_GET['dept'];
                    $terima_date_ot = $_GET['date_ot'];
                    $terima_shift_ot = $_GET['shift_ot'];
                    $terima_mulai_ot = $_GET['mulai_ot_awal'];
                    $terima_akhir_ot = $_GET['akhir_ot_awal'];

                    $_SESSION["mulai_ot_awal"] = $terima_mulai_ot;
                    
                    $add = mysqli_query($cnts,"INSERT INTO ot_awal VALUES ('','$terima_dept','$terima_date_ot','$terima_shift_ot','$terima_mulai_ot','$terima_akhir_ot')");  
                }    
                ?>

                <!-- Modal O/T akhir-->
                <div class="modal fade" id="ot_akhir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Overtime Akhir Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="GET" id="akhir">
                               
                                <?php
                                    $time_now=date('H:i');
                                    if($time_now>='00:00' and $time_now<='07:15'){
                                        $tgl= date('Y-m-d', strtotime('-1 days'));
                                    }else if($time_now>='07:15' and $time_now<='23:59'){
                                        $tgl=date('Y-m-d');  
                                    }  
                                    
                                    if($time_now>='07:15' and $time_now<='20:29'){
                                        $shift = 'pagi';
                                    }else{
                                        $shift = 'malam';
                                    }
                                ?>    
                                    
                                       <input type="hidden" name="dept" class="form-control" id="dept_ot" placeholder="dept" value="1">
                                    
                                    
                                        <input type="hidden" name="date_ot" class="form-control" id="date_ot" placeholder="date" value="<?php echo $tgl?>">
                                    
                                    
                                        <input type="hidden" name="shift_ot" class="form-control"  id="" placeholder="shift" value="<?php echo $shift?>" >
                                    
                                    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Nama">Jam Mulai</label>
                                        <input type="time" name="mulai_ot_akhir" class="form-control" id="mulai_ot_akhir" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputpictagane">Jam Akhir</label>
                                        <input type="time" name="akhir_ot_akhir" class="form-control"  id="akhir_ot_akhir" placeholder="" value="" >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                    <!-- <input type="button" id="input_ot_akhir" class="btn btn-primary" value="Save"> -->
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <?php
                    // cek ada/tidak nya data
                    if(isset($_GET['dept']) and isset($_GET['date_ot']) and isset($_GET['shift_ot']) and isset($_GET['mulai_ot_akhir'])and isset($_GET['akhir_ot_akhir'])){
                    // terima data        
                    $terima_dept = $_GET['dept'];
                    $terima_date_ot = $_GET['date_ot'];
                    $terima_shift_ot = $_GET['shift_ot'];
                    $terima_mulai_ot_akhir = $_GET['mulai_ot_akhir'];
                    $terima_akhir_ot_akhir = $_GET['akhir_ot_akhir'];

                    $_SESSION["akhir_ot_akhir"] = $terima_akhir_ot_akhir;
                    
                    $addd = mysqli_query($cnts,"INSERT INTO ot_akhir VALUES ('','$terima_dept','$terima_date_ot','$terima_shift_ot','$terima_mulai_ot_akhir','$terima_akhir_ot_akhir')");
                    }
                ?>

                <!-- Modal revisi O/T awal1-->
                <div class="modal fade" id="revisi_awal_awal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Overtime Akhir Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="awal_ot">
                                <input type="hidden" name="" class="id_ot_awal_awal">    
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="Nama">Jam Mulai</label>
                                        <input type="time" name="" class="form-control" id="revisi_ot_awal" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" id="edit_ot_awal_awal" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <!-- Modal revisi O/T awal2-->
                <div class="modal fade" id="revisi_awal_akhir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Overtime Akhir Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="akhir_awal_ot">
                                <input type="hidden" name="" class="id_ot_awal_awal">    
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="Nama">Jam Selesai</label>
                                        <input type="time" name="" class="form-control" id="revisi_ot_awal_akhir" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" id="edit_ot_awal_akhir" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <!-- Modal revisi O/T akhir1-->
                <div class="modal fade" id="revisi_akhir_awal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Overtime Akhir Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="akhir_awal_ot">
                                <input type="hidden" name="" class="id_ot_akhir">    
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="Nama">Jam Mulai</label>
                                        <input type="time" name="" class="form-control" id="revisi_ot_akhir1" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" id="edit_ot_akhir_awal" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                 <!-- Modal revisi O/T akhir2-->
                 <div class="modal fade" id="revisi_akhir_akhir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Overtime Akhir Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="GET" id="akhir_ot">
                                <input type="hidden" name="id_ot_akhir" class="id_ot_akhir">    
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="Nama">Jam Akhir</label>
                                        <input type="time" name="revisi_ot_akhir" class="form-control" id="revisi_ot_akhir" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" id="edit_ot_akhir" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                
                <?php
                if(isset($_GET['id_ot_akhir']) and isset($_GET['revisi_ot_akhir'])){
                $id_overtime_akhir = $_GET['id_ot_akhir'];
                $edit_overtime_akhir = $_GET['revisi_ot_akhir'];
                
                // edit   
                $edit_ot = mysqli_query($cnts,"UPDATE ot_akhir SET selesai='$edit_overtime_akhir' WHERE id='$id_overtime_akhir'");
                }
                ?>

                <?php
                $wos = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,group_shift,shift,tgl,start,finish,pic FROM wos where tgl='$tgl' and shift='$shift'"));
                $id= $wos['id'];
                $start= $wos['start'];  
                $finish= $wos['finish'];             
                ?>
                <!-- Modal finish wosh-->
                <div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Finish Wos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="finish_woss">
                                <div class="form-row">
                                    <!-- <div class="form-group col-md-6"> -->
                                        <input type="hidden" name="id" class="form-control" value="<?php echo $id?>" id="id">
                                    <!-- </div> -->
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">FINISH</label>
                                        <input type="text" name="finish" id="edit_wos" class="form-control" value="">
                                    </div>                                   
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" id="finish_wos" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <!-- Modal start wos-->
                <div class="modal fade" id="wos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Start Wos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="woss">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputState">START</label>
                                        <input type="text" name="start" class="form-control" id="wos_awal">
                                    </div>
                                    <div class="form-group col-md-3">                                     
                                        <?php                                   
                                            $time_now=date('H:i');
                                            if($time_now>='00:00' and $time_now<='07:15'){
                                               $tgl= date('Y-m-d', strtotime('-1 days', strtotime( $tgl )));
                                            }else if($time_now>='07:15' and $time_now<='23:59'){
                                                $tgl=date('Y-m-d');  
                                            }                                        
                                        ?>
                                        <input type="hidden" name="tgl" value=<?php echo $tgl?> class="form-control" placeholder="<?php echo $tgl?>"  id="tgl_wos" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <?php                                   
                                            $tgl_shift=date('Y-m-d');
                                        
                                            $tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT day,night FROM shift_kerja where tanggal='$tgl_shift'"));                    
                                            
                                            if($time_now>='07:15' and $time_now<='20:29'){
                                                $shift = 'pagi';
                                            }else{
                                                $shift = 'malam';
                                            }        
                                        ?>
                                        <input type="hidden" name="shif" value="<?php echo $shift?>" class="form-control" id="shift_wos" placeholder="" readonly>
                                    </div> 
                                    <div class="form-group col-md-3">
                                        <?php                                   
                                            $tgl_shift=date('Y-m-d');
                                        
                                            $tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT day,night FROM shift_kerja where tanggal='$tgl_shift'"));                    
                                            $day = $tabel ['day'];
                                            $night = $tabel ['night'];
                                            if($time_now>='20:30' and $time_now<='23:59'){
                                                $group_shift = $night;
                                            }else if($time_now>='00:00' and $time_now<='07:14'){
                                                $group_shift = $night;
                                            }else if($time_now>='07:15' and $time_now<='20:29'){
                                                $group_shift = $day;
                                            }        
                                        ?>
                                        <input type="hidden" name="group_shif" value="<?php echo $group_shift?>" class="form-control" id="group_shift" placeholder="" readonly>
                                    </div> 
                                    <div class="form-group col-md-3">
                                        <input type="hidden" name="finish" class="form-control" id="finishh" value="" placeholder="finish">
                                    </div>                                   
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="hidden" value="<?php echo $_SESSION["nama"];?>" name="pic" class="form-control" id="pic_wos" placeholder="pic">
                                    </div>
                                </div>    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" id="star_wos" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                
                <!-- Modal input jam-jaman -->
                <div class="modal fade" id="npk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Input Jam-Jaman Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="" id="hasil_jam">
                                <input type="hidden" name="jam" value=''  placeholder=""  class="jam1">
                                <div class="form-row"> 
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">Tanggal</label>
                                        <?php                                   
                                            $time_now=date('H:i');
                                            if($time_now>='00:00' and $time_now<='07:15'){
                                               $tgl= date('Y-m-d', strtotime('-1 days', strtotime( $tgl )));
                                            }else if($time_now>='07:15' and $time_now<='23:59'){
                                                $tgl=date('Y-m-d');  
                                            }                                       
                                        ?>
                                        <input type="date" name="tanggal" value=<?php echo $tgl?> class="form-control" placeholder="<?php echo $tgl?>"  id="tanggal" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">SHIFT</label>
                                        <?php                                   
                                            $tgl_shift=date('Y-m-d');
                                        
                                            $tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT day,night FROM shift_kerja where tanggal='$tgl_shift'"));                    
                                            $day = $tabel ['day'];
                                            $night = $tabel ['night'];
                                            if($time_now>='20:30' and $time_now<='23:59'){
                                                $shift = $night;
                                            }else if($time_now>='00:00' and $time_now<='07:14'){
                                                $shift = $night;
                                            }else if($time_now>='07:15' and $time_now<='20:29'){
                                                $shift = $day;
                                            }        
                                        ?>
                                        <input type="text" name="shift1" value="<?php echo $shift?>" class="form-control" id="shift" placeholder="" readonly>
                                    </div> 
                                    
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">jam ke</label>
                                        <input type="number" name="no" value='' class="form-control" placeholder=""  id="no1" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                <?php          
                                $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=1");                    
                                foreach($tabel AS $data){
                                $type = $data['type'];
                                 ?>
                                    <div class="form-group col-md-6">
                                        <label for="Nama">Hasil : <?php echo $type?></label>
                                        <input type="number" name="" value="" class="form-control" id="<?php echo $type?>" placeholder="<?php echo $type?>" required>
                                    </div>
                                <?php
                                }
                                ?>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="button" id="input" class="btn btn-primary" value="Save">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                
                <!-- digitalization board -->
                <div class="card-body">
                    <div class="table-responsive monitor" id="jamjaman">
                    </div> 
                </div>
            </div>
            
        <!-- Modal problem-->
        <div class=" add_npk modal fade" id="problem" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Input Problem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="" id="reset_problem">
                    <div class="modal-body">    
                    <input type="hidden" name="id_prob" value='' class="id_prob" placeholder=""  >
                    <input type="hidden" name="tgl_prob" value=<?php echo $tgl?> placeholder=""  id="tgl_prob">                          
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputpictagane">Kategori Problem</label>
                                <select name="kategori" class="custom-select mr-sm-2" id="kategori">
                                </select>
                            </div>
                            <div class="form-group col-md-12" id="labelJenis" >
                                <label for="">Jenis Problem</label>
                                <select name="jenis_problem" class="custom-select mr-sm-2" id="jenis_problem"  >
                                    <option value="">pilih Jenis problem :</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" id="labelProb" >
                            <div class="form-group col-md-12">
                                <label for="">Sumber Problem</label>
                                <select name="sub_problem" class="custom-select mr-sm-12" id="sub_problem" >
                                <option value="">pilih sumber problem :</option> 
                            </select>
                            </div>
                        </div>
                    
                        <div class="form-row" id="labelArea" >
                            <div class="form-group col-md-12">
                                <label for="Nama">Area</label>
                                <select name="area" class="custom-select mr-sm-2" id="area" >
                                <option value="">pilih area problem :</option>
                                <?php
                                    $area = mysqli_query($cnts,"SELECT * FROM area");
                                    foreach ($area AS $dataarea){
                                    $id = $dataarea['id'];
                                    $area= $dataarea['area']
                                    ?>   
                                    <option  value="<?php echo $id; ?>" ><?php echo $area; ?></option>    
                                    <?php
                                    }
                                ?> 
                                </select>
                            </div>
                        </div>
                        <div class="form-row" id="labelMenit" >
                            <div class="form-group col-md-12">
                                <label for="inputpictagane">Menit Problem</label>
                                <input type="number" name="menit" value='' class="form-control" placeholder=""  id="menit" >
                            </div>
                        </div>
                        <div class="form-row" id="labelDetail" >
                            <p id="detailLabel"  ><label for="w3review">Detail Problem :</label></p>
                            <textarea id="detail" name="detail" rows="4" cols="58" ></textarea>
                        </div>
                       </div>
                    <div class="modal-footer">  
                         <input type="button" id="input_problem" class="btn btn-primary" value="Save">                              
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <?php 
        if(isset($_GET ['id_prob_hasil'])){
            $id  = $_GET ['id_prob_hasil'];
            $delete =  mysqli_query ($cnts,"DELETE FROM prob where id_prob_hasil='$id'");  
        }
        ?>

         <!-- Modal edit problem-->
         <div class=" add_npk modal fade" id="edit_prob" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Input Problem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="" id="reset_edit">
                    <div class="modal-body">    
                    <input type="number" name="id_prob" value='' class="id_counter" placeholder="" >                         
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputpictagane">Menit Problem</label>
                                <input type="number" name="menit" value='' class="form-control" placeholder=""  id="editmenit">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">  
                         <input type="button" id="save_edit" class="btn btn-primary" value="Save">                              
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- Modal countermeasure -->
        <div class=" add_npk modal fade" id="countermeasure" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success" id="exampleModalCenterTitle">Countermeasure Problem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="" id="form_countermeasure">
                    <div class="modal-body">                              
                        <div class="form-row">
                            <input type="hidden" name="id_prob" value='' class="id_counter" placeholder="" >
                            <div class="form-group col-md-12">
                            <label for="inputpictagane" class="text-danger">PROBLEM :</label>
                                <textarea id="detail_problem" name="detail_prob " rows="4" cols="58" readonly></textarea>
                                <br>
                            </div> 
                            <div class="form-group col-md-12">
                            <label for="inputpictagane" class="text-success align-text-middle">COUNTERMEASURE :</label>
                                <textarea id="detail_prob" name="detail_prob " rows="4" cols="58"></textarea>
                                <br>
                            </div> 
                        </div>                      
                    </div>
                    <div class="modal-footer">                                
                        <input type="button" id="input_counter" class="btn btn-primary float-right" value="save">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->
                    
    <!-- Required Js -->
        <script src="assets/js/vendor-all.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>
        <script src="assets/js/pcoded.min.js"></script>

    <!-- prism Js -->
    <script src="assets/js/plugins/prism.js"></script>


    <script src="assets/js/horizontal-menu.js"></script>
    <script>
        (function() {
            if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
                return;
            }
            try {
                window.layoutHelpers._getSetting("Rtl")
                window.layoutHelpers.setCollapsed(
                    localStorage.getItem('layoutCollapsed') === 'true',
                    false
                );
            } catch (e) {}
        })();
        $(function() {
            $('#layout-sidenav').each(function() {
                new SideNav(this, {
                    orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
                });
            });
            $('body').on('click', '.layout-sidenav-toggle', function(e) {
                e.preventDefault();
                window.layoutHelpers.toggleCollapsed();
                if (!window.layoutHelpers.isSmallScreen()) {
                    try {
                        localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed()));
                    } catch (e) {}
                }
            });
        });
        $(document).ready(function() {
            $("#pcoded").pcodedmenu({
                themelayout: 'horizontal',
                MenuTrigger: 'hover',
                SubMenuTrigger: 'hover',
            });
        });
    </script>

    <script src="assets/js/analytics.js"></script>

    <script>

    $('.monitor').on('click','.hasil',function(){
        var id = this;
        var id1 = $(this).data('jam');
        $('.jam1').val(id1);
    })

    $('.monitor').on('click','.hasil',function(){
        var id = this;
        var id1 = $(this).data('no');  
        $('#no1').val(id1);
    })
    
    $('.woss').on('click','.finish',function(){
        var id = this;
        var id1 = $(this).data('start');
        $('#start').val(id1);
    })

    $('.monitor').on('click','.hasil',function(){
        var id = this;
        var id1 = $(this).data('problem');
        $('.id_prob').val(id1);
    })

    $('.monitor').on('click','.hasil',function(){
        var id = this;
        var id1 = $(this).data('id_prob');
        $('.id_counter').val(id1);
    })

    $('.monitor').on('click','.problem',function(){
        var id = this;
        var id1 = $(this).data('id_prob');
        $('.id_counter').val(id1);
    })

    $('.monitor').on('click','.hasil',function(){
        var id = this;
        var id1 = $(this).data('detail_problem');
        $('#detail_problem').val(id1);
    })

    $('.ot').on('click','.edit',function(){
        var id = this;
        var id1 = $(this).data('id_akhir');
        $('.id_ot_akhir').val(id1);
    })
    
    $('.ot').on('click','.edit1',function(){
        var id = this;
        var id1 = $(this).data('id_awal');
        $('.id_ot_awal_awal').val(id1);
    })

    $('.revisi').on('click','.rev',function(){
        var id = this;
        var id1 = $(this).data('id');
        $('#id_d14').val(id1);
    })
    $('.revisi').on('click','.rev',function(){
        var id = this;
        var id1 = $(this).data('d26');
        $('#d26').val(id1);
    })
    $('.revisi').on('click','.rev',function(){
        var id = this;
        var id1 = $(this).data('d12');
        $('#d12').val(id1);
    })

    function reloadtable(){
    setInterval (function(){
        $('#jamjaman').load('jamjaman.php').fadeIn("fast");
    },500
    )
    ;}

    // input problem
    $('#input_problem').on("click",function(){
    var id_prob = $ (".id_prob").val();
    var id = $ (".jam1").val();
    var kategori = $ ("#kategori").val();
    var jenis_problem = $ ("#jenis_problem").val();
    var sub_problem = $ ("#sub_problem").val();
    var area = $ ("#area").val();
    var menit = $ ("#menit").val();
    var detail = $ ("#detail").val();
    var tgl_prob = $ ("#tgl_prob").val();

    $.ajax({
        method: "POST",
        url: "problem.php",
        data: {stgl_prob: tgl_prob,
            sid_prob: id_prob,
            sid: id,
            skategori: kategori,
            sjenis_problem: jenis_problem,
            ssub_problem: sub_problem,
            sarea: area,
            smenit: menit,
            sdetail: detail
        }
    })
    .done(function(hasilinput){
        $('#problem').modal('toggle');
        $("#reset_problem").trigger('reset');
        reloadtable ();
    });
    
    });

    // combo box
    document.getElementById("kategori").onchange = 
        function (e) {
            if (this.value == 1) {
                document.getElementById("labelJenis").style.display="";
                document.getElementById("jenis_problem").style.display="";
                document.getElementById("labelProb").style.display="";
                document.getElementById("sub_problem").style.display="";
                document.getElementById("labelArea").style.display="";
                document.getElementById("area").style.display="";
                document.getElementById("labelMenit").style.display="";
                document.getElementById("menit").style.display="";
                document.getElementById("labelDetail").style.display="";
                document.getElementById("detailLabel").style.display="";
                document.getElementById("detail").style.display="";
            }else if (this.value == 2){
                document.getElementById("labelJenis").style.display="";
                document.getElementById("jenis_problem").style.display="";
                document.getElementById("labelProb").style.display="none";
                document.getElementById("sub_problem").style.display="none";
                document.getElementById("labelArea").style.display="none";
                document.getElementById("area").style.display="none";
                document.getElementById("labelMenit").style.display="";
                document.getElementById("menit").style.display="";
                document.getElementById("labelDetail").style.display="";
                document.getElementById("detailLabel").style.display="";
                document.getElementById("detail").style.display="";
            }else{
                document.getElementById("jenis_problem").style.display="none";
                document.getElementById("labelProb").style.display="none";
                document.getElementById("labelArea").style.display="none";
                document.getElementById("menit").style.display="none";
                document.getElementById("detail").style.display="none";
            }
        };

        document.getElementById("jenis_problem").onchange = 
        function (e) {
            if (this.value == 1) {
                document.getElementById("labelJenis").style.display="";
                document.getElementById("jenis_problem").style.display="";
                document.getElementById("labelProb").style.display="";
                document.getElementById("sub_problem").style.display="";
                document.getElementById("labelArea").style.display="";
                document.getElementById("area").style.display="";
                document.getElementById("labelMenit").style.display="";
                document.getElementById("menit").style.display="";
                document.getElementById("labelDetail").style.display="";
                document.getElementById("detailLabel").style.display="";
                document.getElementById("detail").style.display="";
            }else{
                document.getElementById("labelJenis").style.display="";
                document.getElementById("jenis_problem").style.display="";
                document.getElementById("labelProb").style.display="none";
                document.getElementById("sub_problem").style.display="none";
                document.getElementById("labelArea").style.display="";
                document.getElementById("area").style.display="";
                document.getElementById("labelMenit").style.display="";
                document.getElementById("menit").style.display="";
                document.getElementById("labelDetail").style.display="";
                document.getElementById("detailLabel").style.display="";
                document.getElementById("detail").style.display="";
            }
        };  


    $(document).ready(function() {

        $.ajax({
            type: 'GET',
            url: "form_problem/kategori.php",
            cache: false,
            success: function(msg) {
                $("#kategori").html(msg);
            }
        });

        function getjenisKategori() {
            var jenis = $('#kategori').val();
            $.ajax({
                type: 'GET',
                url: "form_problem/jenis_prob.php",
                data: {
                    tkategori: jenis,
                    },
                cache: false,
                success: function(msg) {
                    $("#jenis_problem").html(msg);
                }
            });
        }

        function getsubProblem() {
            var jenis = $('#kategori').val();
            var jenis_prob = $("#jenis_problem").val();
            $.ajax({
                type: 'GET',
                url: "form_problem/sub_prob.php",
                data: {
                    tjenis_prob: jenis_prob, tkategori: jenis
                    },
                cache: false,
                success: function(msg) {
                    $("#sub_problem").html(msg);
                }
            });
        }
       
        $("#kategori").change(function() {
            getjenisKategori()
            getsubProblem()
        });

        $("#jenis_problem").change(function() {
            getsubProblem()
        });

    });

    // countermeasure problem
    $('#input_counter').on("click",function(){
    var id_counter = $ (".id_counter").val();
    var detail_prob = $ ("#detail_prob").val();

    $.ajax({
        method: "POST",
        url: "countermeasure.php",
        data: {sid_counter:id_counter, sdetail_prob:detail_prob}
    })
    .done(function(hasilinputwos){
        $('#countermeasure').modal('toggle');
        $("#form_countermeasure").trigger('reset');
        reloadtable ();
    });
    
    });

    function reloadtarget(){
    setInterval (function(){
        $('#target_produksi').load('ajax/target.php').fadeIn("fast");
    },500
    )
    ;}

     // rev target
     $('#edit_target').on("click",function(){
    var id_d14 = $ ("#id_d14").val();
    var d14 = $ ("#d14").val();

    $.ajax({
        method: "POST",
        url: "rev_target.php",
        data: {sid_d14:id_d14, 
                sd14:d14}
    })
    .done(function(hasilinputwos){
        $('#plan_d14').modal('toggle');
        $("#revisi").trigger('reset');
        reloadtarget ();
    });
    
    });

    // input planing produksi
    $('#input_target').on("click",function(){
    var tanggal = $ ("#tanggal_target").val();
    var shift = $ ("#shift_target").val();
    <?php          
        $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=1");                    
        foreach($tabel AS $data){
        $type = $data['type'];
        ?>
        var hasil<?php echo $type?> = $("#<?php echo $type.'1'?>").val(); //3 VAR
    <?php
    }
    ?>

    $.ajax({
        method: "POST",
        url: "ajax_target/target_planing.php",
        data: {sshift: shift, 
            <?php foreach($tabel AS $data){ 
                $type = $data['type'];
            ?>
            <?php echo $type?>:hasil<?php echo $type?>, 
            <?php } ?>
            stanggal:tanggal
        }
    })
    .done(function(hasilinput){
        $('#plan').modal('toggle');
        $("#close_plan").trigger('reset');
        reloadtable ();
        
    });
    
    });

    // input jam_jaman produksi
    $('#input').on("click",function(){
    var tanggal = $ ("#tanggal").val();
    var shift = $ ("#shift").val();
    <?php          
        $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=1");                    
        foreach($tabel AS $data){
        $type = $data['type'];
        ?>
    var hasil<?php echo $type?> = $("#<?php echo $type?>").val(); //3 VAR
    <?php
    }
    ?>
    <?php          
        $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=1");                    
        foreach($tabel AS $data){
        $id = $data['id'];
        ?>
    var id<?php echo $id?> = $("#<?php echo $id?>").val(); //3 VAR
    <?php
    }
    ?>
    var id = $ (".jam1").val();
    var id_hasil_prob = $ ("#id_hasil_prob").val();

    $.ajax({
        method: "POST",
        url: "hasil_prod.php",
        data: {sshift: shift, 
            <?php foreach($tabel AS $data){ 
                $type = $data['type'];
            ?>
            <?php echo $type?>:hasil<?php echo $type?>, 
            <?php } ?>
            stanggal:tanggal, 
            sid:id,
            <?php foreach($tabel AS $data){ 
                $id_problem = $data['id'];
            ?>
            <?php echo $id_problem?>:id<?php echo $id_problem?>, 
            <?php } ?>
            sid_hasil_prob: id_hasil_prob
        }
    })
    .done(function(hasilinput){
        $('#npk').modal('toggle');
        $("#hasil_jam").trigger('reset');
        var dataajaxx = hasilinput,
        obj = JSON.parse(dataajaxx);
        $("#id_hasil_prob").val(obj.id_hasil);
        reloadtable ();
        
    });
    
    });


    function reloadtable(){
    setInterval (function(){
        $('#startwosx').load('input_wosver2.php?id=1').fadeIn("fast");
        $('#endwosx').load('input_wosver2.php?id=2').fadeIn("fast");
    },500
    )
    ;}

    // input wos
    $('#star_wos').on("click",function(){
    var shift_wos = $ ("#shift_wos").val();
    var wos_awal = $ ("#wos_awal").val();
    var tgl_wos = $ ("#tgl_wos").val();
    var group_shift = $ ("#group_shift").val();
    var pic_wos = $ ("#pic_wos").val();

    $.ajax({
        method: "POST",
        url: "star_wos.php",
        data: {sshift_wos: shift_wos,
                swos_awal:wos_awal, 
                stgl_wos:tgl_wos,
                sgroup_shift:group_shift, 
                spic_wos:pic_wos}
    })
    .done(function(hasilinputwos){
        var dataajax = hasilinputwos,
        obj = JSON.parse(dataajax);
        $("#id").val(obj.id); //obj.id
        $('#wos').modal('toggle');
        $("#woss").trigger('reset');
        reloadtable();
    });
    
    });

    // edit wos
    $('#finish_wos').on("click",function(){
    var id = $ ("#id").val();
    var edit_wos = $ ("#edit_wos").val();

    $.ajax({
        method: "POST",
        url: "finish_wos.php",
        data: {sid:id, sedit_wos:edit_wos}
    })
    .done(function(hasilinputwos){
        $('#finish').modal('toggle');
        $("#finish_woss").trigger('reset');
        reloadtablewos ();
    });
    
    });

    // edit ot awal
    $('#edit_ot_awal_awal').on("click",function(){
    var id_overtime_awal = $ (".id_ot_awal_awal").val();
    var edit_overtime_awal = $ ("#revisi_ot_awal").val();

    $.ajax({
        method: "POST",
        url: "ajax/ot_awal.php",
        data: {sid_overtime_awal: id_overtime_awal, 
            sedit_overtime_awal: edit_overtime_awal}
    })
    .done(function(hasil){
        $('#revisi_awal_awal').modal('toggle');
        $("#awal_ot").trigger('reset');
        reloadot ();
    });
    
    });

    // edit ot awal2
    $('#edit_ot_awal_akhir').on("click",function(){
    var id_overtime_awal = $ (".id_ot_awal_awal").val();
    var edit_overtime_awal2 = $ ("#revisi_ot_awal_akhir").val();

    $.ajax({
        method: "POST",
        url: "ajax/ot_awal2.php",
        data: {sid_overtime_awal: id_overtime_awal, 
            sedit_overtime_awal2: edit_overtime_awal2}
    })
    .done(function(hasil){
        $('#revisi_awal_akhir').modal('toggle');
        $("#akhir_awal_ot").trigger('reset');
        reloadot ();
    });
    
    });

    function reloadot(){
    setInterval (function(){
        $('#awal_mulai').load('overtime.php?id=1').fadeIn("fast");
        $('#awal_akhir').load('overtime.php?id=2').fadeIn("fast");
        $('#akhir_mulai').load('overtime.php?id=3').fadeIn("fast");
        $('#akhir_akhir').load('overtime.php?id=4').fadeIn("fast");
        },500
        )
        ;}

    // edit ot akhir1
    $('#edit_ot_akhir_awal').on("click",function(){
    var id_overtime_akhir = $ (".id_ot_akhir").val();
    var edit_overtime_akhir1 = $ ("#revisi_ot_akhir1").val();

    $.ajax({
        method: "POST",
        url: "ajax/ot_akhir1.php",
        data: {sid_overtime_akhir: id_overtime_akhir, 
            sedit_overtime_akhir1: edit_overtime_akhir1}
    })
    .done(function(hasil){
        $('#revisi_akhir_awal').modal('toggle');
        $("#akhir_awal_ot").trigger('reset');
        reloadot ();
    });
    
    });

    // edit ot akhir
    // $('#edit_ot_akhir').on("click",function(){
    // var id_overtime_akhir = $ (".id_ot_akhir").val();
    // var edit_overtime_akhir = $ ("#revisi_ot_akhir").val();

    // $.ajax({
    //     method: "POST",
    //     url: "ajax/ot_akhir2.php",
    //     data: {sid_overtime_akhir: id_overtime_akhir, 
    //         sedit_overtime_akhir: edit_overtime_akhir}
    // })
    // .done(function(hasil){
    //     $('#revisi_akhir_akhir').modal('toggle');
    //     $("#akhir_ot").trigger('reset');
    //     reloadot ();
    // });
    
    // });

    // function reloadtableakhir(){
    // setInterval (function(){
    //     $('#awal_mulai').load('overtime.php?id=1').fadeIn("fast");
    //     $('#awal_akhir').load('overtime.php?id=2').fadeIn("fast");
    //     $('#akhir_mulai').load('overtime.php?id=3').fadeIn("fast");
    //     $('#akhir_akhir').load('overtime.php?id=4').fadeIn("fast");
    //     },500
    //     );}
    //  // input overtime
    //  $('#input_ot_akhir').on("click",function(){
    // var dept_ot = $ ("#dept_ot").val();
    // var date_ot = $ ("#date_ot").val();
    // var shift_ot = $ ("#shift_ot").val();
    // var mulai_ot_akhir = $ ("#mulai_ot_akhir").val();
    // var akhir_ot_akhir = $ ("#akhir_ot_akhir").val();

    // $.ajax({
    //     method: "GET",
    //     url: "input_ot_akhir.php",
    //     data: {sdept_ot: dept_ot,
    //             sdate_ot: date_ot, 
    //             sshift_ot: shift_ot,
    //             smulai_ot_akhir: mulai_ot_akhir, 
    //             sakhir_ot_akhir: akhir_ot_akhir}
    // })
    // .done(function(hasil_ot_akhir){
    //     $('#ot_akhir').modal('toggle');
    //     $("#akhir").trigger('reset');
    //     reloadtableakhir();
    // });
    
    // });

    </script>

</body>

</html>
