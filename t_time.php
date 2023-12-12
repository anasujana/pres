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
                    <h4 class="text-center">LINE #1 : SETTING TACKTIME</h4>
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
                            <div class="form-group col-md-6">
                                <input type="number" step=0.01 name="tacktime" class="form-control" placeholder="TackTime" >
                            </div>
                            <div class="form-group col-xl-6 float-right">
                                <input type="submit" class="btn btn-primary rounded" value="GO">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive ">
                        <form action="" method="POST">
                            <input type="hidden" name="dept_d" class="form-control" 
                                value="<?php if(isset($_GET["dept"])){echo $_GET["dept"]; }; ?>"  readonly>
                            <input type="hidden" name="shift_s" class="form-control"
                                value="<?php if(isset($_GET["shift"])){echo $_GET["shift"]; }; ?>"  readonly>
                            <input type="hidden" name="star_day_sd" class="form-control"
                                value="<?php if(isset($_GET["star_day"])){ echo $_GET["star_day"];};?>"
                                readonly>
                            <input type="hidden" name="end_day_ed" class="form-control"
                                 value="<?php if(isset($_GET["end_day"])){ echo $_GET["end_day"];};?>"
                                readonly>
                            <input type="hidden" name="star_date_star" class="form-control" 
                                value="<?php
                                    if(isset($_GET["star_date"])){
                                    echo $_GET["star_date"];
                                    };
                                ?>" 
                                readonly>
                            <input type="hidden" name="end_date_end" class="form-control" 
                                value="<?php
                                    if(isset($_GET["end_date"])){
                                    echo $_GET["end_date"];
                                    };
                                ?>" 
                            readonly>
                            <input type="hidden" name="tacktime_t" class="form-control" 
                                value="<?php
                                        if(isset($_GET["tacktime"])){
                                        echo $_GET["tacktime"];
                                        };
                                ?>" 
                                readonly>
                            <?php
                                if(isset($_GET['shift'])){
                                    $terima_shift = $_GET['shift'];

                                $tgl = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tgl from target order by tgl desc limit 1 "));   
                                $tgl_akhir= $tgl['tgl'];

                                $tabel = mysqli_query ($cnts,"SELECT * FROM target WHERE tgl='$tgl_akhir' AND shift='$terima_shift' and dept=1 ORDER BY jam ASC");
                                
                                foreach($tabel AS $data){
                                    $jam = $data['jam'];
                                    $jam_start = $data['jam_mulai']; 
                                    $jam_mulai= date("H:i",strtotime ($jam_start)); 
                                    $jam_end = $data['jam_akhir'];
                                    $jam_akhir= date("H:i",strtotime ($jam_end));
                                   ?> 
                            <div class="form-row">
                                <input type="hidden" name="jam" value="<?php echo $jam;?>" class="form-control">                         
                                <div class="form-group col-md-4">
                                    <label for="Nama">jam mulai</label>
                                    <input type="datetime" name="jam_mulai" value="<?php echo $jam_mulai;?>" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputpictagane">jam selesai</label>
                                    <input type="datetime" name="jam_akhir" class="form-control" value="<?php echo $jam_akhir;?>" >
                                </div>  
                                <div class="form-group col-md-4">
                                    <label for="inputpictagane">PLAN</label>
                                    <input type="number" name="<?php echo $jam;?>" class="form-control" value="" >
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
                            // cek ada/tidak nya data
                            if(isset($_POST['dept_d']) ){
                            // terima data   
                            
                            $dept_d = $_POST['dept_d'];
                            $shift_s = $_POST['shift_s'];
                            $star_day_sd = $_POST['star_day_sd'];
                            $end_day_ed = $_POST['end_day_ed'];
                            $star_date_star = $_POST['star_date_star'];
                            $end_date_end = $_POST['end_date_end'];
                            $tacktime_t = $_POST['tacktime_t'];
                            
                            // loop
                            $tgl = mysqli_fetch_array(mysqli_query ($cnts,"SELECT tgl from target order by tgl desc limit 1 "));   
                            $tgl_akhir= $tgl['tgl'];

                            $t_times = mysqli_query ($cnts,"SELECT * FROM target WHERE tgl='$tgl_akhir' AND shift='$shift_s' and dept=1")or die(mysqli_error($cnts));                   
                            
                            while($datas = mysqli_fetch_assoc($t_times)){
                                echo 
                                'tes';
                                $jam = $datas['jam'];
                                echo $jam;
                                $jam_mulai = $datas['jam_mulai'];
                                $jam_akhir = $datas['jam_akhir'];
                                $terima_jam = $_POST[$jam];

                            // tambahkan ke databasea
                            $tambah = mysqli_query($cnts,"INSERT INTO target VALUES ('','$dept_d','$jam','$shift_s','$star_day_sd','$end_day_ed','$tacktime_t','$jam_mulai','$jam_akhir','$terima_jam','$star_date_star','$end_date_end')");
                            } 
                            
                            if($_POST['dept_d']>0){

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
