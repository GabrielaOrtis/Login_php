<?php
session_start();
$mensagem = "";

// Conexão com o banco (ajuste com suas configs)
$conexao = new mysqli("localhost", "root", "", "crud_teste");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];

    $stmt = $conexao->prepare("INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nome, $descricao, $preco);

    if ($stmt->execute()) {
        $mensagem = "Produto cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar produto.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
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
            max-width: 500px;
            margin: 60px auto; 
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .mensagem {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            font-weight: bold;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Barra superior com os botões -->
    <div class="top-bar">
        <div><strong>Cadastro de Produtos</strong></div>
        <div>
            <a href="painel.php">← Voltar</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>

    <div class="container">
        <h2>Cadastrar Produto</h2>

        <!-- Mensagem de sucesso ou erro -->
        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="nome">Nome do Produto</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="preco">Preço</label>
            <input type="number" step="0.01" id="preco" name="preco" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
