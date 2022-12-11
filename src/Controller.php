<?php

namespace Base;

abstract class Controller
{
    protected $view;

    public function setView(View $view): void
    {
        $this->view = $view;
    }

}