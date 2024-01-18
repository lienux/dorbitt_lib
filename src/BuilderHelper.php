<?php

namespace Dorbitt;

if (getenv('app.name')=='DORBITT SYSTEM') {
    use App\Helpers\IdentityHelper;
}

use Dorbitt\GlobalHelper;

class BuilderHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();

        if (getenv('app.name')=='DORBITT SYSTEM') {
            $this->identity = new IdentityHelper();
            $this->company_id = $this->identity->company_id();
        }else{
            $this->identity = null;
            $this->company_id = null;
        }

        $this->gHelp = new GlobalHelper();
    }

    public function index()
    {
        $limit      = $this->request->getVar('limit');
        $offset     = $this->request->getVar('offset');
        $sort       = $this->request->getVar('sort');
        $order      = $this->request->getVar('order');
        $search     = $this->request->getVar('search');
        
        if (!$limit OR $limit=='undefined') {
            $limit = 0;
        }else{
            $limit = $limit;
        }

        if (!$offset OR $offset=='undefined') {
            $offset = 0;
        }else{
            $offset = $offset;
        }

        if (!$sort OR $sort=='undefined') {
            $sort = 'id';
        }else{
            $sort = $sort;
        }

        if (!$order OR $order=='undefined') {
            $order = 'desc';
        }else{
            $order = $order;
        }

        return [$limit,$offset,$sort,$order,$search];
    }

    public function create($query,$search_params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');
        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $bydate     = $this->request->getJsonVar('bydate');
        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');

        if ($bydate == 1) {
            if ($from_date) {
                $query = $query->where('created_at >=', $from_date);
            }

            if ($to_date) {
                $query = $query->where('created_at <=', $to_date);
            }
        }

        if ($search) {
            $query = $query->like('id',$search);
            foreach ($search_params as $key => $value) {
                $query = $query->orLike($value,$search);
            }
        }

        if ($sort && $order) {
            $query = $query->orderBy($sort, $order);
        }else{
            $query = $query->orderBy('id', 'desc');
        }

        return $query;
    }

    public function create2($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');
        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $bydate     = $this->request->getJsonVar('bydate');
        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');

        $query          = $params['query'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        $query = $query->where('company_id', $this->company_id);

        if ($id) {

            $query = $query->where('id',$id);

        }else{

            if ($bydate == 1) {
                if ($from_date) {
                    $query = $query->where('created_at >=', $from_date);
                }

                if ($to_date) {
                    $query = $query->where('created_at <=', $to_date);
                }
            }

            if ($search) {
                $query = $query->like('id',$search);
                foreach ($search_params as $key => $value) {
                    $query = $query->orLike($value,$search);
                }
            }

            if ($sort && $order) {
                $query = $query->orderBy($sort, $order);
            }else{
                $query = $query->orderBy('id', 'desc');
            }
        }

        return $query;
    }

    public function create3($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');
        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');

        $query          = $params['query'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        $query = $query->where('company_id', $this->company_id);

        if ($id) {

            $query = $query->where('id',$id);

        }else{

            if ($from_date) {
                $query = $query->where('created_at >=', $from_date);
            }

            if ($to_date) {
                $query = $query->where('created_at <=', $to_date);
            }

            if ($search) {
                $query = $query->like('id',$search);
                foreach ($search_params as $key => $value) {
                    $query = $query->orLike($value,$search);
                }
            }

            if ($sort && $order) {
                $query = $query->orderBy($sort, $order);
            }else{
                $query = $query->orderBy('id', 'desc');
            }
        }

        return $query;
    }

    // filter data dengan company_id
    // semua header data menggunakan terdapat field company_id
    public function forTbHeader($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');
        $date       = $this->request->getJsonVar('date');

        $query          = $params['query'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        // $query->where('company_id', $this->company_id);

        if ($id) {

            $query->where('id',$id);

        }else{

            if ($search) {
                $query->groupStart();
                    $query->like('id',$search);
                    foreach ($search_params as $key => $value) {
                        $query->orLike($value,$search);
                    }
                $query->groupEnd();
            }

            if ($from_date) {
                $query->where('created_at >=', $from_date);
            }

            if ($to_date) {
                $query->where('created_at <=', $to_date);
            }

            if ($date) {
                if ($date->from) {
                    $query->where('created_at >=', $date->from);
                }

                if ($date->to) {
                    $query->where('created_at <=', $date->to);
                }
            }

            $query->where('company_id', $this->company_id);
            $query->where('updated_at', null);

            if ($sort && $order) {
                $query->orderBy($sort, $order);
            }else{
                $query->orderBy('id', 'desc');
            }
        }

        return $query;
    }

    // filter data tanpa company_id
    // data detail biasanya tidak ada fileld company_id
    public function forTbDetail($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');
        $date       = $this->request->getJsonVar('date');

        $query          = $params['query'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if ($id) {

            $query = $query->where('id',$id);

        }else{

            if ($search) {
                $query->groupStart();
                    $query->like('id',$search);
                    foreach ($search_params as $key => $value) {
                        $query->orLike($value,$search);
                    }
                $query->groupEnd();
            }

            if ($from_date) {
                $query = $query->where('created_at >=', $from_date);
            }

            if ($to_date) {
                $query = $query->where('created_at <=', $to_date);
            }

            if ($date) {
                if ($date->from) {
                    $query->where('created_at >=', $date->from);
                }

                if ($date->to) {
                    $query->where('created_at <=', $date->to);
                }
            }

            if ($sort && $order) {
                $query = $query->orderBy($sort, $order);
            }else{
                $query = $query->orderBy('id', 'desc');
            }
        }

        return $query;
    }

    public function conditions($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');
        $date       = $this->request->getJsonVar('date');

        // $date = '10.21.2011';
        // echo date('Y-m-d', strtotime(str_replace('.', '/', $date)));

        $builder        = $params['builder'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        // $builder->like('id',$search);
                        foreach ($search_params as $key => $value) {
                            $builder->orLike($value,$search);
                        }
                    $builder->groupEnd();
                }
            }

            if ($from_date) {
                $builder->where('created_at >=', $this->gHelp->dtfFormatter($from_date));
            }

            if ($to_date) {
                $builder->where('created_at <=', $this->gHelp->dttFormatter($to_date));
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('created_at >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('created_at <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }

        $builder->where('deleted_at', null);

        return $builder;
    }

    public function withJoin($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');
        $date       = $this->request->getJsonVar('date');

        $builder            = $params['builder'];
        $id                 = $params['id'];
        $search_params      = $params['search_params'];

        if (isset($params['company_id'])) {
            if ($params['company_id']) {
                $builder->where('company_id', $this->company_id);
            }
        }

        if ($id) {

            $builder->where('a.id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like('a.id',$search);
                        foreach ($search_params as $key => $value) {
                            $builder->orLike($value,$search);
                        }
                    $builder->groupEnd();
                }
            }

            if ($from_date) {
                $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($from_date));
            }

            if ($to_date) {
                $builder->where('a.created_at <=', $this->gHelp->dttFormatter($to_date));
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('a.created_at <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }
        
        $builder->where('a.deleted_at', null);

        return $builder;
    }

    // filter data dengan company_id adalah table a
    // tanpa orderby
    public function withJoind($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $create_from  = $this->request->getJsonVar('date.from');
        $create_to    = $this->request->getJsonVar('date.to');

        $query          = $params['query'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if ($id) {

            $query->where('a.id',$id);

        }else{

            if ($search) {
                $query->groupStart();
                    $query->like('a.id',$search);
                    foreach ($search_params as $key => $value) {
                        $query->orLike($value,$search);
                    }
                $query->groupEnd();
            }

            if ($create_from) {
                $query->where('a.created_at >=', $create_from);
            }

            if ($create_to) {
                $query->where('a.created_at <=', $create_to);
            }
        }
        
        $query->where('a.deleted_at', null);
        $query->where('a.company_id', $this->company_id);

        return $query;
    }





    /**
     * ================================================
     * FOR HILLCON
     * ================================================
     * */
    public function conditions_hill($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $date       = $this->request->getJsonVar('date');

        $builder        = $params['builder'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        foreach ($search_params as $key => $value) {
                            $builder->orLike($value,$search);
                        }
                    $builder->groupEnd();
                }
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('tanggal >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('tanggal <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }

        return $builder;
    }

    public function withJoin($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');
        $date       = $this->request->getJsonVar('date');

        $builder            = $params['builder'];
        $id                 = $params['id'];
        $search_params      = $params['search_params'];

        if (isset($params['company_id'])) {
            if ($params['company_id']) {
                $builder->where('company_id', $this->company_id);
            }
        }

        if ($id) {

            $builder->where('a.id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like('a.id',$search);
                        foreach ($search_params as $key => $value) {
                            $builder->orLike($value,$search);
                        }
                    $builder->groupEnd();
                }
            }

            if ($from_date) {
                $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($from_date));
            }

            if ($to_date) {
                $builder->where('a.created_at <=', $this->gHelp->dttFormatter($to_date));
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('a.created_at <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }
        
        $builder->where('a.deleted_at', null);

        return $builder;
    }
    /**
     * ================================================
     * END FOR HILLCON
     * ================================================
     * */
}
