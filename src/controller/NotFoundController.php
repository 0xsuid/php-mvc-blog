<?php

namespace Harsh\Blog\Controller;

use Harsh\Blog\Controller\AbstractController;

class NotFoundController extends AbstractController
{
    public function index()
    {
        header("HTTP/1.1 404 Not Found");
        $this->view('404');
    }
}