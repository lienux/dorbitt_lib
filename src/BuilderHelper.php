<?php

namespace Dorbitt;

use Dorbitt\GlobalHelper;

class BuilderHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->gHelp = new GlobalHelper();
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

            if ($search AND $search_params) {
                // if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
                        }
                    $builder->groupEnd();
                // }
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
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('a.company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('a.id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
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
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
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

    public function withJoin_hill($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');
        $date       = $this->request->getJsonVar('date');

        $builder            = $params['builder'];
        $id                 = $params['id'];
        $search_params      = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('a.company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('a.id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
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
        
        return $builder;
    }
    /**
     * ================================================
     * END FOR HILLCON
     * ================================================
     * */
}