<?php

    namespace App\controllers;

    use Config\Controller\Action;
    use App\Models\UsuarioModel;

    class UsuarioController extends Action
    {
        //proteger, somente usuarios logados
        public function Index()
        {
            if(session_status() == 0 or session_status() == 1)
            {
                session_start();
            } 
            if(isset($_SESSION['usuario']))
            {
                $this->render("Usuario/Index.phtml","LayoutSite");
            }
            else
            {
                header("Location: /login");
            }

        }
        public function Cadastro()
        {
            $this->render("Usuario/Cadastro.phtml","LayoutSite");
        }
        public function Cadastrar()
        {
            if(session_status() != 2)
            {
                session_start();
            }
            $model = new UsuarioModel();
            $cols = implode(',',array_keys($_POST));
            $names = explode(',',$cols);
            $model->setEmail($names[0],$_POST[$names[0]]);
            $model->setNome($names[1],$_POST[$names[1]]);
            $model->setSenha($names[2],$_POST[$names[2]]);
            
            if($_SESSION['msgerro'] == null)
            {
                $model->save();
                header("Location: /login");
            }
            else
            {
                $_SESSION['usuarioerror'] = $_POST;
                header("Location: /cadastro");
            }
        }
        public function Login()
        {
            if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario']))
            {
                header("Location: /minhaconta");
            }
            else
            {
                $this->render("Usuario/Login.phtml","LayoutSite");
            }
            
        }
        public function Logar()
        {
            if(session_status() != 2)
            {
                session_start();
            }
            $model = new UsuarioModel();
            $cols = implode(',',array_keys($_POST));
            $names = explode(',',$cols);
            $model->setEmail($names[0],$_POST[$names[0]]);
            $model->setSenha($names[1],$_POST[$names[1]]);

            if($_SESSION['msgerro'] == null)
            {
                $model->logar();

                if($_SESSION['msgerro'] == null && !empty($_SESSION['msgsuccess']))
                {

                    
                    header("Location: /minhaconta");
                }
                else
                {
                    $_SESSION['usuarioerror'] = $_POST;
                    header("Location: /login");
                }
            }
            else
            {
                $_SESSION['usuarioerror'] = $_POST;
                header("Location: /login");
            }
        }
        public function Deslogar()
        {
            session_start();
            unset($_SESSION['usuario']);
            header("Location: /");
        }
        public function editar()
        {
            $this->render("Usuario/Editar.phtml","LayoutSite");
        }
        public function editando()
        {
            if(session_status() != 2)
            {
                session_start();
            }
            $usuario = $_SESSION['usuario'];
            
            $model = new UsuarioModel();
            if($_POST['email_Usuario'] != null)
            {
                $model->setEmail('email_Usuario',$_POST['email_Usuario']);
            }
            else
            {
                $model->setEmail('email_Usuario',$usuario['email_Usuario']);
            }
            if($_POST['nome_Usuario'] != null)
            {
                $model->setNome('nome_Usuario',$_POST['nome_Usuario']);
            }
            else
            {
                $model->setNome('nome_Usuario',$usuario['nome_Usuario']);
            }
            if($_POST['senha_Usuario'] != null)
            {
                $model->setSenha('senha_Usuario',$_POST['senha_Usuario']);
            }
            else
            {
                $model->setSenha('senha_Usuario',$usuario['senha_Usuario']);
            }
            $model->setId('id_Usuario',$_POST['id_Usuario']);

            if($_SESSION['msgerro'] == null)
            {
                $model->save();
                header("Location: /minhaconta");
            }
            else
            {
                $_SESSION['usuarioerror'] = $_POST;
                header("Location: /editarinformacao");
            }
        }
    }