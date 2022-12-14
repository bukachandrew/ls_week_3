<?php

namespace Base;

use Base\Interface\View as ViewInterface;

class View implements ViewInterface
{
    private $templatePath;

    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function render($tpl, $data = [])
    {
        extract($data);
        ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        return ob_get_clean();
    }
}