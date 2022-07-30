<link rel="stylesheet" href="<?= $host_name ?>/public/css/sel_as_n_goal.css">
<link rel="stylesheet" href="<?= $host_name ?>/public/css/OT_request.css">
<link rel="stylesheet" href="<?= $host_name ?>/public/css/myLeave.css" />
<div class="content">
    <div class="content__heading">
        <h1>OT request</h1>
        <button id="btn-model" class="new-rq btn">new request OT</button>
    </div>
    <div class="content__body" id="root">
        <img src="<?= $host_name ?>/public/img/image/oh crap.png" width="420" height="300" alt="">
        <p>you don't have any OT request. you can create a new one!</p>
    </div>
</div>

<?php
require_once "./src/views/content/UC002/modal.php"
?>

<script>
    const id_user   = <?= $_SESSION["id"] ?>;
    const api_uc002 = "<?= $api_uc002 ?>";
    const host_name = "<?= $host_name ?>";
</script>

<script src="<?= $host_name ?>/public/js/uc002/model.js"></script>
<script src="<?= $host_name ?>/public/js/uc002/ot_request.js"></script>
<script src="<?= $host_name ?>/public/js/uc002/create_request.js"></script>