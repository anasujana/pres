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


    <!-- <link href="assets/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="assets/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/js/dataTables.bootstrap4.min.js"></script> -->

    <!-- <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"/>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <style>
        .files input {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 40px 0px 50px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }
        .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
        }
        .files{ position:relative}
        .files:after {  pointer-events: none;
            position: absolute;
            top: 20px;
            left: 0;
            width: 50px;
            right: 0;
            height: 40px;
            content: "";
            background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
            display: block;
            margin: 0 auto;
            background-size: 15%;
            background-repeat: no-repeat;
        }
        .color input{ background-color:#f1f1f1;}
        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0;  pointer-events: none;
            width: 10%;
            right: 0;
            height: 10px;
            content: " ";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
</style>
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
    
    <!-- content -->
    
    <div class="row">
	  <div class="col-md-12">
	      <form method="post" action="target_monthly.php" id="#" enctype="multipart/form-data">
              <div class="form-group files">
                <label>Upload Your File </label>
                <input type="file" class="form-control" id="upload" name="file">
                    <div class="col-xl-12 text-center m-t-20">
                    <button type="submit" class="btn btn-primary float-center" name="submit">Upload</button>
                    </div>
               </div>  
          </form>
	  </div>
	</div>  

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

   <div class="card">
        <!-- digitalization board -->
        <div class="card-body">
            <div class="">
                <?php
                date_default_timezone_set('Asia/Jakarta');

                $tgl=date('Y-m-d');
                $time=date('22:00');
                $day = date('l', strtotime($tgl));

                if($time>='07:15' and $time<='20:29'){
                    $sif = 'pagi';
                }else{
                    $sif = 'malam';
                }

                $tabel = mysqli_query ($cnts,"SELECT * FROM `plan` ORDER BY `plan`.`tgl`,`plan`.`shift` DESC");

                ?>

            <table class="table table-sm text-center" id="plan" height="200%" cellspacing="0">
            <thead >
                <tr>
                    <th>TANGGAL</th>
                    <th>SHIFT</th>
                    <th>TYPE UNIT</th>
                    <th>PLANIING PRODUKSI</th>
                </tr>
            </thead>
            <tbody>
            <?php

            foreach($tabel AS $data){
            $tgl = $data['tgl'];
            $shift = $data['shift'];
            $unit = $data['unit'];
            $plan = $data['plan_produksi']; 
            ?>  
                <tr>
                    <td><?php echo $tgl;?></td>
                    <td><?php echo $shift; ?></td>
                    <td><?php echo $unit; ?></td>
                    <td><?php echo $plan; ?></td>
                </tr>                                                                                                                                                                             
                <?php  
                }
                ?>                      
            </tbody>
            </table>
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
<script type="text/javascript">
$(document).ready( function () {
    $('#plan').DataTable();
} );
</script>


</html>
