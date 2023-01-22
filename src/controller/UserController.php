<?php

namespace Harsh\Blog\Controller;

use Harsh\Blog\Model\User;
use Harsh\Blog\Controller\AbstractController;

class UserController extends AbstractController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register()
    {
        $data = [
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize User input
            $data = [
                'username' => htmlspecialchars($_POST['username']),
                'password' => htmlspecialchars($_POST['password']),
            ];

            // Make sure that errors are empty
            if (!empty($data['username']) && !empty($data['password'])) {

                // Hash password with BCrypt
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

                //Register user from model function
                if ($this->user->register($data)) {
                    //Redirect to the login page
                    header('location: /login');
                    die();
                } else {
                    $data['passwordError'] = 'Error occured while inserting data into db';
                }
            }
        }

        $this->view('register', ['data' => $data]);
    }

    public function createSession($id, $username){
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        // Redirect
        header('location: /');
        die();
    }

    public function login() {
        $data = [
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize user input
            $data = [
                'username' => preg_replace('/[^A-Za-z0-9]/', '', $_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];

            // Check username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            // Check password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            // Check for errors
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $user = $this->user->login($data['username'], $data['password']);

                if ($user) {
                    $this->createSession($user['id'], $user['username']);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                }
            }

        } 

        $this->view('login', ['data' => $data]);
    }

    public function logout() {
        session_destroy();
        header('location: /login');
        die();
    }
}