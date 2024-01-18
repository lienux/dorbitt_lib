<?php

namespace Dorbitt;

class QueryHelper
{
    public function __construct()
    {
        // 
    }

    public function where($builder)
    {
        $builder->where('deleted_at', null);

        return $builder;
    }
}
