<?php

namespace Harsh\Blog\Controller;

use Harsh\Blog\Helper\TemplateEngine;

abstract class AbstractController
{
    protected $templateEngine;

    protected function view(string $view, $parameters = [])
    {
        $this->templateEngine = TemplateEngine::getInstance();
        return $this->templateEngine->display($view.'.html.twig', $parameters);
    }
}
