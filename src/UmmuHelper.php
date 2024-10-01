<?php

namespace Dorbitt;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

class UmmuHelper
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
        $sort = $this->request->getVar('sort');
        $order = $this->request->getVar('order');
        
        if (isset($order['name'])) {
            $sort = $order['name'];
        }else{
            if (!$sort OR $sort=='undefined') {
                $sort = 0;
            }else{
                $sort = $sort;
            }
        }

        return $sort;
    }

    public function order()
    {
        $order = $this->request->getVar('order');

        if (isset($order['dir'])) {
            $order = $order['dir'];
        }else{
            if (!$order OR $order=='undefined') {
                $order = 0;
            }else{
                $order = $order;
            }
        }

        return $order;
    }

    public function search()
    {
        $search     = $this->request->getVar('search');

        if (isset($search['value'])) {
            $search = $search['value'];
        }

        return $search;
    }

    public function dt_payload()
    {
        // $limit = $this->request->getVar('limit');
        $length = $this->request->getVar('length');
        if ($length == '-1') {
            $length = 0;
        }
        // $offset = $this->request->getVar('offset');
        $start = $this->request->getVar('start');
        $order = $this->request->getVar('order');
        $search = $this->request->getVar('search');

        $payload = [
            "limit"     => $length,
            "offset"    => $start,
            "sort"      => $order[0]['name'],
            "order"     => $order[0]['dir'],
            "search"    => $search['value']
        ];

        return $payload;
    }

    public function dt_payload2()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        if ($length == '-1') {
            $length = 0;
        }

        $start = $this->request->getVar('start');
        $columns = $this->request->getVar('columns');
        $order = $this->request->getVar('order');
        if ($order) {
            $column = $order[0]['column'];
            if ($draw == 1) {
                $sort = 'id';
                $order = 'desc';
            }else{
                $sort = $columns[$column]['data'];
                $order = $order[0]['dir'];
            }
        }else{
            $sort = 'id';
            $order = 'desc';
        }

        $search = $this->request->getVar('search');
        if ($search) {
            $search = $search['value'];
        }else{
            $search = "";
        }

        $payload = [
            "limit"     => $length,
            "offset"    => $start,
            "sort"      => $sort,
            "order"     => $order,
            "search"    => $search
        ];

        return $payload;
    }

    public function dt_payload3()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        if ($length == '-1') {
            $length = 0;
        }

        $orderVar = $this->request->getVar('order');
        if ($orderVar) {
            $column = $orderVar[0]['column'];
            $order = $orderVar[0]['dir'];
        }else{
            $order = 'desc';
        }

        $columns = $this->request->getVar('columns');
        if ($columns) {
            $sort = $columns[$column]['data'];
        }else{
            $sort = 'id';
        }

        if ($draw == 1) {
            $sort = 'id';
            $order = 'desc';
        }else{
            $sort = $sort;
            $order = $order;
        }

        $searchVar = $this->request->getVar('search');
        if ($searchVar) {
            $search = $searchVar['value'];
        }else{
            $search = "";
        }

        $payload = [
            "limit"     => $length,
            "offset"    => $start,
            "sort"      => $sort,
            "order"     => $order,
            "search"    => $search
        ];

        return $payload;
    }

    public function dt_payload4()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        if ($length == '-1') {
            $length = 0;
        }

        $orderVar = $this->request->getVar('order');
        if ($orderVar) {
            $column = $orderVar[0]['column'];
            $order = $orderVar[0]['dir'];
        }else{
            $order = 'desc';
        }

        $columns = $this->request->getVar('columns');
        if ($columns) {
            if (isset($column)) {
                $sort = $columns[$column]['data'];
            }else{
                $sort = 'id';
            }
        }else{
            $sort = 'id';
        }

        if ($draw == 1) {
            $sort = 'id';
            $order = 'desc';
        }else{
            $sort = $sort;
            $order = $order;
        }

        $searchVar = $this->request->getVar('search');
        if ($searchVar) {
            $search = $searchVar['value'];
        }else{
            $search = "";
        }

        $payload = [
            "limit"     => $length,
            "offset"    => $start,
            "sort"      => $sort,
            "order"     => $order,
            "search"    => $search
        ];

        return $payload;
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

    public function orderBy($builder, $allowedFields = null)
    {
        $sort = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            $sort = explode(".",$sort);
            $sortCount = count($sort);
            $sort = $sort[$sortCount-1];
        }
        $order      = $this->request->getJsonVar('order');

        if ($sort && $order) {
            if ($allowedFields) {
                if (in_array($sort, $allowedFields)) {
                    $builder = $builder->orderBy($sort, $order);
                }
            }
        }else{
            if ($allowedFields) {
                if (in_array("id", $allowedFields)) {
                    $builder = $builder->orderBy('id', 'desc');
                }
            }
        }

        return $builder;
    }

    public function orderBy_j($builder, $allowedFields = null)
    {
        $sort = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            $sort = explode(".",$sort);
            $sortCount = count($sort);
            $sort = $sort[$sortCount-1];
        }
        $order      = $this->request->getJsonVar('order');

        if ($sort && $order) {
            if ($allowedFields) {
                if (in_array($sort, $allowedFields)) {
                    $builder = $builder->orderBy('a.'.$sort, $order);
                }
            }
        }else{
            if ($allowedFields) {
                if (in_array("id", $allowedFields)) {
                    $builder = $builder->orderBy('a.id', 'desc');
                }
            }
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
                    $contain = strpos(strtoupper($value[$value2]), strtoupper($search));
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

    public function array_search_dt($array, $params)
    {
        $search = $this->request->getVar('search');

        if ($search) {
            // $search = $search['value'];
            $rows = [];
            foreach ($array as $key => $value) {

                foreach ($params as $key2 => $value2) {
                    $contain = strpos(strtoupper($value[$value2]), strtoupper($search));
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
            "status"            => true,
            "message"           => $msg,
            "rows"              => $rows,
            "count"             => $count,
            "total"             => $total,
            "recordsTotal"      => $total,
            "recordsFiltered"   => $total,
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

    public function install_link($mode)
    {
        if (is_link(FCPATH."uploads")) {
            exec("rm -rf ".FCPATH."uploads");
        }

        if (is_link(FCPATH."vendor/dorbitt-lib")) {
            exec("rm -rf ".FCPATH."vendor/dorbitt-lib");
        }

        if (is_link(APPPATH."Gviews")) {
            exec("rm -rf ".APPPATH."Gviews");
        }

        if ($mode == 'dev') {
            exec("ln -s ".WRITEPATH."uploads"." ".FCPATH);
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gasset"." ".FCPATH."vendor/dorbitt-lib");
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gasset"." ".FCPATH."Gasset");
            exec("ln -s /var/www/html/dorbitt/dorbitt_lib/src/Gviews"." ".APPPATH."Gviews");
        }else{
            exec("ln -s ".WRITEPATH."uploads"." ".FCPATH);
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gasset"." ".FCPATH."vendor/dorbitt-lib");
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gasset"." ".FCPATH."Gasset");
            exec("sudo ln -s ".ROOTPATH."vendor/dorbitt/lib/src/Gviews"." ".APPPATH."Gviews");
        }
    }
}
