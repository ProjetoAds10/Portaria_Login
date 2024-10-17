<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portaria Inteligente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link para o CSS -->
</head>
<body>
    <header>
        <div class="interface">
            <div class="logo">
                <img src="img/logo P. inteligente.png" alt="logo do site">
            </div><!--logo-->
            <h1>Portaria<br>Inteligente</h1>
        </div><!--interface-->
    </header>

    <div class="container">
        <div class="form">
            <div class="header">
                <h1>Faça login para acessar o aplicativo</h1>
                <div class="cadeado gif">
                    <img src="img/gif_cadeado.gif" alt="gif cadeado do formulario">
                </div><!--gif_cadeado-->
            </div><!--header-->

            <!-- FORMULÁRIO -->
            <form method="post" action="" class="form">
                <div class="input">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder=" " id="email">
                </div>
                <div class="input">
                    <label for="password">Senha</label>
                    <input type="password" id="login-password" name="password" placeholder=" " id="password">
                </div>
                <a href="#" class="forgot-password">Esqueceu a senha?</a>
                <input type="submit" name="login" value="Login" class="btn btn-login">
                <hr>
                <input type="submit" name="google-login" value="Entrar com o Google" class="btn btn-google">
                <a href="#" class="create-account">Criar conta</a>
            </form>
        </div><!--form-->
    </div> <!--container-->
</body>
</html>
