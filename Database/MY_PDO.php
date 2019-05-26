<?php

    //We are safely storing the PDO information (password etc) in the config files
    require_once 'PDO_config.php';

    //Create a PDO Class that will handle the DB instance
    class MY_PDO
    {
        protected $pdo;
        private static $instance;

        protected function __construct()
        {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
            try {
                $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $pdo_options);
            } catch (PDOException $exception) {
                echo 'Connection error: ' . $exception->getMessage();
            }

        }

        //Singleton Design Pattern
        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        // a proxy to native PDO methods
        public function __call($method, $args)
        {
            return call_user_func_array(array($this->pdo, $method), $args);
        }

        // a helper function to run prepared statements smoothly
        /**
         * @param $sql
         * @param array $args
         * @return bool|PDOStatement
         */
        public function run($sql, $args = [])
        {

            if (!$args)
            {
                return $this->pdo->query($sql);
            }
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }


    }