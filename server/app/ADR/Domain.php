<?php

namespace App\ADR;

use Aura\Filter\FilterFactory;
use App\Exceptions\UnprocessableEntityException;

abstract class Domain
{
    protected $model;
    protected $filter;

    public function __construct()
    {
        $this->setModel();
    }

    abstract protected function setRules();
    abstract protected function setModel();

    public function create()
    {
        $data = $this->getBodyData();

        $this->validation($data);

        return $this->model->create($data);
    }

    public function update($id)
    {
        $page = $this->model->findOrFail($id);

        $data = $this->getBodyData();

        $this->validation($data);

        return $page->update($data);
    }

    public function getBodyData()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT) ?? [];

        parse_str(file_get_contents("php://input"), $put_vars);
        $put_vars = filter_var_array($put_vars, FILTER_DEFAULT) ?? [];

        $data = array_merge($data, $put_vars);

        return $data;
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
        $this->filter = $filter_factory->newSubjectFilter();

        $this->setRules();

        if (!$this->filter->apply($data)) {
            $messages = $this->filter->getFailures()
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
