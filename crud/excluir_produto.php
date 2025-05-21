<?php
require 'conexao.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: produtos.php");
    exit;
}

$id = $_GET['id'];

// Excluir o produto
$stmt = $conn->prepare("DELETE FROM produtos WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: produtos.php");
exit;
