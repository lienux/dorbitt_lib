<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
// use \Config\DorbitT;
use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\ViewsHelper;

class DashboardController extends ResourceController
{
    public function __construct()
    {
        // $this->syshab = \Config\Database::connect('syshab');
        // $this->dorbitt = new DorbitT();
        $this->request = \Config\Services::request();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Dashboard',
            'navlink' => 'dashboard',
            'breadcrumb' => ['Inventory', 'User Request', 'Index'],
            'breadcrumb_active' => ['active', ''],
            'group' => null,
            'tmp' => $this->gHelp->tmp()
        ];

        return view('pages/dashboard/index', $data);
    }

    private function find_po_full_approve()
    {
        // Ambil Transaksi PO yang sudah full Approve
        $query = $this->poHelper->po_full_approve();
        $query = json_decode($query);

        if ($query) {
            $po_code = $query[0]->po_code;
            $printed = $query[0]->Printed;
            $unit_code = $query[0]->unit_code;

            if ($unit_code) {
                return json_decode($this->poHelper->show_po_002($po_code, $printed));
            } else {
                return json_decode($this->poHelper->show_po_001($po_code, $printed));
            }
        }
    }

    public function find_a()
    {
        // Ambil Transaksi PO yang sudah full Approve
        $query = $this->poHelper->po_full_approve();
        $query = json_decode($query);

        if ($query) {
            $po_code = $query[0]->po_code;
            $printed = $query[0]->Printed;
            $unit_code = $query[0]->unit_code;

            if ($unit_code) {
                $response = [
                    "po_type" => "PO002",
                    "rows" => json_decode($this->poHelper->show_po_002($po_code, $printed))
                ];
            } else {
                $response = [
                    "po_type" => "PO001",
                    "rows" => json_decode($this->poHelper->show_po_001($po_code, $printed))
                ];
            }
        } else {
            $response = "PO not found.";
        }

        return $this->respond($response, 200);
    }

    public function service()
    {
        $po_full_approve = $this->poHelper->po_full_approve();
        $po_full_approve = json_decode($po_full_approve);
        $data = $po_full_approve;

        if ($data) {
            $po_code = $data[0]->po_code;
            $printed = $data[0]->Printed;
            $unit_code = $data[0]->unit_code;
            // $this->poHelper->update_po_tsendEmail($po_code,2);

            if ($unit_code) {
                $response = $this->run_po_002($po_code, $printed);
            } else {
                $response = $this->run_po_001_a($po_code, $printed);
            }
        } else {
            $response = "Tidak ada PO yang siap dikirim via email";
        }

        return $this->respond($response, 200);
    }

    public function run_find_po_full_approve()
    {
        $po_full_approve = $this->poHelper->po_full_approve();
        $po_full_approve = json_decode($po_full_approve);
        $data = $po_full_approve;

        if ($data) {
            $po_code = $data[0]->po_code;
            $printed = $data[0]->Printed;
            $unit_code = $data[0]->unit_code;

            if ($unit_code) {
                $response = $this->run_po_002($po_code, $printed);
            } else {
                $response = $this->run_po_001($po_code, $printed);
            }
        } else {
            $response = "Tidak ada PO yang siap dikirim via email";
        }

        return $this->respond($response, 200);
    }

    private function run_po_001($po_code, $printed)
    {
        $createPDF = $this->poHelper->create_pdf_001($po_code, $printed);
        $dir = $createPDF['dir'];
        $file_name = $createPDF['file_name'];

        $data = [
            "po_code" => $po_code,
            "dir" => $dir,
            "file_name" => $file_name
        ];

        $send_po = $this->mailHelper->send($data);
        if ($send_po) {
            $send_res = json_encode($send_po);
        } else {
            $send_res = "Send mail success";
        }

        $response = [
            "create_pdf" => $createPDF,
            "send_mail" => $send_res
        ];

        // Create Logs
        $fp = fopen('logs/run_po_001_' . date("Y-m-d") . '.html', 'a');
        fwrite($fp, "<p>" . date("Y-m-d H:i:s") . "<br>" . "\n");
        fwrite($fp, json_encode($createPDF) . "<br>" . "\n");
        fwrite($fp, $send_res . "<br>" . "\n");
        // chmod($fp, 0777);

        return $response;
    }

    private function run_po_001_a($po_code, $printed)
    {
        $po = $this->poHelper->show_po_001($po_code, $printed);
        $data = json_decode($po);

        $po_code = $data[0]->po_code;
        $vendor_name = $data[0]->vendor_name;
        $project_area = $data[0]->plantcode;

        $createPDF = $this->poHelper->create_pdf_001($po_code, $printed);
        $dir = $createPDF['dir'];
        $file_name = $createPDF['file_name'];

        $data = [
            "po_code" => $po_code,
            "project_area" => $project_area,
            "vendor_name" => $vendor_name,
            "dir" => $dir,
            "file_name" => $file_name
        ];

        $send_po = $this->phpmailerHelper->ssl_options($data);
        if ($send_po) {
            $send_res = json_encode($send_po);
        } else {
            // $this->poHelper->update_po_tsendEmail($po_code,1);
            $send_res = "Send mail faild.";
        }

        $response = [
            "create_pdf" => $createPDF,
            "send_mail" => $send_res
        ];

        // Create Logs
        $fp = fopen('logs/run_po_001_' . date("Y-m-d") . '.html', 'a');
        fwrite($fp, "<p>" . date("Y-m-d H:i:s") . "<br>" . "\n");
        fwrite($fp, json_encode($createPDF) . "<br>" . "\n");
        fwrite($fp, $send_res . "<br>" . "\n");
        // chmod($fp, 0777);

        return $response;
    }

    private function run_po_002($po_code, $printed)
    {
        $createPDF = $this->poHelper->create_pdf_002($po_code, $printed);
        $dir = $createPDF['dir'];
        $file_name = $createPDF['file_name'];

        $data = [
            "po_code" => $po_code,
            "dir" => $dir,
            "file_name" => $file_name
        ];

        $send_po = $this->mailHelper->send($data);
        if ($send_po) {
            $send_res = json_encode($send_po);
        } else {
            $send_res = "Send mail success";
        }

        $response = [
            "create_pdf" => $createPDF,
            "send_mail" => $send_res
        ];

        // Create Logs
        $fp = fopen('logs/run_po_002_' . date("Y-m-d") . '.html', 'a');
        fwrite($fp, "<p>" . date("Y-m-d H:i:s") . "<br>" . "\n");
        fwrite($fp, json_encode($createPDF) . "<br>" . "\n");
        fwrite($fp, $send_res . "<br>" . "\n");

        return $response;
    }

    public function pr_asset()
    {
        $data = [
            'tmp' => getenv('template'),
            'identity' => $this->dorbitt->identity,
            'page_title' => 'Purchase Requisition (PR)',
            'navlink' => 'requisition',
            // 'page'          => 'dashboard/dashboard',
            'breadcrumb' => ['Purchase', 'Requisition', 'Index'],
            'breadcrumb_active' => ['active', '']
        ];

        return view($this->tmp . '/pages/purchase/requisition/index', $data);
    }

    public function pr_type_a()
    {
        $data = [
            'tmp' => getenv('template'),
            'identity' => $this->dorbitt->identity,
            'page_title' => 'Purchase Requisition (PR)',
            'navlink' => 'requisition',
            // 'page'          => 'dashboard/dashboard',
            'breadcrumb' => ['Purchase', 'Requisition', 'Index'],
            'breadcrumb_active' => ['active', '']
        ];

        return view($this->tmp . '/pages/purchase/requisition/index', $data);
    }

    public function pr_type_b()
    {
        $data = [
            'tmp' => getenv('template'),
            'identity' => $this->dorbitt->identity,
            'page_title' => 'Purchase Requisition (PR)',
            'navlink' => 'requisition',
            // 'page'          => 'dashboard/dashboard',
            'breadcrumb' => ['Purchase', 'Requisition', 'Index'],
            'breadcrumb_active' => ['active', '']
        ];

        return view($this->tmp . '/pages/purchase/requisition/index', $data);
    }

    public function pr_monitoring()
    {
        $data = [
            'tmp' => getenv('template'),
            'identity' => $this->dorbitt->identity,
            'page_title' => 'Purchase Requisition (PR)',
            'navlink' => 'requisition',
            // 'page'          => 'dashboard/dashboard',
            'breadcrumb' => ['Purchase', 'Requisition', 'Index'],
            'breadcrumb_active' => ['active', '']
        ];

        return view($this->tmp . '/pages/purchase/requisition/index', $data);
    }

    public function approval_monitoring()
    {
        $data = [
            'tmp' => getenv('template'),
            'identity' => $this->dorbitt->identity,
            'page_title' => 'Purchase Requisition (PR)',
            'navlink' => 'requisition',
            // 'page'          => 'dashboard/dashboard',
            'breadcrumb' => ['Purchase', 'Requisition', 'Index'],
            'breadcrumb_active' => ['active', '']
        ];

        return view($this->tmp . '/pages/purchase/requisition/index', $data);
    }

    public function po_pdf_email()
    {
        $query = $this->syshab->query('EXEC qsp_MAI_0001');
        $po = $query->getResultArray();
        return $this->respond($po, 200);
        // dd($po);
        if ($po) {

        }
    }

    public function po_full_approve()
    {
        $po_full_approve = $this->poHelper->po_full_approve();
        $response = json_decode($po_full_approve);
        return $this->respond($response, 200);
    }

    public function show_po_001($po_code, $printed)
    {
        $po = $this->poHelper->show_po_001($po_code, $printed);
        $response = json_decode($po);
        return $this->respond($response, 200);
    }

    public function show_po_002($po_code, $printed)
    {
        $po = $this->poHelper->show_po_002($po_code, $printed);
        $response = json_decode($po);
        return $this->respond($response, 200);
    }

    public function print_po_001($po_code, $printed)
    {
        $po = $this->poHelper->show_po_001($po_code, $printed);
        $response = json_decode($po);
        $response = $response;

        $data = [
            'tmp' => getenv('template'),
            'data' => $response
        ];
        return view($this->tmp . '/pages/purchase/po/print_po_001_d', $data);
    }

    public function print_po_002($po_code, $printed)
    {
        $po = $this->poHelper->show_po_002($po_code, $printed);
        $response = json_decode($po);
        $response = $response;

        $data = [
            'tmp' => getenv('template'),
            'data' => $response
        ];
        return view($this->tmp . '/pages/purchase/po/print_po_002_b', $data);
    }

    public function print_po_003()
    {
        $data = [
            'tmp' => getenv('template'),
        ];
        return view($this->tmp . '/pages/purchase/po/print_po_003', $data);
    }

    public function print_po_004()
    {
        $data = [
            'tmp' => 'metrica2'
        ];
        return view($this->tmp . '/pages/purchase/po/print_po_004', $data);
    }

    public function print_po_005()
    {
        $data = [
            'tmp' => getenv('template'),
        ];
        return view($this->tmp . '/pages/purchase/po/print_po_005', $data);
    }

    public function create_pdf_001($po_code, $printed)
    {
        $create = $this->poHelper->create_pdf_001($po_code, $printed);
        return $this->respond($create, 200);
    }

    public function create_pdf_002($po_code, $printed)
    {
        $create = $this->poHelper->create_pdf_002($po_code, $printed);
        return $this->respond($create, 200);
    }

    public function mail_body()
    {
        $po = $this->find_po_full_approve();

        $data = [
            'tmp' => getenv('template'),
            'data' => $po
        ];
        return view($this->tmp . '/pages/purchase/po/mail_body', $data);
    }

    public function vms_timesheet()
    {
        $data = [
            'page_title' => '<i class="fas fa-users-cog text-info mr-2"></i> Dashboard Time Sheet',
            'module_kode' => 'dash-vms-timesheet',
            'navlink' => 'dash-vms-timesheet',
            'group' => ['dashboard'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => 'pages/time_sheet/',
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Dashboard",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Time Sheet",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
            'page' => 'dashboard',
        ];
        return view($this->vH->ummuViewPartialIndex(), $data);
    }
}
