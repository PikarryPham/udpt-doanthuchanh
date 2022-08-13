<div class="content">
    <div class="login-container">
        <div class="logo">
            <img src="../public/img/icon/logo.png" width="55px" height="47.63px" alt="logo">
            <img src="../public/img/icon/heading_logo.png" width="210px" alt="heading-logo">
        </div>

        <div style="height: 20px"></div>

        <p class="title">Forgot Password</p>
        <p class="sub-title" style="text-transform: none">Do not worry, we will help you to recover your password</p>

        <div style="height: 31px"></div>

        <div class="login-form">
            <form class="form" action="onForgotPass" method="POST">
                <div class="login-input">
                    <div class="input-container">
                        <label class="input-label" for="email">Please enter your email</label>
                        <input id='email' type='text' name='email' style='text-transform: none' placeholder='Enter your email'>
                        <?php 
                            if ($data[0] == "false") {
                                echo "<p class='error-message' style='text-transform: none; display: block'>Email is not exist</p>";
                            } else if ($data[0] == "mailerror") {
                                echo "<p class='error-message' style='text-transform: none; display: block'>Send mail error, please try again!</p>";
                            } else {
                                echo "";
                            }
                        ?>
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