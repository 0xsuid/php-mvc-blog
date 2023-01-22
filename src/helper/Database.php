<?php

namespace Harsh\Blog\Helper;

use PDO;

class Database
{
    private $statement;
    private $dbHandler;

    public function __construct()
    {
        $this->dbHandler = DatabaseConnection::getInstance();
    }

    public function bindValue($parameter, $value, $type)
    {
        $types = [
            'string' => PDO::PARAM_STR,
            'int' => PDO::PARAM_INT,
            'boolean' => PDO::PARAM_BOOL,
        ];
        $this->statement->bindValue($parameter, $value, $types[$type]);
    }

    public function setQuery($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    /**
     * Execute the prepared statement
     * @return bool
     */
    public function execute()
    {
        return $this->statement->execute();
    }

    /**
     * Get All Results
     * @return array
     */
    public function getAll()
    {
        $this->execute();
        return $this->statement->fetchAll();
    }

    /**
     * Get single Result
     * @return object
     */
    public function getOne()
    {
        $this->execute();
        return $this->statement->fetch();
    }
}
