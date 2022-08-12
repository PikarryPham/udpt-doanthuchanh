<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $host_name ?>/public/img/icon/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= $host_name ?>/public/css/navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Đồ án</title>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="<?= $host_name ?>/public/img/icon/logo.png" width="29px" height="25px" alt="">
            <img src="<?= $host_name ?>/public/img/icon/heading_logo.png" height="25px" alt="">
        </div>  
        <div class="user">
            <!-- <img src="<?= $host_name ?>/public/img/image/user.png" width="120px" height="120px" alt=""> -->
            <img style="object-fit: cover; aline-item: center" src="<?= $_SESSION['avatar'] ?>" width="120px" height="120px" alt="">
            <p class="user-title">
                <?= $_SESSION['name'] ?>
            </p>
            <p class="user-id">
                <?= $_SESSION['id'] ?>
            </p>
        </div>
        <div class="main-func">
            <a href="<?= $host_name ?>/home/main_uc"><i class="fa-solid fa-house"></i>dash board</a>
            <a href="#"><i class="fa-solid fa-circle-info"></i>information</a>
            <a href="#"><i class="fa-solid fa-arrow-right-arrow-left"></i>transfer</a>
            <a href="#"><i class="fa-solid fa-code-merge"></i>org, chart</a>
            <a href="#"><i class="fa-solid fa-circle-user"></i>account settings</a>
        </div>
        <div class="login">
            <a href="<?= $host_name ?>/home/sign_out"><i class="fa-solid fa-right-to-bracket"></i><span>log out</span></a>
        </div>
    </nav>

    <script>
        const id_user       = <?= $_SESSION["id"] ?>;
        const api_uc002     = "<?= $api_uc002 ?>";
        const uc0131_132    = "<?= $uc0131_132 ?>";
        const host_name     = "<?= $host_name ?>";
        const name_employee = "<?= $_SESSION['name'] ?>";
    </script>

    <?php 
        require_once "./src/views/content/" . $view . ".php"
    ?>

</body>
</html>