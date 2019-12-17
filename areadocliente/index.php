<html><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="css/login.css" rel="stylesheet">

        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <div class="fadeInDown" >
            <div id="formContent" class="login-form">
                <!-- Login Form -->
                <form action="menu.php" method="post" >
                    <div class="avatar">
					<img src="images/avatar.png" alt="Avatar">
				</div>
                    <div class="fadeIn first">
                        <h2 class="text-center">Area do Cliente</h2>
                    </div>
                    <div class="form-group">
                        <input type="text" id="login" class="fadeIn second form-control" name="login" placeholder="Usuário">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="fadeIn third form-control" name="pass" placeholder="Senha">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="fadeIn fourth form-control" value="Entrar">
                    </div>
                    <?php if(isset($_GET['errorlogin'])){ ?>
                    <div class="form-group">
                        <h6 class="text-center" style="color:red">Falha de login!! contate sua imobiliária</h6>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>

    </body></html>