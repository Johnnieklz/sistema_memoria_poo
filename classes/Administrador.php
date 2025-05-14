<?php
class Administrador extends Usuario 
    // Classe derivada
        private $tipo;
        private $id;
        private $data_cadrastro;
        private $idioma;
        private $tema;
        public function __construct($nome, $email, $senha, $tipo, $id, $data_cadrastro, $idioma, $tema){
            $this->name = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->tipo = $tipo;
            $this->id = $id;;
            $this->data_cadrastro = $data_cadrastro;
            $this->idioma = $idioma;
            $this->tema = $tema;

        }


}
?>
             