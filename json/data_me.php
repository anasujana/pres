<?php
include('../conn/konneksi.php');
session_start();
$a = array();
$row = 0;

    $id_area = $_SESSION["id_area"];
    $role = $_SESSION["role_user"];

    $tanggal = mysqli_query($cnts,"SELECT Date as tgls FROM matrix_eye ORDER BY Date DESC ");
    $tgl=mysqli_fetch_array($tanggal);
    $tgl = $tgl['tgls'];

    $_SESSION["tgl_awal"] =  $tgl;

    if(isset($_GET['tanggal_mulai']) and isset($_GET['tanggal_akhir'])){
        $tanggal_mulai = $_GET['tanggal_mulai'];
        $tanggal_akhir = $_GET['tanggal_akhir'];
        $tabel = mysqli_query ($cnts,"SELECT * from matrix_eye where Date>=' $tanggal_mulai' and Date<='$tanggal_akhir' ORDER BY Date ASC");

        $_SESSION["star_date"] = $tanggal_mulai;
        $_SESSION["end_date"] = $tanggal_akhir;
    }
    
    
    if($_SESSION["id_area"]==1){
        if(isset($_GET ['Result'])){ 
            $result = $_GET ['Result'];
            if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                if($result=='OK'){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                            where (me.Result='$result' or me.tagane='OK') and me.Date='$tgl'");
                }else if($result=='NG'){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                            left join tagane_check tc on me.No_urut=tc.no_urut 
                                                                            where (Result='$result' AND (tagane!='OK' AND tc.status_after IS NULL))
                                                                               ");
                }else if($result=='N.A.'){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name
                                                                            left join tagane_check tc on me.No_urut=tc.no_urut  
                                                                            where (Result='$result' AND tagane!='OK' AND tc.status_after IS NULL)");
                }
            }else if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                if($result=='OK'){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name left join tagane_check tc on me.No_urut=tc.no_urut 
                                                                            where (Result='$result' or tagane='OK')
                                                                            and Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]' ORDER BY Date ASC
                                                                            ");
                }else if($result=='NG'){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                            left join tagane_check tc on me.No_urut=tc.no_urut
                                                                            where (Result='$result' AND tagane!='OK' AND tc.status_after IS NULL)
                                                                            and Date>='$_SESSION[star_date]' and Date<='$_SESSION[end_date]' ORDER BY Date ASC
                                                                            ");

                }else if($result=='N.A.'){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                            left join tagane_check tc on me.No_urut=tc.no_urut
                                                                            where (Result='$result' AND tagane!='OK' AND tc.status_after IS NULL)
                                                                            and Date>='$_SESSION[star_date]' and Date<='$_SESSION[end_date]' ORDER BY Date ASC
                                                                            ");
                }
            }
        }else if (!isset($_GET ['Result'])){
            if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                where me.Date='$tgl'");
            }else if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                where (Date>='$_SESSION[star_date]' and Date<='$_SESSION[end_date]') ORDER BY Date ASC");
            }
        }
    }else{
        if(isset($_GET ['Result'])){ 
                $result = $_GET ['Result'];
                if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                    if($result=='OK'){
                    $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                where rp.id_area=$id_area and (me.Result='$result' or
                                                                                me.tagane='OK') and me.Date='$tgl'");
                    }else if($result=='NG'){
                    $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                left join tagane_check tc on me.No_urut=tc.no_urut
                                                                                where rp.id_area=$id_area and (me.Result='$result' AND me.tagane!='OK'
                                                                                and tc.status_after IS NULL)");
                    }else if($result=='N.A.'){
                    $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                left join tagane_check tc on me.No_urut=tc.no_urut
                                                                                where rp.id_area=$id_area and
                                                                                (me.Result='$result' AND me.tagane!='OK' and tc.status_after IS NULL)");
                    }
                }else if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                    if($result=='OK'){
                    $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                where rp.id_area=$id_area and (Result='$result' or
                                                                                tagane='OK')
                                                                                and Date>='$_SESSION[star_date]' and Date<= '$_SESSION[end_date]' ORDER BY Date ASC
                                                                                ");
                    }else if($result=='NG'){
                    $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                left join tagane_check tc on me.No_urut=tc.no_urut
                                                                                where rp.id_area=$id_area and
                                                                                (Result='$result' AND tagane!='OK' AND tc.status_after IS NULL)
                                                                                and Date>='$_SESSION[star_date]' and Date<='$_SESSION[end_date]' ORDER BY Date ASC
                                                                                ");

                    }else if($result=='N.A.'){
                    $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                                                                                left join tagane_check tc on me.No_urut=tc.no_urut
                                                                                where rp.id_area=$id_area and
                                                                                (Result='$result' AND tagane!='OK' AND tc.status_after IS NULL)
                                                                                and Date>='$_SESSION[star_date]' and Date<='$_SESSION[end_date]' ORDER BY Date ASC
                                                                                ");
                    }
                }
        }else if (!isset($_GET ['Result'])){
            if(!isset($_SESSION["star_date"]) and !isset ($_SESSION["end_date"])){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                where  rp.id_area=$id_area and me.Date='$tgl'");
            }else if(isset ($_SESSION["star_date"]) and isset ($_SESSION["end_date"])){
                $tabel =  mysqli_query ($cnts,"SELECT * from matrix_eye me left join register_part rp on me.Part_No=rp.part_name 
                where rp.id_area=$id_area and (Date>='$_SESSION[star_date]' and Date<='$_SESSION[end_date]') ORDER BY Date ASC");
            }
        }
    }

    foreach($tabel AS $data){
    $No = $data['No_urut'];
    $jam = $data['jam'];
    $Part_No = $data['Part_No'];
    $Date = $data['Date'];
    $Point_No = $data['Point_No'];  
    $TH = $data['TH'];
    $Dia = $data['Dia'];
    $Weld_T = $data['Weld_T'];
    $Depth = $data['Depth'];
    $Weld_type = $data['Weld_type'];
    $tagane = $data['tagane'];
        if($data['tagane']=="OK"){
            $Result="OK";
        }else{
            $Result = $data['Result'];
        }
        
        $a[$row][0]=$No;
        $a[$row][1]=$Part_No;
        $a[$row][2]=$Date.' '. $jam;
        $a[$row][3]= $Point_No;
        $a[$row][4]=$TH;
        $a[$row][5]=$Dia;
        $a[$row][6]= $Weld_T;
        $a[$row][7]= $Depth;
        $a[$row][8]= $Weld_type;
        $a[$row][9]= '<b class="result" data-toggle="modal" data-no='.$No.' data-status='.$Result.' 
                     data-point="'.$Point_No.'" data-target="#exampleModal">'.$Result.'</b>';  
        // $a[$row][10]= "<img src='img/img_me/$No.jpg' alt='' class='data' width=30px data-toggle='modal' data-img='$No' data-target='#modal'>";     
        if(isset($_GET ['Result'])){
            if($_GET ['Result']=="NG" or $_GET ['Result']=="N.A."){
                $a[$row][10]="<input type='checkbox' name='data_ng[]' id='checkbox' value='$No'>";  
            }
        }
    $row++;
    } 

    $data = array(
                    'data' => $a
    );
    echo json_encode($data);
?> 
                    