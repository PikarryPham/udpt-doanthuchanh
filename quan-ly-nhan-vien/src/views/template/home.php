<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./asset/img/icon/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/2937f4af7e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= $host_name ?>/public/css/loginThao.css">
    <link rel="stylesheet" href="<?= $host_name ?>/public/css/navbar.css">
    <title>Authorization</title>
</head>
<body>
<nav>
    <div class="logo">
        <img src="<?= $host_name ?>/public/img/icon/logo.png" width="29px" height="25px" alt="">
        <img src="<?= $host_name ?>/public/img/icon/heading_logo.png" height="25px" alt="">
    </div>
    <div class="user">
        <img src="<?= $host_name ?>/public/img/image/avatar-fb.png" width="120px" height="120px" alt="">
        <p class="user-title">job title</p>
        <p class="user-id">employee ID</p>
    </div>
    <div class="main-func">
        <a href="index.html"><i class="fa-solid fa-house"></i>dash board</a>
        <a href="#"><i class="fa-solid fa-circle-info"></i>information</a>
        <a href="#"><i class="fa-solid fa-arrow-right-arrow-left"></i>transfer</a>
        <a href="#"><i class="fa-solid fa-code-merge"></i>org, chart</a>
        <a href="#"><i class="fa-solid fa-circle-user"></i>account settings</a>
    </div>
    <div class="login">
        <a href="<?= $host_name ?>"><i class="fa-solid fa-right-to-bracket"></i><span>login</span></a>
    </div>
</nav>

<?php 
    require_once "./src/views/content/" . $view . ".php"
?>

</body>