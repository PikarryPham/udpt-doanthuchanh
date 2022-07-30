
<!DOCTYPE html>
<html>
    <head>
        <title>Đăng nhập</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= $host_name ?>/public/css/login.css" rel="stylesheet" type="text/css"/>
        <style>
            
        </style>
    </head>
    <body >
        <header>
            <div class="container">
                <h1> Wellcome to manager employee</h1>
            </div>
        </header>
        <main>
            <div class="container">
            <div class="login-form">
                <form action="<?= $host_name ?>/home/sign_in" method="post">
                    <h1>Đăng nhập vào website</h1>
                    <div class="message"></div>
                    <div class="input-box">
                        <i ></i>
                        <input name="username" type="text" placeholder="Nhập username">
                    </div>
                    <div class="input-box">
                        <i ></i>
                        <input name="password" type="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="btn-box">
                        <button type="submit">
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </main>
        <footer>
            <div class="container">
            CÔNG TY MANAGER EMPLOYEE - Copyright © 2022 
            </div>
        </footer>
    </body>
</html>