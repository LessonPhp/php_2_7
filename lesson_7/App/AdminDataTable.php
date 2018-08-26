<?php

namespace App;


class AdminDataTable
{
    protected $functions = [];
    protected $models = [];
    protected $view;

    public function __construct($models, array $functions, ...$args)
    {
        $this->models = $models;
        $this->functions = $functions;
        $this->view = new View();
    }

    public function render()
    {
        $result = [];

        foreach ($this->models as $index => $model) {
            foreach ($this->functions as $key => $function) {
                $result[$index][$key] = $function($model);
            }
        }
        return $result;
    }
}