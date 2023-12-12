<?php
include('conn/konneksi.php');
require "session.php";
// function generateRandomString($length = 10){
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength= strlen($characters);
//     $randomstring = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomstring = $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomstring;
// }
// require 'vendor/autoload.php';

if(isset($_FILES['upload'])){
    
        $err="";
        $ekstensi= "";
        $succes= "";

        $file_name= $_FILES['upload']['name'];
        $file_data= $_FILES['upload']['tmp_name'];

        if(empty($file_name)){
            echo  $err= "<li>masukan file</li>"; 
        }
        else{
            $ekstensi= pathinfo($file_name)['extension'];
        }

        $ekstensi_allowed= array("xls","xlsx","csv");
        if(!in_array($ekstensi, $ekstensi_allowed)){
            echo $err= "<p class='text-center'>you must upload file xls or xlsx</p>";
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

                $sql1= "insert into plan(tgl,shift,unit,plan_produksi)
                VALUES('$tgl','$shift','$unit','$plan_produksi')";

                mysqli_query($cnts, $sql1);
                $jumlah_data++;
            }
            if($jumlah_data > 0){
                echo $succes= "<p class='text-center'>upload file succes</p>";
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



                    