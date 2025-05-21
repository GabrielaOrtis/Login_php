<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
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
        <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>
        <a href="produtos.php">Ver Produtos</a>
        <a href="cadastrar_produto.php">Cadastrar Produto</a>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
