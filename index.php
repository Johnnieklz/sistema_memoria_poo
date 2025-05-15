<?php
require_once 'config.php'; // configurações e sessão
require_once 'classes/Usuario.php';
require_once 'classes/Administrador.php';
required_once 'config.php'; // configurações e sessão

Sessao::iniciar();

$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);

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
                // Herança: verifica se é admin
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

    <?php if ($mensagem): ?>
        <p style="color: red;"><strong><?= htmlspecialchars($mensagem) ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Senha: <input type="password" name="senha" required></label><br><br>
        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
</body>
</html>
