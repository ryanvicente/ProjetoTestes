<?php

    namespace App\controllers;

    use Config\Controller\Action;
    use App\Models\UsuarioModel;

    class UsuarioController extends Action
    {
        /*public function __construct()
        {
            if(!isset($_SESSION))
            {
                session_start();
                $_SESSION['msgerro'] = array();
                $_SESSION['msgsuccess'] = array();
                $_SESSION['usuario'] = array();
            }
        }*/
        //proteger, somente usuarios logados
        public function Index()
        {
            if(!isset($_SESSION))
            {
                session_start();
            } 
            if(isset($_SESSION['usuario']))
            {
                if(in_array(1,$_SESSION['usuario']))
                {
                    $this->render("Admin/Index.phtml","LayoutSite");
                }
                else
                {
                    $this->render("Usuario/Index.phtml","LayoutSite");
                }

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
            /*if((session_status() == PHP_SESSION_DISABLED))
            {
                session_start();
            }*/
            if(!isset($_SESSION))
            {
                session_start();
            }
            $model = new UsuarioModel();
            $cols = implode(',',array_keys($_POST));
            $names = explode(',',$cols);
            $model->setEmail($names[0],$_POST[$names[0]]);
            $model->setNome($names[1],$_POST[$names[1]]);
            $model->setSenha($names[2],$_POST[$names[2]]);
            
            if(empty($_SESSION['msgerro']) || ($_SESSION['msgerro'] == null))
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
            if(!isset($_SESSION))
            {
                session_start();
            }
            if(isset($_SESSION['usuario']) && ((!empty($_SESSION['usuario']))))
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
            if(!isset($_SESSION))
            {
                session_start();
            }
            if((isset($_SESSION['usuario'])) && (!empty($_SESSION['usuario'])))
            {
                header("Location: /minhaconta");
            }
            else
            {
                $model = new UsuarioModel();
                $cols = implode(',',array_keys($_POST));
                $names = explode(',',$cols);
                $model->setEmail($names[0],$_POST[$names[0]]);
                $model->setSenha($names[1],$_POST[$names[1]]);

                if($_SESSION['msgerro'] == null || empty($_SESSION['msgerro']))
                {
                    $model->logar();

                    if(empty($_SESSION['msgerro']) && !empty($_SESSION['msgsuccess']))
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
        }
        public function Deslogar()
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            unset($_SESSION['usuario']);
            header("Location: /");
        }
        public function editar()
        {
            if(isset($_GET['id']))
            {
                $model = new UsuarioModel();
                $model->Search($_GET['id']);
            }
            $this->render("Usuario/Editar.phtml","LayoutSite");
        }
        public function editando()
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            //$usuario = $_SESSION['usuario'];
            $model = new UsuarioModel();
            if($_SESSION['usuario_edt'] == null)
            {
                $usuario = $_SESSION['usuario'];
            }
            else
            {
                
                $usuario = $_SESSION['usuario_edt'];
            }
            
            if($_POST['email_Usuario'] != null)
            {
                $model->setEmail('email_Usuario',$_POST['email_Usuario']);
            }
            else
            {
                $model->setEmail('email_Usuario',$usuario['email_usuario']);
            }
            if($_POST['nome_Usuario'] != null)
            {
                $model->setNome('nome_Usuario',$_POST['nome_Usuario']);
            }
            else
            {
                $model->setNome('nome_Usuario',$usuario['nome_usuario']);
            }
            if($_POST['senha_Usuario'] != null)
            {
                $model->setSenha('senha_Usuario',$_POST['senha_Usuario']);
            }
            else
            {
                $model->setSenha('senha_Usuario',$usuario['senha_usuario']);
            }
            $model->setId('id_Usuario',$_POST['id_Usuario']);
            $model->setCargo('id_Cargo', $_POST['id_Cargo']);
            $_SESSION['tst'] = $model;

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
        public function Lista_Usuario()
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            if(!($_SESSION['usuario'] == null))
            {
                if(in_array(1,$_SESSION['usuario']))
                {
                    $model = new UsuarioModel();
                    $model->listar();
                    if(empty($_SESSION['msgerro']) && !empty($_SESSION['msgsuccess']))
                    {
                        $this->render("Admin/ListaUsuario.phtml","LayoutSite");
                    }
                    else
                    {
                        $_SESSION['usuarioerror'] = $_POST;
                        header("Location: /lista");
                    }
                }
                else
                {
                    $this->render("Error/index.phtml","LayoutSite");
                }
            }
            else
            {
                header("Location: /");
            }
        }
        public function Busca_usuario()
        {
            
        }

    }