<?php

namespace Harsh\Blog\Model;

use Harsh\Blog\Helper\Database;

class Post
{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    public function createPost($data) {
        $this->db->setquery('INSERT INTO posts (userid, title, link, description) VALUES (:userid, :title, :link, :description)');

        $this->db->bindValue(':userid', $data['userid'], 'int');
        $this->db->bindValue(':title', $data['title'], 'string');
        $this->db->bindValue(':link', $data['link'], 'string');
        $this->db->bindValue(':description', $data['description'], 'string');

        return $this->db->execute() ? true : false;
    }

    public function findAllPosts() {
        $this->db->setquery('SELECT id, userid, title, link, SUBSTRING(description, 1, 1000) AS description FROM posts');

        $posts = $this->db->getAll();

        return $posts;
    }

    public function findOne($id) {
        $this->db->setquery('SELECT * FROM posts WHERE id = :id');

        $this->db->bindValue(':id', $id, 'int');

        $post = $this->db->getOne();

        return $post;
    }
}
