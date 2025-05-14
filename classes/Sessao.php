<?php
class Sessao {
    // Gerenciamento de sessão
    <?php
class Sessao {
    public static function iniciar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function encerrar() {
        session_unset();
        session_destroy();
    }

    public static function set($chave, $valor) {
        $_SESSION[$chave] = $valor;
    }

    public static function get($chave) {
        return $_SESSION[$chave] ?? null;
    }

    public static function validar() {
        return isset($_SESSION['usuario']);
    }
}
?>

}
?>