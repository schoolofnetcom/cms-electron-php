<?php

namespace App\Pages;

use Aura\Filter\FilterFactory;
use App\Exceptions\UnprocessableEntityException;

class Domain
{
    private $model;

    public function __construct()
    {
        $this->model = new Model;
    }

    public function create()
    {
        $data = [
            'title' => filter_input(INPUT_POST, 'title'),
            'slug' => filter_input(INPUT_POST, 'slug'),
            'body' => filter_input(INPUT_POST, 'body'),
        ];

        $this->validation($data);

        return $this->model->create($data);
    }

    protected function validation($data)
    {
        $isValid = $this->validate($data);

        if ($isValid['status'] === 'error') {
            throw new UnprocessableEntityException(json_encode($isValid['messages']));
        }
    }

    private function validate($data)
    {
        $filter_factory = new FilterFactory;
        $filter = $filter_factory->newSubjectFilter();

        $filter->validate('title')->is('alnum');
        $filter->validate('title')->isNot('int');
        $filter->validate('title')->is('strlenMin', 3);

        $filter->validate('body')->isNotBlank();
        $filter->validate('body')->is('strlenMin', 10);

        if (!$filter->apply($data)) {
            $messages = $filter->getFailures()
                ->getMessages();

            return [
                'status' => 'error',
                'messages' => $messages
            ];
        }
        return ['status' => 'success'];
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->model, $name], $arguments);
    }
}
