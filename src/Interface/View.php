<?php

namespace Base\Interface;

interface View
{
    public function render($tpl, $data = []);
}