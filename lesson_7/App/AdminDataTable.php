<?php

namespace App;


class AdminDataTable
{
    protected $functions = [];
    protected $models = [];

    public function __construct($models, array $functions, ...$args)
    {
        $this->models = $models;
        $this->functions = $functions;
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