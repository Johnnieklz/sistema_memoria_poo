<?php
// Inicia sessão caso ainda não tenha iniciado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carrega automaticamente as classes (se usar PSR-4 ou estrutura simples)
require_once 'classes/Sessao.php';

// Definições globais
define('USUARIOS_JSON', 'dados/usuarios.json');
define('ADMIN_EMAIL', 'admin@admin.com');

// Inicia a classe Sessao
Sessao::iniciar();
?>
