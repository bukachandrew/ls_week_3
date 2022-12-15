<?php

namespace Base;

use Base\Interface\View as ViewInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigView implements ViewInterface
{
    private $templatePath;

    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function render($tpl, $data = [])
    {
        $loader = new FilesystemLoader($this->templatePath);
        $twig = new Environment($loader);
        return $twig->render(DIRECTORY_SEPARATOR . $tpl, $data);
    }
}