<!DOCTYPE html>
<html lang="en">

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

    <!-- content -->
    <div class="row float-none">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">LINE #1 : UBAH JAM ISTIRAHAT</h4>
                    <form action="" method="GET" class="float-right">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <select name="dept" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">BODY 1</option>
                                    <option value="2">BODY 2</option>
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                                <select name="shift" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="pagi">pagi</option>
                                    <option value="malam">malam</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <select name="star_day" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="senin">senin</option>
                                    <option value="jumat">jumat</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <select name="end_day" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="kamis">kamis</option>
                                    <option value="jumat">jumat</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="date" name="star_date" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <input type="date" name="end_date" class="form-control" >
                            </div>
                            <div class="form-group col-xl-12 float-right">
                                <input type="submit" class="btn btn-primary rounded" value="GO">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive ">
                        <form action="change_time.php" method="POST">
                            <input type="number" name="dept_d" class="form-control"  
                                value="<?php if(isset($_GET["dept"])){ echo $_GET["dept"];};?>" readonly>
                            <input type="text" name="shift_s" class="form-control"  
                                value="<?php if(isset($_GET["shift"])){echo $_GET["shift"];};?>"readonly>
                            <input type="text" name="star_day_star" class="form-control"  
                                value="<?php if(isset($_GET["star_day"])){echo $_GET["star_day"];};?>"readonly>
                            <input type="text" name="end_day_end" class="form-control" 
                                value="<?php if(isset($_GET["end_day"])){echo $_GET["end_day"];};?>"readonly>
                            
                            <?php
                            $target = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tacktime from target  order by tgl desc limit 1 "));   
                            $tacktime= $target['tacktime'];
                            ?>
                            <input type="number" name="tacktime" class="form-control" value="<?php echo $tacktime;?>" readonly> 
                            <!-- insert old -->
                            <label for="">insert old</label>
                            <input type="text" name="tgl_old" class="form-control" 
                                value="<?php if(isset($_GET["end_date"])){
                                $end_date1 = $_GET['end_date'];
                                $tgl    = date('Y-m-d', strtotime('+1 days', strtotime($end_date1)));
                                echo $tgl ;
                                };?>" readonly>
                            <!-- edit -->
                            <label for="">edit</label>
                            <input type="text" name="tgl_edit" class="form-control" 
                                value="<?php if(isset($_GET["star_date"])){
                                $star_date = $_GET['star_date'];
                                $tgl_update    = date('Y-m-d', strtotime('-1 days', strtotime($star_date)));
                                echo $tgl_update ;
                                };?>" readonly>
                                
                            <!-- insert new -->
                            <label for="">insert new</label>
                            <input type="text" name="tgl_insert" class="form-control" 
                                value="<?php
                                if(isset($_GET["star_date"])){
                                echo $_GET["star_date"];
                                };?>" readonly>
                            <label for="">insert new</label>
                            <input type="text" name="tgl_akhir_insert" class="form-control" 
                                value="<?php 
                                if(isset($_GET["end_date"])){
                                    $end_date1 = $_GET['end_date'];
                                    echo $end_date1 ;
                                };?>" readonly>

                            <!-- looping jam -->
                            <?php
                                if(isset($_GET['shift'])){
                                    $terima_shift = $_GET['shift'];

                                $target = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tgl from target  order by tgl desc limit 1 "));   
                                $target1= $target['tgl'];

                                $tabel = mysqli_query ($cnts,"SELECT * FROM target tg WHERE tg.tgl='$target1' AND tg.shift='$terima_shift' and tg.dept=1 ORDER BY `tg`.`jam` ASC
                                ");

                                if($_GET['dept']>0){
                                }
                                
                                foreach($tabel AS $data){
                                    $id = $data['id'];
                                    $shift = $data['shift'];
                                    $jam = $data['jam'];
                                    $jam_start = $data['jam_mulai']; 
                                    $jam_mulai= date(" H:i",strtotime ($jam_start)); 
                                    $jam_end = $data['jam_akhir'];
                                    $jam_akhir= date(" H:i",strtotime ($jam_end));
                                    $plan= $data['plan']; 
                                    
                                ?> 
                            <div class="form-row">
                                <input type="hidden" name="jam" value="<?php echo $jam;?>" class="form-control">                         
                                <div class="form-group col-md-4">
                                    <label for="Nama">jam mulai</label>
                                    <input type="datetime" name="jam_mulai" value="<?php echo $jam_mulai;?>" class="form-control" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputpictagane">jam selesai</label>
                                    <input type="datetime" name="jam_akhir" class="form-control" value="<?php echo $jam_akhir;?>" >
                                </div>  
                                <div class="form-group col-md-4">
                                    <label for="inputpictagane">PLAN</label>
                                    <input type="number" name="<?php echo $jam;?>" class="form-control" value="<?php echo $plan;?>" >
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="form-row" >
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>&nbsp;
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                            <?php
                            }
                            ?>
                            <br>
                        </form>

                            <?php
                            
                            // if(isset($_GET['star_date']) and isset($_GET['end_date']) ){
                            //     $cek_date_awal = $_GET['star_date'];
                            //     $cek_date_akhir = $_GET['end_date'];
                            // }
                            // if(isset($_post['tgl_akhir_insert']) ){
                            //     $cek_date_akhir = $_post['tgl_akhir_insert'];
                            // }
                            //     echo $cek_date_awal;
                            //     echo $cek_date_akhir;
                            // $cek = mysqli_fetch_array(mysqli_query ($cnts,"SELECT * FROM target tg WHERE tg.tgl_akhir>'2023-02-20'"));
                            // echo "SELECT * FROM target tg WHERE tg.tgl_akhir>'$cek_date_akhir'";
                            // echo $cek['tgl'];

                            // if($cek['tgl']!= ''){
                            // if(isset($cek['tgl'])){
                            //     echo "ada";
                                // cek ada/tidak nya data
                                if(isset($_POST['dept_d']) ){
                                    // terima data   
                                    $dept = $_POST['dept_d'];
                                    $shift = $_POST['shift_s'];
                                    $star_day_star = $_POST['star_day_star'];
                                    $end_day_end = $_POST['end_day_end'];
                                    $tacktime = $_POST['tacktime'];
                                    $date_akhir = $_POST['tgl_old'];
                                    $tgl_edit = $_POST['tgl_edit'];
                                    $date_new_awal = $_POST['tgl_insert'];
                                    $date_new_akhir = $_POST['tgl_akhir_insert'];
                                    
                                    
                                    //loop
                                    $target = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tgl_akhir from target  order by tgl desc limit 1 "));
                                    $target1= $target['tgl_akhir'];

                                    $t_time = mysqli_query ($cnts,"SELECT * FROM `target` `tg` WHERE `tg`.`tgl_akhir`='$target1' AND tg.shift='$shift' and tg.dept=1 ORDER BY `tg`.`jam` ASC");                   
                                    foreach($t_time AS $data){
                                        $id = $data['id'];
                                        $jam = $data['jam'];
                                        $jam_mulai = $data['jam_mulai'];
                                        $jam_akhir = $data['jam_akhir'];
                                        $target = $data['plan'];
                                        $terima_jam = $_POST[$jam];

                                        echo 'tes';
    
                                    $cek = mysqli_fetch_array(mysqli_query ($cnts,"SELECT * FROM target tg WHERE tg.tgl_akhir>'$date_new_akhir'"));
                                    if(isset($cek['tgl'])){
                                        //insert old
                                        $tambahOld = mysqli_query($cnts,"INSERT INTO target VALUES ('','$dept','$jam','$shift','$star_day_star','$end_day_end','$tacktime','$jam_mulai','$jam_akhir','$target','$date_akhir','$target1')");
                                        //edit
                                        $update = mysqli_query($cnts,"UPDATE target SET tgl_akhir='$tgl_edit' WHERE id='$id'");
                                        //insert new
                                        $tambahNew = mysqli_query($cnts,"INSERT INTO target VALUES ('','$dept','$jam','$shift','$star_day_star','$end_day_end','$tacktime','$jam_mulai','$jam_akhir','$terima_jam','$date_new_awal','$date_new_akhir')");
                                    }else if(!isset($cek['tgl'])){
                                        //edit
                                        $update = mysqli_query($cnts,"UPDATE target SET tgl_akhir='$tgl_edit' WHERE id='$id'");
                                        // insert new
                                        $tambahNew = mysqli_query($cnts,"INSERT INTO target VALUES ('','$dept','$jam','$shift','$star_day_star','$end_day_end','$tacktime','$jam_mulai','$jam_akhir','$terima_jam','$date_new_awal','$date_new_akhir')");
                                    
                                    if($_POST['dept_d']>0){
                                    }
                                }

                            // }else if(!isset($cek['tgl'])){
                            //     echo "tidak ada";
                            //     if(isset($_POST['dept_d']) ){
                            //         // terima data   
                            //         $dept = $_POST['dept_d'];
                            //         $shift = $_POST['shift_s'];
                            //         $star_day_star = $_POST['star_day_star'];
                            //         $end_day_end = $_POST['end_day_end'];
                            //         $tacktime = $_POST['tacktime'];
                            //         $tgl_edit = $_POST['tgl_edit'];
                            //         $date_new_awal = $_POST['tgl_insert'];
                            //         $date_new_akhir = $_POST['tgl_akhir_insert'];
                                    
                                    
                            //         //loop
                            //         $target = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tgl_akhir from target  order by tgl desc limit 1 "));
                            //         $target1= $target['tgl_akhir'];

                            //         $t_time = mysqli_query ($cnts,"SELECT * FROM `target` `tg` WHERE `tg`.`tgl_akhir`='$target1' AND tg.shift='$shift' and tg.dept=1 ORDER BY `tg`.`jam` ASC");                   
                            //         foreach($t_time AS $data){
                            //             $id = $data['id'];
                            //             $jam = $data['jam'];
                            //             $jam_mulai = $data['jam_mulai'];
                            //             $jam_akhir = $data['jam_akhir'];
                            //             $terima_jam = $_POST[$jam];

                            //             echo 'tes';
    
                            //         //edit
                            //         $update = mysqli_query($cnts,"UPDATE target SET tgl_akhir='$tgl_edit' WHERE id='$id'");
                            //         // insert new
                            //         $tambahNew = mysqli_query($cnts,"INSERT INTO target VALUES ('','$dept','$jam','$shift','$star_day_star','$end_day_end','$tacktime','$jam_mulai','$jam_akhir','$terima_jam','$date_new_awal','$date_new_akhir')");
                                    
                            //         } 
                                    
                            //         if($_POST['dept_d']>0){
                            //         }
                            //     }
                            }
                        }
                        ?>
                    </div> 
                </div>
            </div>
        </div> 
    </div>
</div>
    <!-- end content -->
                    
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

</body>

</html>
