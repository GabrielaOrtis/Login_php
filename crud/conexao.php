<?php
$host = 'localhost';
$dbname = 'crud_teste'; // nome do banco que você criou no phpMyAdmin
$user = 'root';
$password = ''; // senha vazia no Laragon por padrão

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>



