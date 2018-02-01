<?php

namespace App\Posts;

use App\ADR\Domain as BaseDomain;

class Domain extends BaseDomain
{
    protected function setRules()
    {
        $this->filter->validate('title')->is('string');
        $this->filter->validate('title')->isNot('int');
        $this->filter->validate('title')->is('strlenMin', 3);

        $this->filter->validate('body')->isNotBlank();
        $this->filter->validate('body')->is('strlenMin', 10);
    }

    protected function setModel()
    {
        $this->model = new Model;
    }
}
