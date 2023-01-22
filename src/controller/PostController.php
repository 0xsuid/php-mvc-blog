<?php

namespace Harsh\Blog\Controller;

use Harsh\Blog\Model\Post;
use Harsh\Blog\Controller\AbstractController;

class PostController extends AbstractController
{
    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function index() {
        $posts = $this->post->findAllPosts();

        $this->view('home', ['posts' => $posts]);
    }

    public function single() {
        $postId = (int)$_GET['id'];
        $post = $this->post->findOne($postId);

        if($post){
            $this->view('single', ['post' => $post ]);
        }else{
            header("Location: /");
            die();
        }
        
    }

    public function createPost() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: /");
            die();
        }

        $data = [
            'title' => '',
            'link' => '',
            'description' => '',
            'titleError' => '',
            'linkError' => '',
            'descriptionError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'userid' => $_SESSION['user_id'],
                'title' => htmlspecialchars($_POST['title']),
                'link' => filter_var($_POST['link'], FILTER_VALIDATE_URL),
                'description' => htmlspecialchars($_POST['description']),
                'titleError' => '',
                'descriptionError' => ''
            ];

            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if(empty($data['description'])) {
                $data['descriptionError'] = 'The body of a post cannot be empty';
            }

            if($data['link'] == false){
                $data['linkError'] = "Invalid URL";
            }

            if (empty($data['titleError']) && empty($data['descriptionError']) && empty($data['linkError'])) {
                if ($this->post->createPost($data)) {
                    header("Location: /");
                    die();
                } else {
                    $data['descriptionError'] = 'Error occured while inserting data into db';
                }
            }
        }

        $this->view('createPost', ['data' => $data]);
    }
}