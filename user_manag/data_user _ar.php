<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    include './../koneksi/koneksi.php';
?>

<table class="table table-sm text-center monitor table-hover" height="200%" cellspacing="0">
    <thead >
        <tr>
            <th>Npk</th>
            <th>Nama</th>
            <th>Area</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $user_area =  mysqli_query ($cnts,"SELECT ua.id,us.npk,us.nama,ar.area FROM user_area ua 
        LEFT JOIN user us ON ua.id_user= us.npk  
        LEFT JOIN area ar on ua.id_area=ar.id "); 
        foreach($user_area AS $data){
            $id = $data['id'];     
            $npk = $data['npk'];
            $nama = $data['nama'];
            $area= $data['area'];
        ?>  
        <tr>
            <td><?php echo $npk; ?></td>
            <td><?php echo $nama; ?></td>
            <td><?php echo $area; ?></td>
            <td>
                <i data-toggle="modal" data-id_prob='<?php echo $id_prob; ?>' data-target="#edit_prob"
                class='fa fa-edit text-info probprob' aria-hidden='true'></i>&nbsp;
                <a href="history_problem.php?id_prob_hasil=<?= $id_prob ?>"><i class='fa fa-trash text-danger' aria-hidden='true'></i></a>&ensp;
            </td>
        </tr>                                                                                                                                                                             
        <?php  
        }
        ?>                      
    </tbody>
</table> 
</body>
</html>