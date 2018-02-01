<?php

namespace App\Users;

use App\ADR\Domain as BaseDomain;

class Domain extends BaseDomain
{
    protected function setRules()
    {
        $this->filter->validate('name')->is('strlenMin', 3);
        $this->filter->validate('name')->isNotBlank();

        $this->filter->validate('email')->is('email');
        $this->filter->validate('email')->isNotBlank();
    }

    protected function setModel()
    {
        $this->model = new Model;
    }
}
