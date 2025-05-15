<?php
// Tela principal após login

require_once 'classes/Usuario.php';
require_once 'classes/Administrador.php';
require_once 'classes/Sessao.php';
require_once 'config.php'; // configurações e sessão

Sessao::iniciar();

$usuarioSerializado = Sessao::get('usuario');

if (!$usuarioSerializado) {
    header('Location: index.php');
    exit;
}

$usuario = unserialize($usuarioSerializado);

if ($usuario instanceof Administrador){
    $usuario ->listarUsuarios();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script>
        // Recupera preferências do localStorage
        document.addEventListener("DOMContentLoaded", () => {
            const tema = localStorage.getItem('tema');
            if (tema) document.body.style.backgroundColor = tema === 'escuro' ? '#222' : '#fff';
        });
    </script>
</head>
<body>
    <h2>Bem-vindo(a)!</h2>
    <?php $usuario->exibirPerfil(); ?>

    <?php if ($usuario instanceof Administrador): ?>
        <hr>
        <?php $usuario->listarUsuarios(); ?>
    <?php endif; ?>

    <button onclick="alternarTema()">Alternar Tema</button>


    <p><a href="logout.php">Sair</a></p>
</body>
</html>

?>