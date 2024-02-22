<?php

    include 'config.php';
    if(isset($_POST['submit'])){

        $select = NULL;
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;
        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select) > 0){
            $message[] = 'korisnik već postoji'; 
        }else{
            if($pass != $cpass){
                $message[] = 'šifre se ne slažu!';
            }elseif($image_size > 2000000){
                $message[] = 'Slika prevelika!';
            }else{
                $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');
            }if($insert){
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Registracija uspešna!';
                header("location: login.php");
            }else{
                $message[] = 'Registracija neuspešna!';
            }

        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fitness CourseShare</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="../../assets/css/main-styles.css">
    <!--REGISTER CSS-->
    <link rel="stylesheet" href="register-styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Micro+5&family=Oswald:wght@200..700&family=Quicksand:wght@300..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    
</head>
<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><b>Fitness CourseShare</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a href="../../index.php" class="nav-item nav-link">Naslovna</a>
                <a href="about-us-srb.html" class="nav-item nav-link">O nama</a>
                <a href="blog-forum-srb.html" class="nav-item nav-link">Blog</a>
                <a href="info-srb.html" class="nav-item nav-link">Informacije</a>
                <a href="courses-srb.html" class="nav-item nav-link">Kursevi</a>
                <a href="#" class="nav-item nav-link active">Registracija</a>
                <b><a href="login.php" class="nav-item nav-link">Prijava</a></b>
            </div>
        </div>
    </nav>
    <!--NAVBAR-->

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Registracija</h3>
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            ?>
            <input type="text" name="name" placeholder="unesite korisničko ime" class="box" required>        
            <input type="text" name="email" placeholder="unesite email" class="box" required> 
            <input type="password " name="password" placeholder="unesite šifru" class="box" required> 
            <input type="password" name="cpassword" placeholder="potvrdite šifru" class="box" required>
            <input type="file" name="image" class="box" accept="image/jpg, image/png, image/jpeg">
            <input type="submit" name="submit" value="Registracija" class="btn">
            <p>Već imate nalog?<a href="login.php">Prijavite se!</a></p>
        </form>    


    </div>


<!--Bootstrap JS-->
<script src='../../assets/bootstrap/js/bootstrap.min.js'></script>
</body>
</html>