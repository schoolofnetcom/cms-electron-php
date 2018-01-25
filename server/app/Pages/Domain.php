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

    public function update($id)
    {
        $page = $this->model->findOrFail($id);

        parse_str(file_get_contents("php://input"), $put_vars);
        $data = [
            'title' => filter_var($put_vars['title'] ?? null),
            'slug' => filter_var($put_vars['slug'] ?? null),
            'body' => filter_var($put_vars['body'] ?? null),
        ];

        $this->validation($data);

        return $page->update($data);
    }

    public function delete($id)
    {
        $page = $this->model->findOrFail($id);

        return $page->delete();
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

        $filter->validate('title')->is('string');
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
