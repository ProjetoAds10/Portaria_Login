<?php
$host = '127.0.0.1'; // ou o IP do seu servidor MySQL
$db = 'sistema_login';
$user = 'root'; // seu usuário MySQL
$pass = ''; // sua senha MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>