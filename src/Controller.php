<?php

namespace Base;

use Base\Interface\View as ViewInterface;

abstract class Controller
{
    protected $view;

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

}