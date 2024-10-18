<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_portaria";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $cpf = $_POST['cpf'];
    $action = $_POST['action'];

    if ($action == "validar") {
        // Código para validar o usuário
        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND cpf='$cpf'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Usuário validado com sucesso!";
        } else {
            echo "Usuário não encontrado!";
        }
    } elseif ($action == "cadastrar") {
        // Código para cadastrar o usuário
        $sql = "INSERT INTO usuarios (usuario, cpf) VALUES ('$usuario', '$cpf')";

        if ($conn->query($sql) === TRUE) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário: " . $conn->error;
        }
    }
}

$conn->close();
?>
