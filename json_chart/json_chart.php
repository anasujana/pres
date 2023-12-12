
	<!-- [ Pre-loader ] start -->
    <?php 
    include './../koneksi/koneksi.php';

    date_default_timezone_set('Asia/Jakarta');

    $tgl1=date('Y-m-d');
    ?>

    
     <div id="chart" style="height: 380px"></div>


<script>

var options = {
    series: [
          {
            name: "T/TIME",
            data: [
                
            <?php
                $tgl=date('Y-m-d H:i:s');
                $chart = mysqli_query($cnts,"SELECT ct FROM efficiency where waktu <= '$tgl' ");  
                $chart3 = mysqli_fetch_array(mysqli_query($cnts,"SELECT tacktime FROM target LIMIT 1"));                                     
                foreach($chart AS $data){
                    $t_time =$chart3 ['tacktime']*60;
                    echo $t_time.",";                                  
                }   
                ?>                                 
            ]
          },
          {
            name: "ACT C/T PROSES",
            data: [
                <?php                                    
                foreach($chart AS $data){
                    $ct =$data ['ct'];                                                                                                                                                
                    echo $ct.",";                                  
                }
                ?>  
            ]
          }
        ],
        colors: ["#FF1654", "#247BA0"],
        chart: {
        height: 350,
        type: 'line',
        zoom: {
        enabled: false
        },
        animations:{
        enabled : false 
    }
        },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    title: {
        text: '',
        align: 'left'
    },
    grid: {
        row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
        },
    },
    xaxis: {
        categories: [
            <?php
                $chart = mysqli_query($cnts,"SELECT unit FROM efficiency");                                      
                foreach($chart AS $data){
                $unit =$data ['unit'];                                                                                                                                                
                echo "'".$unit."'".",";                                  
                }
            ?>
        ],
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

</script>





 

