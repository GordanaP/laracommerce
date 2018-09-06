<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $builder;

    protected $filters = [];

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach($this->getFilters() as $filter => $value)
        {
            if(method_exists($this, $filter))
            {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return array_filter(request()->only($this->filters));
    }
}