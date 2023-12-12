<!DOCTYPE html>
<html lang="en">
<?php
    date_default_timezone_set('Asia/Jakarta');
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
    <div class="card-body">
    <div class="row">
        <div class="col-md-2 col-md-2">
            <table id="hasil" class="table table-bordered table-sm text-center monitor">
                
            </table>
        </div>
        <div class="col-md-8 col-md-8">       
        <br>
        <h4 class=" align-middle text-center font-weight-bold ">PRODUCTION RESULT </h5>
        <h1 class=" align-middle text-center font-weight-bold ">MAIN BODY MIX LINE </h5>
        </div>

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
    </script>

        <div class="col-md-2 col-md-2">
        <table  class="table table-bordered table-sm text-center monitor">
                <thead>
                    <th style="font-size:16px">PASSRATE</th>
                </thead>
                <tbody>
                    <td style="font-size:30px" id="passrate"></td>
                </tbody>
            </table>
        </div>
    </div>
    </div>
   
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4"> 
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
                        
                        $t_time = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tacktime FROM target where tgl='$tgl_shift'"));
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
            <div class="col-sm-4">
                <?php
               $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT plan_produksi FROM plan where unit='d14' and tgl='$tgl_shift' and shift='malam'"));
               $d14= $plan['plan_produksi'];
               $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT plan_produksi FROM plan where unit='d26' and tgl='$tgl_shift' and shift='malam'"));
               $d26= $plan['plan_produksi'];
               $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT plan_produksi FROM plan where unit='d12' and tgl='$tgl_shift' and shift='malam'"));
               $d12= $plan['plan_produksi'];
               $total=  $d14+$d26+$d12;
                ?>
                <table class="table-bordered table-sm  text-center" id="data_me" width="100%" cellspacing="0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th colspan="3" data-toggle="modal" data-jam='<?php echo $jam_mulai; ?>' data-target="#plan">PLAN</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tr class="bg-white">
                        <td>D14 : <?php echo $d14; ?> </td> 
                        <td>D26 : <?php echo $d26; ?></td>
                        <td>D12 : <?php echo $d12; ?></td>
                        <td><?php echo $total; ?></td>
                    </tr>                             
                </table>
            </div>
            <!-- <div class="col-sm-3 col-sm-3">
            <?php
                $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT rev_produksi FROM rev where unit='d14' and tgl='2022-12-26' and shift='pagi'"));
                $d14= $plan['rev_produksi'];
                $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT  rev_produksi FROM rev where unit='d14' and tgl='2022-12-26' and shift='pagi'"));
                $d26= $plan['rev_produksi'];
                $plan = mysqli_fetch_array(mysqli_query ($cnts,"SELECT  rev_produksi FROM rev where unit='d14' and tgl='2022-12-26' and shift='pagi'"));
                $d12= $plan['rev_produksi'];
                $total=  $d14+$d26+$d12;
                ?>
                <table class=" table-sm table-bordered text-center" id="data_me" width="100%" cellspacing="0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th colspan="3" data-toggle="modal" data-jam='<?php echo $jam_mulai; ?>' data-target="#revisi">REVISI</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tr class="bg-white">
                        <td>D14 : <?php echo $d14; ?> </td> 
                        <td>D26 : <?php echo $d26; ?></td>
                        <td>D12 : <?php echo $d12; ?></td>
                        <td><?php echo $total; ?></td>
                    </tr>                             
                </table>
            </div> -->
            <div class="col-sm-4">
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

                $wos = mysqli_fetch_array(mysqli_query ($cnts,"SELECT id,start,finish FROM wos where tgl='$tgl' and shift='$shift'"));
                $id= $wos['id'];
                $start= $wos['start'];  
                $finish= $wos['finish'];             
                ?>
                <table class="table-bordered table-sm text-center wos" id="data_me" width="100%" cellspacing="0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th colspan="2" >START & FINISH</th>
                        </tr>
                    </thead>
                    <tr class="bg-white">
                        <td data-toggle="modal" data-target="#wos">START : <?php echo $start; ?></td> 
                        <td class='finish' data-toggle="modal" data-id='<?php echo $id; ?>' data-start='<?php echo $start; ?>' 
                            data-finish='<?php echo $finish; ?>' data-target="#finish" >FINISH : <?php echo $finish; ?></td>
                    </tr>                             
                </table>
            </div>
        </div>
    </div>
    <!-- </div> -->
   
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ horizontal-layout ] start -->
        <div class="col-sm-12">
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

                <!-- Modal -->
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
                            <form action="db_body1.php" method="post">
                               <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="Nama">D14</label>
                                        <input type="number" name="hasil" class="form-control" id="hasil" placeholder="D14" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">D26</label>
                                        <input type="number" name="pic" class="form-control"  id="inputpictagane" placeholder="D26" value="<?php echo $_SESSION["npk"];?>" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">D12</label>
                                        <input type="number" name="pic" class="form-control"  id="inputpictagane" placeholder="D12" value="<?php echo $_SESSION["npk"];?>" >
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

                 <!-- Modal -->
                 <div class="modal fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi Planing Produksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="db_body1.php" method="post">
                               <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="Nama">D14</label>
                                        <input type="number" name="hasil" class="form-control" id="hasil" placeholder="D14" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">D26</label>
                                        <input type="number" name="pic" class="form-control"  id="inputpictagane" placeholder="D26" value="<?php echo $_SESSION["npk"];?>" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">D12</label>
                                        <input type="number" name="pic" class="form-control"  id="inputpictagane" placeholder="D12" value="<?php echo $_SESSION["npk"];?>" >
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

                <!-- Modal -->
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
                            <form action="finish_wos.php" method="post">
                                <div class="form-row">
                                    <!-- <div class="form-group col-md-6"> -->
                                        <input type="hidden" name="id" class="form-control" id="id">
                                    <!-- </div> -->
                                    <div class="form-group col-md-6">
                                        <label for="inputState">START</label>
                                        <input type="text" name="start" class="form-control" id="start">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">FINISH</label>
                                        <input type="text" name="finish" class="form-control" value="">
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

                <!-- Modal -->
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
                            <form action="star_wos.php" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputState">START</label>
                                        <input type="text" name="start" class="form-control" id="">
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
                                        <input type="hidden" name="tgl" value=<?php echo $tgl?> class="form-control" placeholder="<?php echo $tgl?>"  id="Problem" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php                                   
                                            $tgl_shift=date('Y-m-d');
                                        
                                            $tabel = mysqli_fetch_array(mysqli_query ($cnts,"SELECT day,night FROM shift_kerja where tanggal='$tgl_shift'"));                    
                                            $day = $tabel ['day'];
                                            $night = $tabel ['night'];
                                            if($time_now>='20:30' and $time_now<='23:59'){
                                                $shift = 'malam';
                                            }else if($time_now>='00:00' and $time_now<='07:14'){
                                                $shift = 'malam';
                                            }else if($time_now>='07:15' and $time_now<='20:29'){
                                                $shift = 'pagi';
                                            }        
                                        ?>
                                        <input type="hidden" name="shif" value="<?php echo $shift?>" class="form-control" id="" placeholder="" readonly>
                                    </div> 
                                    <div class="form-group col-md-6">
                                        <input type="hidden" name="finish" class="form-control" value="">
                                    </div>                                   
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="text" name="pic" class="form-control" id="">
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
                        if(isset($_POST['start']) and isset($_POST['finish']) and isset($_POST['tgl'])and isset($_POST['shif'])){
                        // terima data   
                        
                        $start = $_POST['start'];
                        $finish = $_POST['finish'];
                        $tgl = $_POST['tgl'];
                        $shif = $_POST['shif'];
                        
                        // tambahkan ke database   
                            $add = mysqli_query($cnts,"INSERT INTO wos VALUES ('','$shif','$tgl','$start','$finish')");
                        }
                    ?>
                
                <!-- Modal -->
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
                            <form action="db_body2.php" method="POST">  
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
                                        <input type="date" name="tanggal" value=<?php echo $tgl?> class="form-control" placeholder="<?php echo $tgl?>"  id="Problem" readonly>
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
                                        <input type="text" name="shift1" value="<?php echo $shift?>" class="form-control" id="" placeholder="" readonly>
                                    </div> 
                                    
                                    <div class="form-group col-md-4">
                                        <label for="inputpictagane">jam ke</label>
                                        <input type="number" name="no" value='' class="form-control" placeholder=""  id="no1" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <?php          
                                    $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=2");                    
                                    foreach($tabel AS $data){
                                    $type = $data['type'];
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label for="Nama">Hasil : <?php echo $type; ?></label>
                                        <input type="number" name="<?php echo $type; ?>" class="form-control" id="terios" placeholder="" required>
                                    </div>
                                    <?php
                                    }
                                    ?>
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
                        if(isset($_POST['tanggal']) and isset($_POST['jam']) and isset($_POST['shift1'])){
                        // terima data   
                        
                        $terima_tanggal = $_POST['tanggal'];
                        $terima_jam = $_POST['jam'];
                        $terima_shift1 = $_POST['shift1'];
                        
                        //loop
                        $tabel = mysqli_query ($cnts,"SELECT * FROM type_unit where dept=2");                    
                        foreach($tabel AS $data){
                            $type = $data['type'];
                            $unit = $_POST[$type];
                        // tambahkan ke database   
                            $add = mysqli_query($cnts,"INSERT INTO hasil_unit VALUES ('','$terima_shift1','$type','$unit','$terima_tanggal','$terima_jam')");
                        }
              
                        }
                    ?>

                    <?php   
                            $tgl=date('Y-m-d');
                            $time=date('H:i');  

                            if($time>='07:15' and $time<='20:14'){
                                $sif = 'pagi';
                            }else if($time>='20:30' and $time<='07:14'){
                                $sif = 'malam';
                            }
                            
                            $target2 = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tanggal from hasil_unit order by tanggal desc limit 1 "));   
                            $target3= $target2['tanggal'];
                        
                            $tabel = mysqli_query ($cnts,"SELECT *, (SELECT SUM(`hasil`) FROM `hasil_unit` `hu` WHERE `hu`.`id_target`=`tg`.`id` AND `hu`.`tanggal` = '$target3') AS `total`
                            FROM `target` `tg` WHERE `tg`.`tgl`<='$tgl' and `tg`.`tgl_akhir`>='$tgl' AND `tg`.`shift`='$sif' and tg.dept=2 ORDER BY `tg`.`jam` ASC");                                                    
                        
                        $acm = 0;
                        $acm1 = 0;
                        $acm2 = 0;
                        $acm3 = 0;
                        $acm_menit = 0;
                    ?>
                <div class="card-body">
                    <div class="table-responsive ">
                        <form id="CekAll" method="post" action="">
                            <table class="table table-bordered table-sm text-center monitor" id="dataTable" height="50%" cellspacing="0">
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
                                    $No = $data['jam'];
                                    $jam_start = $data['jam_mulai']; 
                                    $jam_mulai= date(" H:i",strtotime ($jam_start)); 
                                    $jam_end = $data['jam_akhir'];
                                    $jam_akhir=$jam_akhir_display= date(" H:i",strtotime ($jam_end));
                                    // $problem = $data['prob'];
                                    // // $countermeasure = $data['countermeasure']; 
                                    // // $menit_prob = $data['menit_problem'];
                                                              
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
                        </form>
                    </div> 
                </div>
            </div>
        <!-- [ horizontal-layout ] end -->
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
                <div class="info-notif"></div>
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
                <div class="info-notif"></div>
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

    $('.wos').on('click','.finish',function(){
        var id = this;
        var id1 = $(this).data('id');
        
        $('#id').val(id1);
    })
    $('.wos').on('click','.finish',function(){
        var id = this;
        var id1 = $(this).data('start');
        
        $('#start').val(id1);
    })

    //auto focus input
    $(document).ready(function() {
        $('#npk').on('shown.bs.modal', function(){
            $('#hasil').trigger('focus');
            // $('#Problem').trigger('focus');
            // $('#Countermeasure').trigger('focus');
        });
    });
    </script>  

</body>

</html>
