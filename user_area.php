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

    <script>
    setInterval (function(){
        $('#display_user_ar').load('user_manag/data_user_ar.php').fadeIn("fast");
    },500
    )
    ;
    </script>

   <div class="card">
        <div class="card-header">
        <div class="row">
                <div class="col">
                    <h3>User Area</h3>
                </div>
                <div class="col">
                    <div class="button-group mb-3 text-right" data-toggle="modal" data-target="#exampleModal">
                        <button type="button" class="btn btn-outline-primary">Tambah Data</button>   
                    </div>
                </div>
            </div>  
        </div>
        <div class="card-body" >
            <div class="table-responsive monmon">
                </div>
                <table id="display_user_ar" class="table table-sm text-center table-hover" height="200%" cellspacing="0">
                    
                </table> 
                </div>
            </div>

           <!-- Modal -->
           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="user_area.php" method="POST">   
                                <div class="form-row">
            
                                    <div class="col-md-12 mb-3">
                                    <label for="exampleFormControlSelect1">Nama</label>
                                    <select name="nama" id="nama" class="form-control" id="exampleFormControlSelect1">
                                    <?php
                                        include('conn/konneksi.php');
                                        $datauser = mysqli_query($cnts,"SELECT * FROM user");
                                        
                                        foreach ($datauser AS $user){
                                        $id = $user['nama'];
                                        $id_user = $user['npk']
                                        ?>                                         
                                            <option value="<?php echo $id_user; ?>"><?php echo $id; ?></option> 
                                        <?php
                                        }
                                        ?> 
                                    </select> 
                                    
                                    </div>
                                </div> 
                                
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                    <label for="exampleFormControlSelect1">Area</label>
                                    <select name="area" id="area" class="form-control" id="exampleFormControlSelect1">
                                    <?php
                                        include('conn/konneksi.php');
                                        $datauser = mysqli_query($cnts,"SELECT * FROM area");
                                        foreach ($datauser AS $user){
                                        $id = $user['area'];
                                        $id_area= $user['id']
                                        ?>   
                                        <option  value="<?php echo $id_area; ?>" ><?php echo $id; ?></option>    
                                        <?php
                                        }
                                    ?> 
                                    </select> 
                                                
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="reset" class="btn btn-secondary" value="reset">
                                    <input type="submit" class="btn btn-primary" value="save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>                    
            <!-- modal -->

                <!-- delete -->
                <?php 
                if(isset($_GET ['id'])){
                    $id  = $_GET ['id'];
                    $delete =  mysqli_query ($cnts,"DELETE FROM user_area where id='$id'");  
                }
                ?>
                <!-- delete -->

                <?php
                if(isset($_POST['nama']) and isset($_POST['area'])){
                $terimanpk        = $_POST['nama'];                          
                $terimaarea      = $_POST['area'];
                                    
                // tambahkan ke database    
                $add = mysqli_query($cnts,"INSERT INTO user_area (id_user, id_area) VALUES (' $terimanpk ','$terimaarea')"); 
                }
                ?>               

                <!-- Modal edit problem-->
                <div class="add_npk modal fade" id="edit_prob" tabindex="5" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<script>

</script>
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
