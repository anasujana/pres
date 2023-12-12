<!DOCTYPE html>
<html lang="en">
<?php
    session_start(); 
?>
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
	
	


</head>
<?php
require './koneksi/koneksi.php';
?>
<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="" alt="" class="img-fluid mb-4">
		<div class="card borderless">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
					<form action="index.php" method="post" class="user">
						<h4 class="f-w-400">Login To PReS</h4>
						<hr>
						<div class="form-group mb-3">
							<input type="number" class="form-control" name="npk" id="Username" placeholder="Username">
						</div>
						<div class="form-group mb-4">
							<input type="password" class="form-control" name="password" id="Password" placeholder="Password">
						</div>
						<button class="btn btn-primary btn-block mb-4" type="submit" name="submit">LOGIN</button>
						<hr>
					</form>
					<br>
					<?php
						if(isset($_POST['submit'])){
							$npk = $_POST['npk'];
							$password =$_POST['password'];
							
							$query= mysqli_query($cnts,"SELECT ua.id_area,us.password,us.nama,us.npk, ru.role_user
							FROM user us LEFT JOIN role_user ru ON us.npk=ru.npk 
							LEFT JOIN user_area ua ON us.npk=ua.id_user
							WHERE us.npk='$npk'");
							$count= mysqli_num_rows($query);
							
							if($count > 0){
							
							$as=mysqli_fetch_array($query);

							if($password==$as['password']){
							// if(password_verify($pass, $as['password'])){

							$_SESSION["npk"]=$npk;
							$_SESSION["nama"]=$as["nama"];
							$_SESSION["id_area"]=$as["id_area"];
							$_SESSION["role_user"]=$as["role_user"];
							
							if($as['role_user']=="management"){                                                                                  
								$_SESSION['logged_in']=true;
								header("location:dc_management.php");

								}else if($as['role_user']=="admin"){                                           
								$_SESSION['logged_in']=true;
								header("location:db_body1.php");

							}else{                                           
								$_SESSION['logged_in']=true;
								header("location:db_body1.php");                                                                        
							}
						
						}else{
							echo ".'<p class='text-danger'><strong>YOUR PASSWORD IS INCORECT</strong></p'";
						}                                 
						}else{
							echo ".'<p class='text-danger'><strong>YOUR ACCOUT NOT EXIXT</strong></p'";
						}
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>

<script src="assets/js/pcoded.min.js"></script>

</body>

</html>
