<?php
require 'conexao.php';
session_start();

// Se o usuário não estiver logado, ele é redirecionado para a tela de login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Aqui faço a busca de todos os produtos no banco de dados
$stmt = $conn->prepare("SELECT * FROM produtos");
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Recebo todos os produtos em forma de lista
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
             background: linear-gradient(120deg, #89f7fe, #66a6ff);
            margin: 0;
            padding: 0;
        }
        .top-bar {
            background-color: #ffffffcc;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .top-bar a {
            text-decoration: none;
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            background-color: #007bff;
            transition: background-color 0.3s;
        }

        .top-bar a:hover {
            background-color: #0056b3;
        }
        

        .container {
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        text-align: center;
        width: 90%;
        max-width: 800px;
        margin: 80px auto 0 auto; 
        }

        

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        .acoes a {
            margin: 0 5px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="top-bar">
    <div><strong>Produtos</strong></div>
    <div>
        <a href="painel.php">← Voltar</a>
        <a href="logout.php">Sair</a>
    </div>
</div>
    <div class="container">
        <h2>Lista de Produtos</h2>
        <a href="cadastrar_produto.php">Cadastrar Novo Produto</a><br><br>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>

            <!-- Aqui estou mostrando cada produto em uma linha da tabela -->
            <?php foreach ($produtos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['nome'] ?></td>
                <td><?= $p['descricao'] ?></td>
                <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                <td class="acoes">
                    <a href="editar_produto.php?id=<?= $p['id'] ?>">Editar</a> |
                    <a href="excluir_produto.php?id=<?= $p['id'] ?>">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
