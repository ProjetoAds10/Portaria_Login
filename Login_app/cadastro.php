<?php
// Incluir arquivo de configuração
require_once "config.php";

// Defina variáveis e inicialize com valores vazios
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

// Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar e-mail
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor coloque um e-mail.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Por favor coloque um e-mail válido.";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM users WHERE email = :email";
        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            // Definir parâmetros
            $param_email = trim($_POST["email"]);
            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "Este e-mail já está em uso.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            // Fechar declaração
            unset($stmt);
        }
    }

    // Validar senha
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor insira uma senha.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar e confirmar a senha
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirme a senha.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "A senha não confere.";
        }
    }

    // Verifique os erros de entrada antes de inserir no banco de dados
    if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare uma declaração de inserção
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            // Definir parâmetros
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                // Redirecionar para a página de login
                header("location: login.php");
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            // Fechar declaração
            unset($stmt);
        }
    }
    // Fechar conexão
    unset($pdo);
}
?>



 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="estilos/styles_cadastro.css">
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

    <!-- Wrapper com estilo aplicado -->
    <div class="container">
        <div class="header">
            <h1>Preencha o formulário para criar uma conta</h1>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form">
            <!-- Campo de e-mail -->
            <div class="input-form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value=" <?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>

            <!-- Campo de senha -->
            <div class="input-form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <!-- Campo de confirmação de senha -->
            <div class="input-form-group">
                <label for="confirm_password">Confirme a senha</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>

            <!-- Botões de ação -->
            <div class="form-group">
                <input type="submit" class="btn btn-login" value="Criar Conta">
                <input type="reset" class="btn btn-secondary ml-2" value="Apagar Dados">
            </div>

            <!-- Link para login -->
            <p>Já tem uma conta? <a href="login.php" class="create-account">Entre aqui</a>.</p>
        </form>
    </div>
</body>
</html>
