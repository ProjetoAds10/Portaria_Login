<?php
// Mostrar erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicialize a sessão
session_start();

// Incluir arquivo de configuração
require_once "config.php";

// Defina variáveis e inicialize com valores vazios
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifique se o e-mail está vazio
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira o e-mail.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Verifique se a senha está vazia
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, insira sua senha.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar credenciais
    if (empty($email_err) && empty($password_err)) {
        // Prepare uma declaração selecionada
        $sql = "SELECT id, email, password FROM users WHERE email = :email";
        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            // Definir parâmetros
            $param_email = trim($_POST["email"]);
            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                // Verifique se o e-mail existe, se sim, verifique a senha
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {
                            // A senha está correta, então inicie uma nova sessão
                            session_start();
                            // Armazene dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            // Redirecionar o usuário para a página de boas-vindas
                            header("location: welcome.php");
                            exit;
                        } else {
                            // A senha não é válida, exibe uma mensagem de erro genérica
                            $login_err = "E-mail ou senha inválidos.";
                        }
                    }
                } else {
                    // O e-mail não existe, exibe uma mensagem de erro genérica
                    $login_err = "E-mail ou senha inválidos.";
                }
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

// Exibir mensagem de erro se houver
if (!empty($login_err)) {
    echo '<div class="alert alert-danger">' . $login_err . '</div>';
}
?>
