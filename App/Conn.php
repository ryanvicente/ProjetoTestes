<?php
    namespace App;
    use PDO;
    use PDOException;

    class Conn
    {
        private string $host = '127.0.0.1';
        private string $user = 'root';
        private string $pass = '637554928957';
        private string $dbname = 'trabbd';
        protected PDO $pdo;
        
        public function conectar()
        {
            try
            {
                //$mysqli = new mysqli($host,$user,$pass,$dbname);
                $this->pdo = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->pass);
                //report erros do tipo Exception
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->exec("SET NAMES utf8");
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch(PDOException $e)
            {
                echo("Erro: ".$e->getMessage());
                //throw new PDOException($e);
            }
            return $this->pdo;
        }

    }