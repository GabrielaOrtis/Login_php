<?php
require 'conexao.php';
session_start();

// Verifica se o usuário está logado, senão redireciona
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Verifica se o ID do produto foi enviado pela URL
if (!isset($_GET['id'])) {
    echo "Produto não encontrado.";
    exit;
}

$id = $_GET['id'];

// Busca os dados do produto no banco pelo ID
$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar o produto, mostra erro
if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}

// Quando o formulário for enviado com alterações
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novoNome = $_POST['nome'];
    $novaDescricao = $_POST['descricao'];
    $novoPreco = $_POST['preco'];

    // Atualiza o produto no banco de dados
    $stmt = $conn->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id");
    $stmt->bindParam(':nome', $novoNome);
    $stmt->bindParam(':descricao', $novaDescricao);
    $stmt->bindParam(':preco', $novoPreco);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redireciona de volta para a lista de produtos
    header("Location: produtos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
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
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: left;
            width: 100%;
            max-width: 500px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
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
    <div class="container">
        <h2>Editar Produto</h2>
        <form method="POST">
            <label for="nome">Nome do Produto</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" required><?= htmlspecialchars($produto['descricao']) ?></textarea>

            <label for="preco">Preço</label>
            <input type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
