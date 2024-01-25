<?php

namespace Dorbitt;

class QueryHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    public function limit()
    {
        $limit      = $this->request->getVar('limit');
        
        if (!$limit OR $limit=='undefined') {
            $limit = 0;
        }else{
            $limit = $limit;
        }

        return $limit;
    }

    public function offset()
    {
        $offset     = $this->request->getVar('offset');
        
        if (!$offset OR $offset=='undefined' OR $this->search()) {
            $offset = 0;
        }else{
            $offset = $offset;
        }

        return $offset;
    }

    public function sort()
    {
        $sort     = $this->request->getVar('sort');
        
        if (!$sort OR $sort=='undefined') {
            $sort = 0;
        }else{
            $sort = $sort;
        }

        return $sort;
    }

    public function order()
    {
        $order     = $this->request->getVar('order');
        
        if (!$order OR $order=='undefined') {
            $order = 0;
        }else{
            $order = $order;
        }

        return $order;
    }

    public function search()
    {
        $search     = $this->request->getVar('search');

        return $search;
    }

    public function totalcount($query)
    {
        $total = $query->countAllResults(false);
        $builder = $query->findAll($this->limit(), $this->offset());
        $count = count($builder);

        $response = [
            "rows"          => $builder,
            "total"         => $total,
            "count"         => $count,
        ];

        return $response;
    }

    public function _total($builder)
    {
        $total = $builder->countAllResults(false);        
        return $total;
    }

    public function _limit($builder)
    {
        $limit = $builder->limit($this->limit(), $this->offset());
        return $limit;
    }

    public function _rows($builder)
    {
        $rows = $builder->findAll($this->limit(), $this->offset());
        return $rows;
    }

    public function _rowsBui($builder)
    {
        $rows = $builder->limit($this->limit(), $this->offset())
        ->get()->getResult();
        return $rows;
    }

    // untuk menjumlahkan rows data
    public function _count($rows)
    {
        $count = count($rows);
        return $count;
    }

    public function orderBy($builder)
    {
        $sort       = $this->request->getJsonVar('sort');
        if (strpos($sort, ".")) {
            $sort = explode(".",$sort);
            $sortCount = count($sort);
            $sort = $sort[$sortCount-1];
        }
        $order      = $this->request->getJsonVar('order');

        if ($sort && $order) {
            $builder = $builder->orderBy($sort, $order);
        }else{
            $builder = $builder->orderBy('id', 'desc');
        }

        return $builder;
    }

    // untuk membuat list select otomatis saat join table
    public function select_j($fields, $alias)
    {
        $fsl = [];
        foreach ($fields as $key => $value) {
            $fsl[] = $alias.'.'.$value;
        }

        return implode(", ",$fsl);
    }

    public function array_where($array, $field, $val)
    {
        $rows = [];
        foreach ($array as $key => $value) {

            if ($value[$field] == $val) {
                $rows[] = $value;
            }
        }

        return $rows;
    }

    public function array_search($array, $params)
    {
        $search = $this->request->getJsonVar('search');

        if ($search) {

            $rows = [];
            foreach ($array as $key => $value) {

                foreach ($params as $key2 => $value2) {
                    // $contain = str_contains($value[$value2], $search);
                    $contain = strpos($value[$value2], $search);
                    if ($contain !== false) {
                        $rows[] = $value;
                    }
                }
            }

        }else{

            $rows = $array;

        }

        return $rows;
    }

    public function array_paging($array)
    {
        $limit = $this->request->getJsonVar('limit');
        $offset = $this->request->getJsonVar('offset');
        $search = $this->request->getJsonVar('search');

        if ($search) {
            $offset = 0;
        }

        if ($limit == 0 OR $limit == 'undefined') {
            $rows = $array;
        }else{
            $rows = array_slice($array, $offset, $limit);
        }

        $response = [
            "rows"      => $rows, 
            "count"     => count($rows),
            "total"     => count($array)
        ];

        return $response;
    }

    public function response_true($rows,$count,$total)
    {
        $response = [
            "status"    => true,
            "message"   => 'Get data success',
            "rows"      => $rows,
            "count"     => $count,
            "total"     => $total
        ];

        return $response;
    }

    public function response_false()
    {
        $response = [
            "status"    => false,
            "message"   => 'Data not found.',
            "rows"      => [],
        ];

        return $response;
    }

    public function restrue($rows,$count,$total)
    {
        if ($count == 0) {
            $msg = 'Data not found';
        }else{
            $msg = 'Get data success';
        }

        $response = [
            "status"    => true,
            "message"   => $msg,
            "rows"      => $rows,
            "count"     => $count,
            "total"     => $total
        ];

        return $response;
    }

    public function resfalse($builder)
    {
        $response = [
            "status"    => false,
            "message"   => $builder,
        ];

        return $response;
    }
}
