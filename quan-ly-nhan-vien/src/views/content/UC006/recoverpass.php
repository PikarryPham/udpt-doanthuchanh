<div class="content">
    <div class="login-container">
        <div class="logo">
            <img src="../public/img/icon/logo.png" width="55px" height="47.63px" alt="logo">
            <img src="../public/img/icon/heading_logo.png" width="210px" alt="heading-logo">
        </div>

        <div style="height: 20px"></div>

        <p class="title">Change Password</p>
        <p class="sub-title" style="text-transform: none">Create a new password that is at least 4 characters long</p>

        <div style="height: 31px"></div>

        <div class="login-form">
            <form class="form" action="recoverpass" method="POST">
                <div class="login-input">
                    <div class="input-container">
                        <label class="input-label" for="email">Email</label>
                        <?php 
                            echo "<input id='email' type='text' name='email' style='text-transform: none' value='$data[0]' disabled>";
                        ?>
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="newpassword">New Password</label>
                        <div class="input-password-container">
                            <i class="fa-solid fa-eye toggle-password toggle-new-password"></i>
                            <input id='newpassword' type='password' name='newpassword' style='text-transform: none' placeholder='Enter your new password'>
                        </div>
                        <p class="error-message new-error-message" style="text-transform: none">Empty</p>
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="confirmnewpassword">Confirm New Password</label>
                        <div class="input-password-container">
                            <i class="fa-solid fa-eye toggle-password toggle-confirm-password"></i>
                            <input id='confirmnewpassword' type='password' name='confirmnewpassword' style='text-transform: none' placeholder='Enter your confirm new password'>
                        </div>
                        
                        <p class="error-message confirm-error-message " style="text-transform: none">Empty</p>
                    </div>
                   
                    
                </div>

                <div style="height: 25px"></div>

                <div class="login-button">
                    <button class="next" type="submit" name="btnSubmit">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= $host_name ?>/public/js/uc006/recoverpass.js"></script>