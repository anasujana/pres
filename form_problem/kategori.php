<?php
include './../koneksi/koneksi.php';
echo "<option value=''>Pilih Category :</option>";
$kategori = mysqli_query($cnts,"SELECT * FROM kategori_prob");                                     
foreach ($kategori AS $data){                                   
   echo "<option value='".$data['id']."'>".$data['jenis']."</option>"; 
}
?>