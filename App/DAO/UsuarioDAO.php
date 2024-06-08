<?php

    namespace App\DAO;
    use App\Conn;
    use PDO;
    use PDOException;
    use APP\Models\UsuarioModel;

    class UsuarioDAO extends Conn
    {
        
        
        protected PDO $pdo;
        private $tabela = "usuario";
    
        public function __construct()
        {            
            if(!isset($_SESSION))
            {
                session_start();
            }
            //chama a funcao conectar toda vez que a  classe é chamada;
            $this->pdo = Conn::conectar();

        }
        
        public function Criarusuario(UsuarioModel $modelo)
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            
            $data= [
                'nome' => $modelo->getNome(),
                'senha' =>$modelo->getSenha(),
                'email' =>$modelo->getEmail(),
            ];

            try
            {
                $stmt = $this->pdo->prepare("INSERT INTO $this->tabela (nome_Usuario, senha_Usuario, email_Usuario, id_Cargo) VALUES (:nome, :senha, :email, '0')");

                if($stmt->execute($data))
                {
                    if($stmt->rowCount() > 0)
                    {
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Usuário cadastrado com sucesso!!<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        //array_push($_SESSION['msgsuccess'],$success);
                        $_SESSION['msgsuccess'][]=$success;
                    }
                    else
                    {
                        $erro ="<div class=\"alert alert-danger\" role=\"alert\"> BAH ERRADAO</div>";
                        //array_push($_SESSION['msgerro'],$erro);
                        $_SESSION['msgerro'] [] = $erro;
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
           if(!isset($_SESSION))
            {
                session_start();
            }
            try
            {
                $stmt = $this->pdo->prepare("SELECT id_Usuario, nome_Usuario, email_Usuario, senha_Usuario, id_cargo FROM $this->tabela WHERE email_Usuario = '$email' AND senha_Usuario = '$senha'");
                if($stmt->execute())
                {
                    if($stmt->rowCount() > 0)
                    {                     
                        $usuario =$stmt->fetch(PDO::FETCH_ASSOC);
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Bem Vindo ".$usuario['nome_Usuario']."<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        $_SESSION['usuario']=$usuario;
                        //array_push($_SESSION['msgsuccess'],$success);
                        $_SESSION['msgsuccess'][]=$success;
                    }else
                    {
                        $erro ="<div class=\"alert alert-danger\" role=\"alert\"> Senha ou Email incorretos</div>";
                        //array_push($_SESSION['msgerro'],$erro);
                        $_SESSION['msgerro'] [] = $erro;
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
                'id_cargo' =>$modelo->getCargo(),
                'id_Usuario' =>$modelo->getId()
            ];
            try
            {
                $stmt = $this->pdo->prepare("UPDATE $this->tabela SET nome_Usuario = :nome_Usuario, senha_Usuario = :senha_Usuario, email_Usuario = :email_Usuario, id_cargo = :id_cargo WHERE id_Usuario = :id_Usuario");
                
                if($stmt->execute($data))
                {                    
                    if($stmt->rowCount() > 0)
                    {
                        
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Usuário modificado com sucesso!!<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        $_SESSION['msgsuccess'] [] = $success;
                        /*sort($data);
                        sort($_SESSION['usuario']);*/
                        if($_SESSION['usuario'] == $data)
                        {
                            $_SESSION['usuario'] = $data;
                        }
                        
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

        public function Listar_Usuario()
        {
           if(!isset($_SESSION))
            {
                session_start();
            }
            try
            {
                $stmt = $this->pdo->prepare("SELECT * FROM $this->tabela");
                if($stmt->execute())
                {
                    if($stmt->rowCount() > 0)
                    {      
                        $resultado = array();  
                        while($res = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            array_push($resultado,$res);
                        }        
                        //$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Aqui está a lista de usuarios.<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        $_SESSION['usuarios']=$resultado;
                        //array_push($_SESSION['msgsuccess'],$success);
                        $_SESSION['msgsuccess'][]=$success;
                    }else
                    {
                        $erro ="<div class=\"alert alert-danger\" role=\"alert\"> Nenhum usuario cadastrado</div>";
                        //array_push($_SESSION['msgerro'],$erro);
                        $_SESSION['msgerro'] [] = $erro;
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
        public function Procurar_Usuario($id_usuario)
        {
           if(!isset($_SESSION))
            {
                session_start();
            }
            try
            {
                $stmt = $this->pdo->prepare("SELECT * FROM $this->tabela WHERE id_Usuario = '$id_usuario'");
                if($stmt->execute())
                {
                    if($stmt->rowCount() > 0)
                    {                     
                        $usuario =$stmt->fetch(PDO::FETCH_ASSOC);
                        $success = ("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Editando o usuario: ".$usuario['nome_usuario']."<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>");
                        $_SESSION['usuario_edt']=$usuario;
                        //array_push($_SESSION['msgsuccess'],$success);
                        $_SESSION['msgsuccess'][]=$success;
                    }else
                    {
                        $erro ="<div class=\"alert alert-danger\" role=\"alert\"> Usuario não existe</div>";
                        //array_push($_SESSION['msgerro'],$erro);
                        $_SESSION['msgerro'] [] = $erro;
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