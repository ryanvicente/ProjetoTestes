<?php

    namespace App\DAO;
    use App\Conn;
    use PDO;
    use PDOException;
    use APP\Models\UsuarioModel;

    class UsuarioDAO extends Conn
    {
        
        protected $pdo;
        private $tabela = "usuario";
    
        public function __construct()
        {
            if(session_status() != 2)
            {
                session_start();
            }
            //chama a funcao conectar toda vez que a  classe é chamada;
            $this->pdo = Conn::conectar();
        }
        
        public function Criarusuario(UsuarioModel $modelo)
        {
            $data=[
                'nome' => $modelo->getNome(),
                'senha' =>$modelo->getSenha(),
                'email' =>$modelo->getEmail(),
            ];
            try
            {
                $stmt = $this->pdo->prepare("INSERT INTO $this->tabela (nome_Usuario, senha_Usuario, email_Usuario) VALUES (:nome, :senha, :email )");

                if($stmt->execute($data))
                {
                    if($stmt->rowCount() > 0)
                    {
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Usuário cadastrado com sucesso!!<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        array_push($_SESSION['msgsuccess'],$success);
                    }
                    else
                    {
                        throw new PDOException("nao encontrou");
                    }
                }
                else
                {   
                    throw new PDOException("erro SQL");
                }
            }
            catch(PDOException $e)
            {
                echo("Erro: ".$e->getMessage());
            }
        }

        public function login($email, $senha)
        {
            session_start();
            try
            {
                $stmt = $this->pdo->prepare("SELECT id_Usuario, nome_Usuario, email_Usuario, senha_Usuario FROM $this->tabela WHERE email_Usuario = '$email' AND senha_Usuario = '$senha'");
                if($stmt->execute())
                {
                    if($stmt->rowCount() > 0)
                    {                     
                        $usuario =$stmt->fetch(PDO::FETCH_ASSOC);
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Bem Vindo ".$usuario['nome_Usuario']."<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        $_SESSION['usuario']=$usuario;
                        array_push($_SESSION['msgsuccess'],$success);
                    }else
                    {
                        $erro ="<div class=\"alert alert-danger\" role=\"alert\"> Senha ou Email incorretos</div>";
                        array_push($_SESSION['msgerro'],$erro);
                    }
                }
                else
                {   
                    throw new PDOException("erro SQL");
                }
            }
            catch(PDOException $e)
            {
                echo("Erro: ".$e->getMessage());
            }
        }

        public function Editarusuario(UsuarioModel $modelo)
        {
            $data=[
                'nome_Usuario' => $modelo->getNome(),
                'senha_Usuario' =>$modelo->getSenha(),
                'email_Usuario' =>$modelo->getEmail(),
                'id_Usuario' =>$modelo->getId()
            ];
            try
            {
                $stmt = $this->pdo->prepare("UPDATE $this->tabela SET nome_Usuario = :nome_Usuario, senha_Usuario = :senha_Usuario, email_Usuario = :email_Usuario WHERE id_Usuario = :id_Usuario");
                
                if($stmt->execute($data))
                {                    
                    if($stmt->rowCount() > 0)
                    {
                        
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Usuário modificado com sucesso!!<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        array_push($_SESSION['msgsuccess'],$success);
                        $_SESSION['usuario'] = $data;
                    }
                    else
                    {
                        throw new PDOException("nao encontrou");
                    }
                }
                else
                {   
                    throw new PDOException("erro SQL");
                }
            }
            catch(PDOException $e)
            {
                 
                echo("Erro: ".$e->getMessage());
            }
        }
    }