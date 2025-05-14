<?php
require_once 'classes/Usuario.php';
require_once 'classes/Administrador.php';
require_once 'classes/Sessao.php';

Sessao::iniciar();

$mensagem = $_SESSION["Mensagem"] ?? '';

if (!empty ($_SESSION['Mensagem'])) {
    unset($_SESSION['Mensagem']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            throw new Exception("Informe o email e a senha.");
        }

        $arquivo = 'dados/usuarios.json';
        $usuarios = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];

        $usuarioLogado = null;

        foreach ($usuarios as $u) {
            if ($u['email'] === $email && password_verify($senha, $u['senha'])) {
                // Cria instância da classe correta
                if ($u['email'] === 'admin@admin.com') {
                    $usuarioLogado = new Administrador($u['nome'], $u['email'], $senha, $u['idioma'], $u['tema']);
                } else {
                    $usuarioLogado = new Usuario($u['nome'], $u['email'], $senha, $u['idioma'], $u['tema']);
                }
                break;
            }
        }

        if ($usuarioLogado) {
            Sessao::set('usuario', serialize($usuarioLogado));
            header('Location: dashboard.php');
            exit;
        } else {
            throw new Exception("Email ou senha inválidos.");
        }

    } catch (Exception $e) {
        $mensagem = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Senha: <input type="password" name="senha" required></label><br><br>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>

    <?php if ($mensagem): ?>
        <p style="color: green;"><strong><?= $mensagem ?></strong></p>
    <?php endif; ?>
</body>
</html>
