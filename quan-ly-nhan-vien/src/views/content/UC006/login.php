<div class="content">
    <div class="login-container">
        <div class="logo">
            <img src="<?= $host_name ?>/public/img/icon/logo.png" width="55px" height="47.63px" alt="logo">
            <img src="<?= $host_name ?>/public/img/icon/heading_logo.png" width="210px" alt="heading-logo">
        </div>

        <div style="height: 20px"></div>

        <p class="title">Login</p>
        <p class="sub-title" style="text-transform: none">Welcome back. Enter your credentials to access your account</p>

        <div style="height: 31px"></div>

        <div class="login-form">
            <form class="form" action="home/sign_in" method="POST">
                <div class="login-input">
                    <div class="input-container">
                        <label class="input-label" for="username">Username/EmployeeID</label>
                        <?php
                            echo "<input id='username' type='text' name='username' style='text-transform: none' placeholder='Enter your username' value='$data[0]'>"
                        ?>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="password">Password</label>
                        <div class="input-password-container">
                            <i class="fa-solid fa-eye toggle-password"></i>
                            <?php
                                echo "<input id='password' type='password' name='password' style='text-transform: none' placeholder='Enter your password' value='$data[1]'>"
                            ?>
                        </div>
                        <?php 
                            if ($data[2] == "wrongusernameorpassword") {
                                echo '<p class="error-message" style="text-transform: none; display: block">Wrong username or password</p>';
                            } else {
                                echo '<p class="error-message" style="text-transform: none"></p>';
                            }
                        ?>
                    </div>
                </div>
                <div class="flex-row-space-between">
                    <div class="remember-checkbox">
                        <input type="checkbox" name="remember-me" id="remember-me">
                        <label class="input-label" for="remember-me">Remember Username</label>
                    </div>
                    <a href="<?= $host_name ?>/uc006/forgot" class="forgot-password">Forgot Password</a>
                </div>

                <div style="height: 15px"></div>

                <div class="login-button">
                    <button class="login" type="submit" name="btnSubmit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= $host_name ?>/public/js/uc006/login.js"></script>