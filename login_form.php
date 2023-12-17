<?php

@include 'configDatabase.php';

session_start();

if(isset($_POST['submit'])){
    
   $email = mysqli_real_escape_string($conn, $_POST['usermail']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM login_user WHERE email = '$email' && password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $_SESSION['usermail'] = $email;
      header('location:index.php');
   }else{
      $error[] = 'incorrect password or email.';
   }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">

    <style>
    body {
        background-image: url('picture/town_of_atoo_by_neytirix_dfuudzm.jpg');
        /* Gantilah path/to/your/image.jpg dengan path gambar Anda */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        height: 100vh;
    }

    .form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        width: 300px;
    }

    .title {
        text-align: center;
        color: #333;
    }

    .box {
        width: 100%;
        padding: 8px;
        margin: 8px 0;
    }

    .form-btn {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        background: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-btn:hover {
        background: #0056b3;
    }

    .error-msg {
        color: #ff0000;
    }
    </style>
</head>

<body>

    <div class="form-container">

        <form action="" method="post">
            <h3 class="title">login now</h3>
            <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
            <input type="email" name="usermail" placeholder="enter your email" class="box" required>
            <input type="password" name="password" placeholder="enter your password" class="box" required>
            <input type="submit" value="login now" class="form-btn" name="submit">
            <p>don't have an account? <a href="register_form.php">register now!</a></p>
        </form>

    </div>

</body>

</html>