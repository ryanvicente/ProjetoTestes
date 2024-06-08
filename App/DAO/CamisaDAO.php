<?php

    namespace App\DAO;
    use App\Conn;
    use PDO;
    use PDOException;
    use APP\Models\UsuarioModel;

    class CamisaDAO extends Conn
    {
        protected $pdo;
        private $tabela = "camisa";
    
        public function __construct()
        {
            //chama a funcao conectar toda vez que a  classe é chamada;
            $this->pdo = Conn::conectar();
            
            if(!isset($_SESSION))
            {
                session_start();
                $_SESSION['msgerro'] = array();
                $_SESSION['msgsuccess'] = array();
                $_SESSION['usuario'] = array();
            }
        }

        public function Criarcamisa(UsuarioModel $modelo)
        {
            
        }
        public function Listarcamisa(?string $id)
        {
            try
            {
                if($id == null)
                {
                    $stmt = $this->pdo->prepare("SELECT * FROM $this->tabela");
                    if($stmt->execute())
                    {
                        if($stmt->rowCount() > 0)
                        {
                            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                            $this->pdo=null;
                            return $result;
                        }else
                        {
                            throw new PDOException("nao encontrou");
                            $this->pdo=null;
                        }
                    }else
                    {   
                        throw new PDOException("erro SQL");
                        $this->pdo=null;
                    }
                }
                else
                {
                    $stmt = $this->pdo->prepare("SELECT * FROM $this->tabela WHERE nome_Estampa = $id");
                    if($stmt->execute())
                    {
                        if($stmt->rowCount() > 0)
                        {
                            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                            $this->pdo=null;
                            return $result;
                        }else
                        {
                            throw new PDOException("nao encontrou");
                            $this->pdo=null;
                        }
                    }else
                    {   
                        throw new PDOException("erro SQL");
                        $this->pdo=null;
                    }
                }
                
            }
            catch(PDOException $e)
            {
                echo("Erro: ".$e->getMessage());
            }
            return null;
        }
        public function Updatecamisa()
        {

        }
        public function Deletarcamisa()
        {

        }
    }

