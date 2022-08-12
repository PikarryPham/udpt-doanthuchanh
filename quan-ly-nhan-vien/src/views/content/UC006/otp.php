<div class="content">
    <div class="login-container">
        <div class="logo">
            <img src="../public/img/icon/logo.png" width="55px" height="47.63px" alt="logo">
            <img src="../public/img/icon/heading_logo.png" width="210px" alt="heading-logo">
        </div>

        <div style="height: 20px"></div>

        <p class="title">Verifications</p>
        <p class="sub-title" style="text-transform: none">Enter verifications code we just sent to your email address</p>

        <div style="height: 31px"></div>

        <div class="login-form">
            <form class="form" action="otp" method="POST">
                <div class="login-input">
                    <div class="input-container">
                        <label class="input-label" for="otp">Verification Code</label>
                        <input id='otp' type='text' name='otp' style='text-transform: none' placeholder='Enter your OTP'>
                        <?php 
                            if ($data[0] == "wrongotp") {
                                echo "<p class='error-message' style='text-transform: none; display: block'>OTP is wrong. Please input again</p>";
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