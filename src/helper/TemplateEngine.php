<?php

namespace Harsh\Blog\Helper;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateEngine
{
    private static $templateInstance = null;
    private static $fileSystemLoader = null;
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        // Check if template instance is null
        if (self::$templateInstance == null) {
            try {
                $templateDir = __DIR__ . './../view';
                self::$fileSystemLoader = new FilesystemLoader($templateDir);

                self::$templateInstance = new Environment(self::$fileSystemLoader, [
                    'cache' => __DIR__ .'./../../cache/twig',
                    'debug' => true
                ]);
                self::$templateInstance->addGlobal('session', $_SESSION);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return self::$templateInstance;
    }
}
