<?php
    namespace App;
    use PDO;
    use PDOException;

    class Conn
    {
        private $host = "127.0.0.1";
        private $user = "root";
        private $pass = null;
        private $dbname = "projetotestes";
        protected $pdo = false;
        
        public function conectar()
        {
            try
            {
                $this->pdo = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->pass);
                //report erros do tipo Exception
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->exec("SET NAMES utf8");
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch(PDOException $e)
            {
                echo("Erro: ".$e->get_Message());
            }
            return $this->pdo;
        }

    }