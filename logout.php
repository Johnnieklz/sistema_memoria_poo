<?php
// Encerrar sessão

require_once 'classes/Sessao.php';

Sessao::iniciar();
$_SESSION['Mensagem'] = 'Você saiu com sucesso!';
Sessao::encerrar();

// Redireciona para o login
header('Location: index.php');
exit;

?>