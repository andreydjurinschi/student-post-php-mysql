<?php

namespace config;

use PDOException;

/***
 * class that provides connection to db
 */
class DatabaseConnector
{
    private $serverName;
    private $username;
    private $password;
    private $connection;

    /***
     * Constructor that initialize an oblect of class DatabaseConnector
     *
     * @param $serverName - host name
     * @param $username - user name
     * @param $password - user pass
     */
    public function __construct($serverName, $username, $password){
        $this->serverName = $serverName;
        $this->username = $username;
        $this->password = $password;
    }

    /***
     * A function that provides an connection to db
     *
     */
    public function createConnection(): void
    {
        try{
            $this->connection = new \PDO("mysql:host=$this->serverName;dbname=school_db", $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function getConnection(){
        return$this->connection;
    }

}