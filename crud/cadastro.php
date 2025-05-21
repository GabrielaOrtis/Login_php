<?php
// Conexão com o banco de dados
require 'conexao.php';

// Variável para mostrar mensagem (de erro ou sucesso)
$mensagem = '';

// Verifica se o formulário foi enviado (usando o botão "Cadastrar")
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega os dados preenchidos no formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografa a senha antes de salvar no banco 
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    try {
        // Prepara o comando SQL para inserir o novo usuário
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaCriptografada);
        $stmt->execute();

        // Se der tudo certo, exibe a mensagem de sucesso
        $mensagem = "<div class='sucesso'>Usuário cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        // Se der erro, exibe uma mensagem explicando
        $mensagem = "<div class='erro'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
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
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 95%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>

        <!-- Exibe a mensagem de sucesso ou erro, se houver -->
        <?php if (!empty($mensagem)) {
            echo $mensagem;
        } ?>

        <!-- Formulário de cadastro -->
        <form method="POST">
            <input type="text" name="nome" placeholder="Digite seu nome" required><br>
            <input type="email" name="email" placeholder="Digite seu e-mail" required><br>
            <input type="password" name="senha" placeholder="Digite sua senha" required><br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
