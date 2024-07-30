<?php

class Database
{
    protected $db;

    private $dbName = 'itranning';
    private $dbHost = 'ec2-54-233-182-62.sa-east-1.compute.amazonaws.com';
    private $dbUser = 'thiago';
    private $dbPass = 'Thg@2019';

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName . "", $this->dbUser, $this->dbPass);
            $this->db->setattribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->db->exec("set names utf8");
        } catch (PDOException $erro) {
            echo "Erro : " . $erro->getMessage();
            exit;
        }
    }
}
