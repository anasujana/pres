<?php
include './../koneksi/koneksi.php';
$jenis_prob = $_GET['tjenis_prob'];
$kategori = $_GET['tkategori'];
echo "<option value=''>Pilih Sumber Problem :</option>";
$jenis_prob = mysqli_query($cnts,"SELECT * FROM nama_prob where id_jenis_prob='$jenis_prob' and kategori='$kategori'");
                                            
foreach ($jenis_prob AS $data){                                   
   echo "<option value='".$data['id'] . "'>" . $data['problem'] . "</option>"; 
}
?>