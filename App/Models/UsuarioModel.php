<?php
    namespace App\Models;

    use App\DAO\UsuarioDAO;

    class UsuarioModel
    {
        protected $id_Usuario=null;
        protected $nome_Usuario;
        protected $senha_Usuario;
        protected $email_Usuario;
        protected $id_Cargo=null;
        //protected $id_role; 
        /*public function __construct(){
            if(!isset($_SESSION))
            {
                session_start();
                $_SESSION['msgerro'] = array();
                $_SESSION['msgsuccess'] = array();
                $_SESSION['usuario'] = array();
            }
            
        }*/
        //criar $_SESSION['msg'] para retornar para o usuario;
        //fazer set's e get's para validação e obtenção dos dados;
        public function setNome($name, $value)
        {
            //name;
            if(preg_match("/^([a-zA-Z' ]+)$/",$value))
            {
                $this->$name = $value;
            }
            else
            {
                $erro = "<div class=\"alert alert-danger\" role=\"alert\"> Nome inválido</div>";
                array_push($_SESSION['msgerro'],$erro);
            }
        }

        public function setSenha($name, $value)
        {     
            if(strlen($value) >= 8)
            {
                if(preg_match('/^[a-f0-9]{32}$/', $value))
                {
                    $this->$name = $value;
                }
                else
                {
                    $this->$name = md5($value);
                }
                
            }
            else
            {
                $erro = "<div class=\"alert alert-danger\" role=\"alert\"> Senha inválida, mínimo de 8 caracteres</div>";
                //$_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\"> Senha inválida, mínimo de 8 caracteres</div>";
                array_push($_SESSION['msgerro'],$erro);
                
            }
        }
        public function setEmail($name, $value)
        {
            if(filter_var($value,FILTER_VALIDATE_EMAIL))
            {
                $this->$name = $value;
            }
            else
            {
                $erro = "<div class=\"alert alert-danger\" role=\"alert\"> Email inválido</div>";
                //$_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\"> email inválido</div>";
                //array_push($_SESSION['msgerro'],$erro);
                $_SESSION['msgerro'] [] = $erro;
            }
            
            
        }
        public function setId($name, $value)
        {
            $this->$name = $value;
        }
        public function setCargo($name, $value)
        {
            $this->$name = $value;
        }

        public function getNome()
        {
            return $this->nome_Usuario;
        }

        public function getSenha()
        {
            return $this->senha_Usuario;
        }

        public function getEmail()
        {
            return $this->email_Usuario;
        }
        public function getId()
        {
            return $this->id_Usuario;
        }
        public function getCargo()
        {
            return $this->id_Cargo;
        }
        //conexão com o DAO
        public function save()
        {
            $dao = new UsuarioDAO();
            if(empty($this->id_Usuario))
            {
                
                $dao->Criarusuario($this);
            }
            else
            {
                $dao->Editarusuario($this);
            }
        }
        public function logar()
        {
            $dao = new UsuarioDAO();
            $dao->login($this->email_Usuario, $this->senha_Usuario);
        }
        public function listar()
        {
            $dao = new UsuarioDAO();
            $dao->Listar_Usuario();
        }
        public function Search($id_usuario)
        {
            $dao = new UsuarioDAO();
            $dao ->Procurar_Usuario($id_usuario);
        }
    }