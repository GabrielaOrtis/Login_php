<?php
require 'conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['nome'];
            header("Location: painel.php"); // agora redireciona pro painel
            exit;
        } else {
            $erro = "Email ou senha inválidos.";
        }
    } catch (PDOException $e) {
        $erro = "Erro ao fazer login: " . $e->getMessage();
    }
}
?>

<!-- visual -->
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

    .login-container {
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        text-align: center;
        width: 100%;
        max-width: 400px;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    input[type="email"],
    input[type="password"] {
        width: 90%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
    }

    button {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
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
</style>

<!-- Formulário de login -->
<div class="login-container">
    <?php if (isset($erro)): ?>
        <div class="erro"><?php echo $erro; ?></div>
    <?php endif; ?>
    <h2>Login do Sistema</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Digite seu email" required><br>
        <input type="password" name="senha" placeholder="Digite sua senha" required><br>
        <button type="submit">Entrar</button>
    </form>
</div>
