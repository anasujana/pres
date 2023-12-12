<?php
include './../koneksi/koneksi.php';
$kategori = $_GET['tkategori'];
echo "<option value=''>Pilih jenis_prob :</option>";
$jenis_prob = mysqli_query($cnts,"SELECT * FROM jenis_prob where id_kategori='$kategori'");
                                            
foreach ($jenis_prob AS $data){                                   
   echo "<option value='".$data['id'] . "'>" . $data['nama_prob'] . "</option>"; 
}
?>