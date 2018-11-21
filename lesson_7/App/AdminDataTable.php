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

    // исправила
    public function render()
    {
        $result = [];

        foreach ($this->models as $index => $string) {
            foreach ($this->functions as $key => $col) {
                $result[$index][$key] = $col($string);
            }
        }

        $this->view->articles = $result;
        $this->view->display(__DIR__ . '/../admin/templates/index.php');

    }
}