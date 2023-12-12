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

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        code { display:inline-block; max-width:400px;  padding:50px 0 0; line-height:1.5; font-family:monospace; color:#ccc }
        .sc-gauge  { width:200px; height:30px; margin:30px auto; }
        .sc-background { position:relative; height:100px; margin-bottom:10px; background-color:#fff; border-radius:150px 150px 0 0; overflow:hidden; text-align:center; }
        .sc-mask { position:absolute; top:20px; right:20px; left:20px; height:80px; background-color:#e31507; border-radius:150px 150px 0 0 }
        .sc-percentage { position:absolute; top:100px; left:-200%; width:400%; height:400%; margin-left:100px; background-color:#4ecf9b; }
        .sc-percentage { transform:rotate(158deg); transform-origin:top center; }
        .sc-min { float:left; }
        .sc-max { float:right; }
        .sc-value { position:absolute; top:30%; left:0; width:100%;  font-size:48px; font-weight:700 }
    </style>

    <script type="text/javascript" src="assets\js\pages\apexcharts.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.0/apexcharts.min.js" integrity="sha512-RLWwcf0Pb2NghIfkaQms354xRV36EYjXLWKSN8QHiHqNq3KGj0DjMc9D1zzO7UsREkGU/xCLAJi/hVcKSuZ5Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.0/apexcharts.min.css" integrity="sha512-tJYqW5NWrT0JEkWYxrI4IK2jvT7PAiOwElIGTjALSyr8ZrilUQf+gjw2z6woWGSZqeXASyBXUr+WbtqiQgxUYg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

</head>
<body class="">
	<!-- [ Pre-loader ] start -->
    <?php 
    include './element/header_nav.php';
    ?>

<script>
    // $(00'#chart_eff').load('json_chart/json_chart.php').fadeIn("fast");//1x
    setInterval (function(){
        $('#chart_eff').load('json_chart/json_chart.php').fadeIn("fast");
        $('.card-passrate').load('json_chart/pie_passrate.php').fadeIn("fast");
    },2000
    )
    ;

    setInterval (function(){
        $('#chart_total').load('chart_total.php').fadeIn("fast");
    },500
    )
    ;

</script>

    <?php
    include './koneksi/koneksi.php';
    $test = mysqli_query($cnts,"SELECT * FROM mitsu");
    foreach($test AS $data){
        $id = $data['id']; 
        $value = $data['value'];
        $jam = $data['jam']; 
    ?>  
    <tr>
        <!-- <td><?php echo $value; ?></td> -->
    </tr>                                                                                                                                                                            
    <?php  
    }
    ?> 
    
	<!-- [ Pre-loader ] End -->
	
<!-- [ Main Content ] start -->
<div class="pcoded-container">
    <div class="pcoded-content">
        <h5 class="m-b-10">Efficiency Proses At Main Body</h5>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ variant-chart ] start -->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>C/T Unit</h5>
                    </div>
                    <div id="chart_eff">
                        <!-- <div id="chart" style="height: 380px"></div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Passrate</h5>
                    </div>
                    
                        <div class="card-passrate">
                            <div class="sc-gauge">
                                <div class="sc-background">
                                <div class="sc-percentage"></div>
                                <div class="sc-mask"></div>
                                <span class="sc-value"></span>
                                </div>
                                <span class="sc-min"></span>
                                <span class="sc-max"></span>
                            </div>
                        </div>
                    
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Total Unit</h5>
                    </div>
                   
                        <div class="card-body text-center" >
                            <br>
                           <h1 id="chart_total"></h1>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Menit Problem</h5>
                    </div>
                    <div class="card-body">
                        <div id="bar-chart-2"></div>
                    </div>
                </div>
            </div> -->
            <!-- [ variant-chart ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<script>

var options = {
    series: [
          {
            name: "t/time",
            data: [60, 60, 60, 60, 60, 60, 60, 60, 60]
          },
          {
            name: "ACT C/T PROSES",
            data: [60, 60, 60, 60, 70, 60, 60, 60, 60]
          }
        ],
        chart: {
        height: 350,
        type: 'line',
        zoom: {
        enabled: false
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
        categories: ['1', '2', '3', '4', '5', '6', '7', '8', '8'],
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // var options = {
    //       series: [
    //       {
    //         name: "TARGET C/T PROSES",
    //         data: [60, 60, 60, 60, 60, 60, 60, 60, 60]
    //       },
    //       {
    //         name: "ACT C/T PROSES",
    //         data: [60, 60, 60, 60, 70, 60, 60, 60, 60]
    //       }
    //     ],
    //       chart: {
    //       height: 350,
    //       type: 'line',
    //       dropShadow: {
    //         enabled: true,
    //         color: '#000',
    //         top: 18,
    //         left: 7,
    //         blur: 10,
    //         opacity: 0.2
    //       },
    //       toolbar: {
    //         show: false
    //       }
    //     },
    //     colors: ['#77B6EA', '#545454'],
    //     dataLabels: {
    //       enabled: true,
    //     },
    //     stroke: {
    //       curve: 'smooth'
    //     },
    //     title: {
    //       text: '',
    //       align: 'left'
    //     },
    //     grid: {
    //       borderColor: '#e7e7e7',
    //       row: {
    //         colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
    //         opacity: 0.5
    //       },
    //     },
    //     markers: {
    //       size: 1
    //     },
    //     xaxis: {
    //       categories: ['1', '2', '3', '4', '5', '6', '7', '8', '8'],
    //       title: {
    //         text: 'UNIT'
    //       }
    //     },
    //     yaxis: {
    //       title: {
    //         text: 'C/T'
    //       },
    //       min: 5,
    //       max: 100
    //     },
    //     legend: {
    //       position: 'top',
    //       horizontalAlign: 'right',
    //       floating: true,
    //       offsetY: -25,
    //       offsetX: -5
    //     }
    //     };

    //     var chart = new ApexCharts(document.querySelector("#chart"), options);
    //     chart.render();

        
//     var options = {
//   chart: {
//       height: 350,
//       type: 'bar',
//   },
//   dataLabels: {
//       enabled: false
//   },
//   series: [],
//   title: {
//       text: 'Ajax Example',
//   },
//   noData: {
//     text: 'Loading...'
//   }
// }

// var chart = new ApexCharts(
//   document.querySelector("#chart"),
//   options
// );

// chart.render();

      
//         var url = 'http://localhost/pres/json_chart/data_chart.php';

//         $.getJSON(url, function(response) {
//         chart.updateSeries([{
//             name: 'Sales',
//             data: response
//         }])
//         });
      
</script>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="assets/js/pages/chart-apex.js"></script>


</body>
</html>

 

