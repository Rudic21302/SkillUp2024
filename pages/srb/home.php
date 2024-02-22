<?php

    include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
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
                <a href="about-us-srb.html" class="nav-item nav-link ">O nama</a>
                <a href="blog-forum-srb.html" class="nav-item nav-link">Blog</a>>
                <a href="courses-srb.html" class="nav-item nav-link">Kursevi</a>
                <a href="register.php" class="nav-item nav-link nav-item-right">Registracija</a>
                <b><a href="login.php" class="nav-item nav-link nav-item-right">Prijava</a></b>
            </div>
        </div>
    </nav>
    <!--NAVBAR-->

    <div class="container">

<div class="profile">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
      if($fetch['image'] == ''){
         echo '<img src="images/default-avatar.png">';
      }else{
         echo '<img src="uploaded_img/'.$fetch['image'].'">';
      }
   ?>
   <h3><?php echo $fetch['name']; ?></h3>
   <a href="../../index.html" class="btn">Naslovna</a>
   <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">odjavite se</a>
   <p><a href="login.php">prijava</a> ili <a href="register.php">registracija</a></p>
</div>

</div>
        </div>

<!--Bootstrap JS-->
<script src='../../assets/bootstrap/js/bootstrap.min.js'></script>
</body>
</html>