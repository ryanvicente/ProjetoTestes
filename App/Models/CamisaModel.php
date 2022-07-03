<?php

    namespace App\Models;

    class CamisaModel
    {
        protected $id_Camisa = null;
        protected $estilo_Camisa;
        protected $cor_Camisa;
        protected $preco_Camisa;
        protected $publicar_Estampa;
        protected $descricao_Estampa;
        protected $imagem_Estampa;
        protected $tipo_Imagem;
        protected $criador_Estampa;

        public function setEstilo($name, $value)
        {
            $this->$name = $value;
        }

        public function setCor($name, $value)
        {
            $this->$name = $value;
        }

        public function setpreco($name, $value)
        {
            $this->$name = $value;
        }
        public function setDescricao($name, $value)
        {
            $this->$name = $value;
        }
        public function setImagem()
        {
            
        }
        public function setCriador($name, $value)
        {
            $this->$name = $value;
        }
        public function setPublicar($name, $value)
        {
            $this->$name = $value;
        }
        public function getEstilo()
        {
            
        }
        public function save()
        {
            $dao = new CamisaDAO();
            $dao->Criarcamisa($this);
        }
        public function listar()
        {
            $dao = new CamisaDAO();
            $dao->Listarcamisa();
        }

    }
