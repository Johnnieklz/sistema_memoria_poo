<?php
class Usuario {
    // Classe base

    private $nome;
    private $email;
    private $senha;
    private $idioma;
    private $tema;

    public function __construct($nome, $email, $senha, $idioma, $tema) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        $this->idioma = $idioma;
        $this->tema = $tema;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdioma() {
        return $this->idioma;
    }

    public function getTema() {
        return $this->tema;
    }

    public function verificarSenha($senha) {
        return password_verify($senha, $this->senha);
    }

    public function exibirPerfil() {
        echo "<p>Nome: {$this->nome}</p>";
        echo "<p>Email: {$this->email}</p>";
        echo "<p>Idioma: {$this->idioma}</p>";
        echo "<p>Tema: {$this->tema}</p>";
    }
}
?>