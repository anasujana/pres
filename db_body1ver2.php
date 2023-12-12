<!DOCTYPE html>
<html lang="en">
<?php
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

</head>
<body>
    <?php 
    include './koneksi/koneksi.php';
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

        // setInterval (function(){
        //     $('#input_wosver2').load('input_wosver2.php').fadeIn("fast");
        // },500
        // )
        // ;

        setInterval (function(){
        $('#startwosx').load('input_wosver2.php?id=1').fadeIn("fast");
        $('#endwosx').load('input_wosver2.php?id=2').fadeIn("fast");
        $('.inputwosidauto').load('input_wosver2.php?id=3').fadeIn("fast");
        },500
        )
        ;

        setInterval (function(){
            $('#jamjaman').load('jamjaman.php<?php 
            if(isset($_GET['mulai_ot_awal'])){
                $terima_mulai_ot = $_GET['mulai_ot_awal'];
                echo '?mulai_ot_awal='.$terima_mulai_ot;
            }else if(isset($_GET['akhir_ot_akhir'])){
                $terima_akhir_ot = $_GET['akhir_ot_akhir'];
                echo '?akhir_ot_akhir='.$terima_akhir_ot;
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

                    $pic = mysqli_fetch_array(mysqli_query ($cnts,"SELECT pic FROM wos where tgl='$tgl_shift'"));
                    $name_pic= $pic['pic'];
                ?>
                <thead class="bg-secondary text-white">
                    <tr>
                        <th style="vertical-align : middle;text-align:center;" colspan="3">NIGHT SHIFT</th>
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
        <div class="col-sm-3">
            <?php
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

            $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT plan_produksi FROM plan where unit='d14' and tgl='$tgl' and shift='$shift'"));
            $d14= $plan['plan_produksi'];
            $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT plan_produksi FROM plan where unit='d26' and tgl='$tgl' and shift='$shift'"));
            $d26= $plan['plan_produksi'];
            $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT plan_produksi FROM plan where unit='d12' and tgl='$tgl' and shift='$shift'"));
            $d12= $plan['plan_produksi'];
            $total=  $d14+$d26+$d12;
            ?>
            <table class="table-bordered table-sm  text-center revisi" width="100%" cellspacing="0">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th colspan="3" class="rev" data-toggle="modal" data-d14='<?php echo $d14; ?>' data-d26='<?php echo $d26; ?>' data-d12='<?php echo $d12; ?>' data-target="#plan">TARGET PRODUKSI</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tr class="bg-white">
                    <td data-toggle="modal"  data-target="#plan_d14">D14 : <?php echo $d14; ?> </td> 
                    <td data-toggle="modal"  data-target="#plan_d26">D26 : <?php echo $d26; ?></td>
                    <td data-toggle="modal"  data-target="#plan_d12">D12 : <?php echo $d12; ?></td>
                    <td><?php echo $total; ?></td>
                </tr>                             
            </table>
        </div>      
        <!-- kolom overtime-->
        <div class="col-sm-3">
            <table class=" table-sm table-bordered text-center" id="data_me" width="100%" cellspacing="0">
                <?php 
                $ot = mysqli_fetch_array(mysqli_query ($cnts,"SELECT mulai,selesai FROM ot_awal where tgl='2023-01-05' and shift='malam'"));
                $awal_mulai= $ot['mulai'];
                $awal_akhir= $ot['selesai'];  

                $ot_akhir = mysqli_fetch_array(mysqli_query ($cnts,"SELECT mulai,selesai FROM ot_akhir where tgl='2023-01-05' and shift='malam'"));
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
                             
                ?>
                <thead class="bg-secondary text-white">
                    <tr>
                        <th colspan="2" data-toggle="modal" data-target="#ot_awal">O/T AWAL</th>
                        <th colspan="2" data-toggle="modal" data-target="#ot_akhir">O/T AKHIR</th>
                    </tr>
                </thead>
                <tr class="bg-white">
                    <td><?php echo $awal_mulai ?></td> 
                    <td><?php echo $awal_akhir ?></td>
                    <td><?php echo $akhir_mulai ?></td>
                    <td><?php echo $akhir_akhir ?></td>
                </tr>                             
            </table>
        </div>
        <!-- kolom wos -->
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
            
            $wos = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,group_shift,shift,tgl,start,finish,pic FROM wos where tgl='$tgl' and shift='$shift'"));
            $id= $wos['id'];
            $start= $wos['start'];  
            $finish= $wos['finish'];
        ?>
        <div class="col-sm-3" id="input_wos">   
            <table class="table-bordered table-sm text-center wosss" id="tablee" width="100%" cellspacing="0">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th colspan="2" >START & FINISH WOS</th>
                    </tr>
                </thead>
                <tr class="bg-white">
                    <td data-toggle="modal" data-target="#wos">START : <span id="startwosx"></span></td> 
                    <td  class='finish' data-toggle="modal" data-id='<?php echo $id; ?>' data-start='<?php echo $start; ?>' 
                        data-finish='<?php echo $finish; ?>' data-target="#finish">FINISH : <span id="endwosx"></span></td>
                </tr>                             
            </table>
        </div>
    </div>

    
    <!-- [ Main Content ] start -->
            <br>
            <div class="card">
                <!-- <form action="db_body1.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3"> -->
                        <!-- <div class="custom-file"> -->
                            <!-- <input type="file" class="custom-file-input" id="upload" name="file"> -->
                            <!-- <label class="custom-file-label" for="inputGroupFile02">Choose file</label> -->
                        <!-- </div>  -->
                        <!-- <div class="input-group-append">
                            <input class="input-group-text bg-primary text-white" id="simpan" type="submit" name="submit" value="upload file"> 
                        </div> -->
                    <!-- </div>
                </form>  -->

                <!-- upload target produksi -->
                <?php
                    if(isset($_POST['submit'])){
                        $err="";
                        $ekstensi= "";
                        $succes= "";

                        $file_name= $_FILES['file']['name'];
                        $file_data= $_FILES['file']['tmp_name'];

                        if(empty($file_name)){
                            $err= "<li>masukan file</li>"; 
                        }
                        else{
                            $ekstensi= pathinfo($file_name)['extension'];
                        }

                        $ekstensi_allowed= array("xls","xlsx","csv");
                        if(!in_array($ekstensi, $ekstensi_allowed)){
                            $err= "<p class='text-center'>you must upload file xls or xlsx</p>";
                        }

                        if(empty($err)){
                            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
                            $spreadsheet= $reader->load($file_data);
                            $sheet_data= $spreadsheet->getActiveSheet()->toArray();

                            $jumlah_data= 0;
                            for($i=1;$i<count($sheet_data);$i++){
                                $tgl= $sheet_data [$i]['0'];
                                $shift= $sheet_data [$i]['1'];
                                $unit= $sheet_data [$i]['2'];
                                $plan_produksi= $sheet_data [$i]['3'];
                                $tgl= date("y-m-d",strtotime ($tgl));

                                $sql1= "insert into plan(tgl,shift,unit,plan_produksi)
                                VALUES('$tgl','$shift','$unit','$plan_produksi')";

                                mysqli_query($cnts, $sql1);
                                $jumlah_data++;
                                
                            }
                            if($jumlah_data > 0){
                                $succes= "<p class='text-center'>upload file succes</p>";
                            }
                        }

                        if($err){
                            echo "$err";
                        }
                        if($succes){
                            echo "$succes";
                        }
                    }
                ?>

                <div class="card-header">
                    <h5 class=" align-middle text-center font-weight-bold ">LINE #1 
                    </h5>
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

                <!-- Modal plan produksi-->
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
                            <form action="rev_produksi.php" method="post">
                                <div class="form-row"> 
                                    <?php          
                                    $plan1 = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,unit FROM plan where tgl='$tgl_shift' and shift='$shift'and unit='d14'"));                   
                                    $id1 = $plan1['id'];
                                    $plan_produksi = $plan1['unit'];
                                    ?>                                  
                                        <input type="hidden" name="id_d14" class="form-control"  id="" placeholder="" value="<?php echo $id1; ?>" >
                                    <div class="form-group col-md-12">
                                        <label for="Nama">D14</label>
                                        <input type="number" name="d14" class="form-control" id="" placeholder="" value="">
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
                <!-- Modal plan produksi-->
                <div class="modal fade" id="plan_d26" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="rev_produksi.php" method="post">
                                <div class="form-row"> 
                                    <?php          
                                    $plan1 = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,unit FROM plan where tgl='$tgl_shift' and shift='$shift'and unit='d26'"));                   
                                    $id1 = $plan1['id'];
                                    $plan_produksi = $plan1['unit'];
                                    ?>                                  
                                        <input type="hidden" name="id_d26" class="form-control"  id="" placeholder="" value="<?php echo $id1; ?>" >
                                    <div class="form-group col-md-12">
                                        <label for="Nama">D26</label>
                                        <input type="number" name="d26" class="form-control" id="" placeholder="" value="">
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
                <!-- Modal plan produksi-->
                <div class="modal fade" id="plan_d12" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="rev_produksi.php" method="post">
                                <div class="form-row"> 
                                    <?php          
                                    $plan1 = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,unit FROM plan where tgl='$tgl_shift' and shift='$shift'and unit='d12'"));                   
                                    $id1 = $plan1['id'];
                                    $plan_produksi = $plan1['unit'];
                                    ?>                                  
                                        <input type="hidden" name="id_d12" class="form-control"  id="" placeholder="" value="<?php echo $id1; ?>" >
                                    <div class="form-group col-md-12">
                                        <label for="Nama">D12</label>
                                        <input type="number" name="d12" class="form-control" id="" placeholder="" value="">
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
                               <div class="form-row">
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
                                    <div class="form-group col-md-4">
                                       <input type="text" name="dept" class="form-control" id="" placeholder="dept" value="1">
                                    </div>  
                                    <div class="form-group col-md-4">
                                        <input type="date" name="date_ot" class="form-control" id="" placeholder="date" value="<?php echo $tgl?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="shift_ot" class="form-control"  id="" placeholder="shift" value="malam" >
                                    </div>
                                </div>    
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
                            <form action="" method="GET">
                               <div class="form-row">
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
                                    <div class="form-group col-md-4">
                                       <input type="text" name="dept" class="form-control" id="" placeholder="dept" value="1">
                                    </div>  
                                    <div class="form-group col-md-4">
                                        <input type="date" name="date_ot" class="form-control" id="" placeholder="date" value="<?php echo $tgl?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="shift_ot" class="form-control"  id="" placeholder="shift" value="malam" >
                                    </div>
                                </div>    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Nama">Jam Mulai</label>
                                        <input type="time" name="mulai_ot_akhir" class="form-control" id="" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputpictagane">Jam Akhir</label>
                                        <input type="time" name="akhir_ot_akhir" class="form-control"  id="" placeholder="" value="" >
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
                                        <input type="number" name="id" class="form-control" value="<?php echo $id?>" id="id">
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
                                    <div class="form-group col-md-4">                                     
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
                                    <div class="form-group col-md-4">
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
                                    <div class="form-group col-md-4">
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
                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="finish" class="form-control" id="finishh" value="" placeholder="finish">
                                    </div>                                   
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="pic" class="form-control" id="pic_wos" placeholder="pic">
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
                                <input type="hidden" name="jam" value='' class="form-control" placeholder=""  id="jam1"> 
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
                                    <div class="form-group col-md-4">
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
            
        <!-- Modal -->
        <div class=" add_npk modal fade" id="problem" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Problem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="db_body1.php" method="post">
                    <div class="modal-body">                              
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputpictagane">Kategori</label>
                                <select name="dept" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">Internal</option>
                                    <option value="2">External</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputpictagane">Problem</label>
                                <select name="dept" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">Equipment</option>
                                    <option value="2">Quality</option>
                                    <option value="1">Other</option>
                                    <option value="2">Process</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputpictagane">Problem</label>
                                <select name="dept" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">PSW</option>
                                    <option value="1">JIG</option>
                                    <option value="2">Conv</option>
                                    <option value="1">RSW</option>
                                    <option value="2">RCW</option>
                                    <option value="1">Las Co</option>
                                    <option value="2">Rotary</option>
                                    <option value="1">Hanger</option>
                                    <option value="2">Shuttle</option>
                                    <option value="2">Auto Gun</option>
                                    <option value="1">Heming Machine</option>
                                    <option value="2">Lifter</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Nama">Area</label>
                                <select name="dept" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">UB MIX LINE</option>
                                    <option value="1">JIG</option>
                                    <option value="2">Conv</option>
                                    <option value="1">RSW</option>
                                    <option value="2">RCW</option>
                                    <option value="1">Las Co</option>
                                    <option value="2">Rotary</option>
                                    <option value="1">Hanger</option>
                                    <option value="2">Shuttle</option>
                                    <option value="2">Auto Gun</option>
                                    <option value="1">Heming Machine</option>
                                    <option value="2">Lifter</option>
                                </select>
                            </div>
                        </div>
                        <p><label for="w3review">Detail Problem :</label></p>
                        <textarea id="detail_prob" name="detail_prob " rows="4" cols="58"></textarea>
                        <br>
                    </div>
                    <div class="modal-footer">                                
                        <input type="submit" id="konfir" class="btn btn-primary float-right" value="save">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- Modal -->
        <div class=" add_npk modal fade" id="countermeasure" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success" id="exampleModalCenterTitle">Countermeasure Problem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="db_body1.php" method="post">
                    <div class="modal-body">                              
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea id="detail_prob" name="detail_prob " rows="4" cols="58"></textarea>
                                <br>
                            </div>  
                        </div>                      
                    </div>
                    <div class="modal-footer">                                
                        <input type="submit" id="konfir" class="btn btn-primary float-right" value="save">
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
        
        $('#jam1').val(id1);
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


    $('.revisi').on('click','.rev',function(){
        var id = this;
        var id1 = $(this).data('d14');
        
        $('#d14').val(id1);
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

    // upload plan produksi
    // $(document).ready( function () {
	// 	$("#simpan").click(function(a){
    //         a.preventDefault();

	// 		const fileupload = $('#upload').prop('files')[0];
	// 		//var nama_file = $('#nama_file').val();
    //         console.log(fileupload)
	// 		if (fileupload !="") {
	// 	        let formData = new FormData();
	// 	        formData.append('upload', fileupload);
    //             console.log(formData)
	// 	        $.ajax({
	// 	            type: 'POST',
	// 	            url: "upload.php",
	// 	            data: formData,
	// 	            cache: false,
	// 	            processData: false,
	// 	            contentType: false,
    //                 success: function(data) {
    //                     table.ajax.reload();
    //                 swal("Terimakasih","Data berhasil di upload","success");
    //                 }
	// 	        });
	// 	    }
    //     });
    // });

    function reloadtable(){
    setInterval (function(){
        $('#jamjaman').load('jamjaman.php').fadeIn("fast");
    },500
    )
    ;}

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
    var id = $ ("#jam1").val();

    $.ajax({
        method: "POST",
        url: "hasil_prod.php",
        data: {sshift: shift, 
            <?php foreach($tabel AS $data){ 
                $type = $data['type'];
            ?>
            <?php echo $type?>:hasil<?php echo $type?>, 
            <?php } ?>
            stanggal:tanggal, sid:id}
    })
    .done(function(hasilinput){
        $('#npk').modal('toggle');
        $("#hasil_jam").trigger('reset');
        reloadtable ();
    });
    
    });

    function reloadtable(){
    setInterval (function(){
        $('#startwosx').load('input_wosver2.php?id=1').fadeIn("fast");
        $('#endwosx').load('input_wosver2.php?id=2').fadeIn("fast");
        $('.inputwosidauto').load('input_wosver2.php?id=3').fadeIn("fast");
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


    
    </script>  

</body>

</html>
