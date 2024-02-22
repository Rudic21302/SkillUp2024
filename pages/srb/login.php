<?php

    include 'config.php';
    session_start();

    if(isset($_POST['submit'])){

        $select = NULL;
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select) > 0){
            $row = mysqli_fetch_assoc($select);
            $_SESSION['user_id'] = $row['id'];
            header("location:home.php");
        }else{
            $message[] = 'pogrešna šifra ili email'; 
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
                <a href="courses-srb.html" class="nav-item nav-link">Kursevi</a>
                <a href="register.php" class="nav-item nav-link nav-item-right">Registracija</a>
                <b><a href="#" class="nav-item nav-link nav-item-right active">Prijava</a></b>
            </div>
        </div>
    </nav>
    <!--NAVBAR-->

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Prijavite se</h3>
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            ?>
                   
            <input type="text" name="email" placeholder="unesite email" class="box" required> 
            <input type="password " name="password" placeholder="unesite šifru" class="box" required> 
            <input type="submit" name="submit" value="Prijavi se" class="btn">
            <p>Nemate nalog?<a href="register.php">Registrujte se!</a></p>
        </form>    


    </div>


<!--Bootstrap JS-->
<script src='../../assets/bootstrap/js/bootstrap.min.js'></script>
</body>
</html>