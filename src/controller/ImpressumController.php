<?php

namespace Harsh\Blog\Controller;

use Harsh\Blog\Controller\AbstractController;

class ImpressumController extends AbstractController
{
    public function index()
    {
        $this->view('impressum');
    }
}