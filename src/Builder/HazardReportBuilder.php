<?php

namespace Dorbitt\Builder;

use Dorbitt\Helpers\Curl;
use Dorbitt\Helpers\UmmuHelper;
// use Dorbitt\UmmuEmployeeSalary;
use Dorbitt\UmmuHazardReport;
use Dorbitt\UmmuHazardReportAchievement;
use Dorbitt\Helpers\GlobalHelper as UmmuGlobalHelper;

use App\Helpers\CurlHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\HerpHelper;

class HazardReportBuilder
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->curl = new Curl();
        $this->cH = new CurlHelper();
        $this->ummu = new UmmuHazardReport();
        $this->hzrAchiev = new UmmuHazardReportAchievement();
        $this->umHelp = new UmmuHelper();
        $this->umgHelp = new UmmuGlobalHelper();
        $this->gHelp = new GlobalHelper();
        $this->herpH = new HerpHelper();
    }

    public function show($id)
    {
        if ($this->gHelp->tmp() == 'shakti_admin') {
            $release = [1];
        } else {
            $release = $this->request->getVar("release");
        }

        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "sort" => "created_at",
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "release" => $release,
            // "where" => ["nikaryawan" => "10230070"]
        ]);

        $params = [
            "id" => $id,
            "payload" => $payload,
            "token" => session()->get('token')
        ];

        $response = $this->ummu->show($params);
        return $response;
        // return $params;
    }

    public function create($body)
    {
        $params = [
            "payload" => $body,
            "token" => session()->get("token")
        ];

        return $this->ummu->insert($params);
    }

    public function update($id, $body)
    {
        $params = [
            "id" => $id,
            "payload" => $body,
            "token" => session()->get("token")
        ];

        return $this->ummu->update($params);
    }

    public function import()
    {
        $params = [
            "token" => session()->get('token')
        ];

        $res = $this->ummu->import($params);

        return $res;
    }

    public function show_payslip_periode()
    {
        $payload = [
            "date" => [
                "from" => "",
                "to" => ""
            ]
        ];

        $params = [
            "id" => null,
            "payload" => $payload,
            "token" => session()->get('token')
        ];

        $response = $this->ummu->show_payslip_periode($params);

        return $response;
    }

    public function delete($id, $body)
    {
        $params = [
            "id" => $id,
            "payload" => $body,
            "token" => session()->get('token')
        ];

        $response = $this->ummu->delete($params);

        return $response;
    }

    public function update_release($body)
    {
        $params = [
            "payload" => $body,
            "token" => session()->get("token")
        ];

        return $this->ummu->update_release($params);
    }

    public function she_hazard_report_achievement_show()
    {
        // if ($this->gHelp->tmp() == 'shakti_admin') {
        //     $release = [1];
        // } else {
        //     $release = $this->request->getVar("release");
        // }
        /* $date_from = $this->request->getVar("date_from");
        if ($date_from) {
            $date_from = $date_from;
        } else {
            $date_from = date('Y-m') . "-01";
        }
        $datetime_from = $date_from . " 00:00:01"; */
        $date_from = $this->request->getVar("date_from");
        $time_from = $this->request->getVar("time_from");
        $date_to = $this->request->getVar("date_to");
        $time_to = $this->request->getVar("time_to");

        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "datetime_detail" => [
                "from" => $date_from,
                "to" => $date_to
            ],
            "release" => 1
        ]);

        $params = [
            "id" => null,
            "payload" => $payload,
            "token" => session()->get('token')
        ];

        $response = $this->hzrAchiev->show($params);
        return $response;
        // return $params;
    }

    public function she_hazard_report_achievement_show_by_nik($nik)
    {
        $date_from = $this->request->getVar("date_from");
        $time_from = $this->request->getVar("time_from");
        $date_to = $this->request->getVar("date_to");
        $time_to = $this->request->getVar("time_to");

        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "datetime_detail" => [
                "from" => $date_from,
                "to" => $date_to
            ],
            "release" => 2,
            "nika" => $nik,
            "where_by" => ['nika']
        ]);

        $params = [
            "id" => null,
            "payload" => $payload,
            "token" => session()->get('token')
        ];

        $response = $this->hzrAchiev->show($params);
        return $response;
    }

    public function show_employee_by_nik($nik)
    {

    }

    public function insert_queue_mail($document_id)
    {
        // $body = $this->request->getJsonVar('body');
        // $body = (array) $body;
        // $body = array_merge($body, ["user" => session()->get('username')]);
        $body = [
            "document_id" => $document_id
        ];

        $params = [
            "url" => $this->herpH->url() . 'safety/hazard_report/queue_mail/create',
            "method" => 'POST',
            "payload" => $body,
            "headers" => $this->herpH->headers()
        ];

        $builder = $this->curl->ummu($params);

        return $builder;
    }

    public function number()
    {
        $payload = [
            "site" => session()->get('kode_site'),
            "nik" => session()->get('nika')
        ];

        $params = [
            "url" => $this->cH->url() . 'safety/hazard_report/number_document',
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers()
        ];
        $builder = $this->curl->ummu($params);

        return $builder;
    }

    public function used_number($doc_number)
    {
        $params = [
            "url" => $this->cH->url() . 'safety/hazard_report/used_number/' . $doc_number,
            "method" => 'PUT',
            "payload" => [],
            "headers" => $this->cH->headers()
        ];
        $builder = $this->curl->ummu($params);

        return $builder;
    }

    public function show_info($code)
    {
        // return [$code];
        if ($this->gHelp->tmp() == 'shakti_admin') {
            $release = [1];
        } else {
            $release = $this->request->getVar("release");
        }

        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "release" => $release,
            "nomor_dokumen" => $code,
            // "where" => ["nikaryawan" => "10230070"]
        ]);

        $params = [
            "id" => null,
            "payload" => $payload,
            "token" => session()->get('token')
        ];

        $response = $this->ummu->show($params);
        return $response;
        // return $params;
    }
}