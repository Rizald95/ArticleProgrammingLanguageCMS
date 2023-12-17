<?php
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($user->loggedIn()) {
	header("location: dashboard.php");
}

$loginMessage = '';
if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];
	if($user->login()) {
		header("location: dashboard.php");
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}
}

include('inc/header.php');
?>
<title> User Management System with PHP & MySQL</title>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System with PHP & MySQL</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
    body {

        /* Warna latar belakang */
        background-image: url('../picture/another_delivery_by_neytirix_dgi70ol.jpg');
        /* Ganti 'path/to/your/background-image.jpg' dengan path menuju gambar background Anda */
        background-size: cover;
        /* Pastikan gambar background menutupi seluruh latar belakang */
        background-position: center;
        /* Pusatkan gambar background secara horizontal dan vertikal */
        color: white;
        /* Warna teks */
        position: relative;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
        /* Efek shadow dengan warna gelap transparan */
    }

    .container.contact {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: 100vh;
    }

    .panel-info {
        width: 100%;
        max-width: 400px;
        /* Atur lebar maksimum sesuai kebutuhan */
        margin: 10px auto;
        /* Tengahkan panel di dalam container dan berikan sedikit ruang di atasnya */
        background-color: rgba(0, 0, 0, 0.7);
        /* Warna latar belakang panel dengan sedikit transparansi */
        border: 1px solid #00796B;
        /* Warna border */
        border-radius: 10px;
        /* Bentuk sudut panel */
    }

    .logo {
        margin-bottom: 10px;
        /* Tambahkan margin agar ada ruang di bawah logo */
        text-align: center;
        position: relative;
    }

    .logo img {
        max-width: 40%;
        /* Atur lebar maksimum logo */
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.8);
        /* Efek shadow dengan warna putih */
        border-radius: 50%;
        /* Bentuk sudut logo menjadi lingkaran */
        transition: transform 0.3s ease-in-out;
        /* Efek transisi saat hover */
    }

    .logo img:hover {
        transform: scale(1.1);
        /* Perbesar logo saat hover */
    }

    .panel-heading {
        background: #00796B;
        /* Warna latar belakang judul panel */
        color: white;
        /* Warna teks judul panel */
        border-radius: 10px 10px 0 0;
        /* Bentuk sudut judul panel */
    }

    .panel-title {
        font-size: 24px;
        /* Ukuran teks judul panel */
        font-weight: bold;
        /* Teks judul panel tebal (bold) */
    }

    .panel-body {
        padding: 30px;
        /* Ruang dalam panel */
    }

    .form-control {
        background: rgba(255, 255, 255, 0.2);
        /* Warna latar belakang field input dengan sedikit transparansi */
        color: white;
        /* Warna teks field input */
        border: 1px solid #00796B;
        /* Warna border field input */
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.3);
        /* Warna latar belakang field input ketika fokus */
        color: white;
        /* Warna teks field input ketika fokus */
    }

    .btn-info {
        background: #00796B;
        /* Warna latar belakang tombol */
        color: white;
        /* Warna teks tombol */
        border: 1px solid #00796B;
        /* Warna border tombol */
    }

    .btn-info:hover {
        background: #005147;
        /* Warna latar belakang tombol ketika hover */
        color: white;
        /* Warna teks tombol ketika hover */
        border: 1px solid #005147;
        /* Warna border tombol ketika hover */
    }

    #login-alert {
        margin-top: 20px;
        /* Atur jarak antara pesan alert dengan form */
    }
    </style>
</head>
<div class="container contact">
    <div class="logo">
        <img src="../picture/portal_logo_3d_by_fashfish9_d7ygiub-removebg-preview.png" alt="Logo"
            style="max-width:40%;">
    </div>
    <h2 style="margin-bottom: 20px; color: white; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        Portal Content User Management System</h2>

    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading" style="background:#00796B;color:white;">
                <div class="panel-title">Admin and Author</div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <?php if ($loginMessage != '') { ?>
                <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>
                <?php } ?>
                <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                style="background:white;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" value="Login" class="btn btn-info">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 controls">
                            User: admin@phpzag.com<br>
                            password:123
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php include('inc/footer.php');?>