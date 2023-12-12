<?php
include './../koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

// $chart = mysqli_query($cnts, "SELECT concat('ke-', unit) as x, ct as y FROM efficiency");

// $emparray = array();
// while($row =mysqli_fetch_assoc($chart))
// {
//     $emparray[] = $row;
// }
// echo json_encode($emparray);

echo '[{"x":"1","y":"60"},{"x":"2","y":"50"},{"x":"3","y":"60"},{"x":"4","y":"60"}]';
?>