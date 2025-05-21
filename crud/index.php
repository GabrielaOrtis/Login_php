<?php
session_start();
$logado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Início do Sistema</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #fff;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
        }

        a {
            display: block;
            margin: 12px 0;
            font-size: 18px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Sistema de Gerenciamento</h1>

        <?php if ($logado): ?>
            <a href="produtos.php">Ver Produtos</a>
            <a href="cadastrar_produto.php">Cadastrar Produto</a>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastrar Usuário</a>
        <?php endif; ?>
    </div>

</body>
</html>
