
	<!-- [ Pre-loader ] start -->
    <?php 
    include './../koneksi/koneksi.php';

    date_default_timezone_set('Asia/Jakarta');


    // $tgl=date('Y-m-d h:i:s');
    // echo $tgl;
   

    $tgl1=date('Y-m-d');
    ?>

    <?php
                $tgl=date('Y-m-d H:i:s'); 
                $chart3 = mysqli_fetch_array(mysqli_query($cnts,"SELECT tacktime FROM target LIMIT 1")); 
                $t_time =$chart3 ['tacktime']*60;
                $achive = mysqli_query($cnts,"SELECT ct FROM efficiency where waktu <= '$tgl' AND ct<=$t_time");
                $total = mysqli_query($cnts,"SELECT ct FROM efficiency where waktu <= '$tgl' ");  
                $achivement = mysqli_num_rows($achive) / mysqli_num_rows($total) * 100; 
                // if($achivementt==0){
                //     $achivement=0;
                // }else{
                //     $achivement = $achivementt;  
                    $achivement = round($achivement,1);
                // }

                $rotationn = $achivement/100*180;
                // if($achivementt==0){
                //     $rotation=0;
                // }else{
                //     $rotation = $rotationn;  
                //     $rotation = round($rotation,1).' %';
                // }
               
    ?>
    <style>
        code { display:inline-block; max-width:400px;  padding:50px 0 0; line-height:1.5; font-family:monospace; color:#ccc }
        .sc-gauge  { width:200px; height:30px; margin:30px auto; }
        .sc-background { position:relative; height:100px; margin-bottom:10px; background-color:#fff; border-radius:150px 150px 0 0; overflow:hidden; text-align:center; }
        .sc-mask { position:absolute; top:20px; right:20px; left:20px; height:80px; background-color:#e31507; border-radius:150px 150px 0 0 }
        .sc-percentage { position:absolute; top:100px; left:-200%; width:400%; height:400%; margin-left:100px; background-color:#4ecf9b; }
        .sc-percentage { transform:rotate(<?php echo $rotation; ?>deg); transform-origin:top center; }
        .sc-min { float:left; }
        .sc-max { float:right; }
        .sc-value { position:absolute; top:30%; left:0; width:100%;  font-size:48px; font-weight:700 }
    </style>
    <div class="sc-gauge">
        <div class="sc-background">
        <div class="sc-percentage"></div>
        <div class="sc-mask"></div>
        <span class="sc-value" style="color:white;"><?php echo $achivement; ?>%</span>
        </div>
        <span class="sc-min">0</span>
        <span class="sc-max">100</span>
    </div>    