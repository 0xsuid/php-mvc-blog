<?php

namespace Harsh\Blog\Model;

use Harsh\Blog\Helper\Database;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->setQuery('INSERT INTO users (username, password) VALUES(:username, :password)');

        // Bind values
        $this->db->bindValue(':username', $data['username'], 'string');
        $this->db->bindValue(':password', $data['password'], 'string');

        // Execute function
        return $this->db->execute() ? true : false;
    }

    public function login($username, $password)
    {

        $this->db->setQuery('SELECT * FROM users WHERE username = :username');

        // Bind value
        $this->db->bindValue(':username', $username, 'string');

        $result = $this->db->getOne();

        // Check for invalid username
        if(!$result){
            return false;
        }

        $hash = $result['password'];
        var_dump($hash);

        return password_verify($password, $hash) ? $result : false;
    }
}
