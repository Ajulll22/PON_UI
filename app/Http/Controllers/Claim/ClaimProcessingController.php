<?php

namespace App\Http\Controllers\Claim;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ClaimProcessingController extends Controller
{
    public function __construct()
    {
        $this->menu     = "claim";
        $this->sub_menu = "claim-processing";
    }
    
    public function index(Request $request)
    {
        $data['menu'] = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        return view('claim\claim-processing')->with('data', $data);
    }

    public function get_all()
    {
        $list = GatewayController::lead_to_be("GET", "claim-processing/data", []);
        // dd($list);
        return $list["data"];
    }

    public function initiate_claim(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Session::get('user_id');
        $res = GatewayController::lead_to_be("POST", "claim-processing/initiate-pon", $data);

        return $res;
    }

    public function close_claim(Request $request)
    {
        $data = $request->all();
        $res = GatewayController::lead_to_be("POST", "claim-processing/close-claim", $data);

        return $res;
    }

    public function GenerateCSV($id, Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        $rek_type = $request->query("rek");

        $rek_list = [
            "idr" => "1230001919010",
            "usd" => "1220004043553"
        ];

        $data = [
            "rf_period_id" => $id
        ];
        $res = GatewayController::lead_to_be("POST", "claim-processing/report/csv", $data);
        if ($res['result'] != "SUCCESS") {
            return $res;
        }

        $data_report = $res["data"];
        $data_report["rek_sumber"] = $rek_list[$rek_type];

        try {

            $spreadSheet = new Spreadsheet();
            $sheet = $spreadSheet->getActiveSheet();
            $sheet->setCellValue("A1", "P");
            $sheet->setCellValue("B1", $data_report['date']);
            $sheet->setCellValue("C1", $data_report['rek_sumber']);
            $sheet->setCellValue("D1", $data_report['total_row']);
            $sheet->setCellValue("E1", $data_report['total_amount']);

            foreach ($data_report['detail'] as $key => $value) {
                $nomor = $key+2;
                $sheet->setCellValue("A$nomor", $value['account_number']);
                $sheet->setCellValue("B$nomor", $value['account_name']);
                $sheet->setCellValue("F$nomor", $value['currency']);
                $sheet->setCellValue("G$nomor", $value['amount']);
                $sheet->setCellValue("J$nomor", "IBU");
                $sheet->setCellValue("L$nomor", "MANDIRI");
                $sheet->setCellValue("M$nomor", "Jakarta");
                $sheet->setCellValue("Q$nomor", "N");
                $sheet->setCellValue("AM$nomor", "BEN");
                $sheet->setCellValue("AN$nomor", "1");
            }

            $csv_writer = new Csv($spreadSheet);

            $filename = "CsvReport-".$data_report["rf_period_name"].".csv";

            header('Content-Type: application/csv');
            header("Content-Disposition: attachment;filename=$filename");
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $csv_writer->save('php://output');
            exit();
            return;

        } catch (\Throwable $th) {
            return;
        }
        
    }

    public function GeneratePP($id, Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        $submission_date = $request->query("date");
        $res = GatewayController::lead_to_be("POST", "claim-processing/report/payment-plan-proposal", [ "rf_period_id" => $id ]);
        if ($res['result'] != "SUCCESS") {
            return $res;
        }

        $data_report = $res["data"];
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->setTitle("nama worksheet")->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->getSheetView()->setZoomScale(40);
            $spreadSheet->getDefaultStyle()->getFont()->setName('Calibri');
            $spreadSheet->getDefaultStyle()->getFont()->setSize(26);

            // Header Style
            $spreadSheet->getActiveSheet()->getStyle("B1:B2")->getFont()->setBold( true );
            $spreadSheet->getActiveSheet()->setCellValue("B1", "PT PRIMAVISTA SOLUSI");
            $spreadSheet->getActiveSheet()->setCellValue("B2", "PAYMENT PLAN PROPOSAL");

            $spreadSheet->getActiveSheet()->setCellValue("E1", "Submisson Date");
            $spreadSheet->getActiveSheet()->setCellValue("E2", "Via Bank");
            $spreadSheet->getActiveSheet()->setCellValue("E3", "Account Number");
            $spreadSheet->getActiveSheet()->setCellValue("E5", "Funds Needed");
            $spreadSheet->getActiveSheet()->getStyle("E1:E5")->getNumberFormat()->setFormatCode('@* ":"');

            // Val
            $spreadSheet->getActiveSheet()->setCellValue("F1", $submission_date);
            $spreadSheet->getActiveSheet()->setCellValue("F2", "Mandiri");
            $spreadSheet->getActiveSheet()->setCellValue("F3", "1230001919010");
            $spreadSheet->getActiveSheet()->setCellValue("F4", "1220004043553");

            $spreadSheet->getActiveSheet()->getStyle("B7:F10")->getFont()->setBold( true );
            $spreadSheet->getActiveSheet()->getStyle("B9")->getFont()->setItalic( true );
            $spreadSheet->getActiveSheet()->getStyle("B8:F10")->getFill()->setFillType('solid');
            $spreadSheet->getActiveSheet()->getStyle("B8:F9")->getFill()->getStartColor()->setARGB("92d050");
            $spreadSheet->getActiveSheet()->getStyle("B9:F10")->getFont()->setSize(22);

            $spreadSheet->getActiveSheet()->getStyle("B10:F10")->getFill()->getStartColor()->setARGB("ffff00");
            $spreadSheet->getActiveSheet()->setCellValue("B7", $data_report['rf_name']);
            $spreadSheet->getActiveSheet()->setCellValue("B8", "PR and other costs");
            $spreadSheet->getActiveSheet()->setCellValue("B9", "CLAIM KARYAWAN");

            $spreadSheet->getActiveSheet()->getStyle("F3")->getNumberFormat()->setFormatCode('"IDR" * ":" * #');
            $spreadSheet->getActiveSheet()->getStyle("F4")->getNumberFormat()->setFormatCode('"USD" * ":" * #');
            $spreadSheet->getActiveSheet()->getStyle("F5")->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');

            // Body Style
            $start = 10;
            $spreadSheet->getActiveSheet()->setCellValue("B".$start, "DESKRIPSI");
            $spreadSheet->getActiveSheet()->setCellValue("C".$start, "ACCOUNT NUMBER");
            $spreadSheet->getActiveSheet()->setCellValue("D".$start, "AMOUNT");
            $spreadSheet->getActiveSheet()->setCellValue("E".$start, "TERM OF PAYMENT");
            $spreadSheet->getActiveSheet()->setCellValue("F".$start, "DUE DATE");
            $end = 11;
            foreach ($data_report["report_data"] as $key => $value) {
                $end = $key+11;
                $spreadSheet->getActiveSheet()->setCellValue("B".$end, $value['employee']);
                $spreadSheet->getActiveSheet()->setCellValue("C".$end, $value['account_number']);
                $spreadSheet->getActiveSheet()->setCellValue("D".$end, $value['amount']);
                $spreadSheet->getActiveSheet()->setCellValue("E".$end, "Twice a month");
                $spreadSheet->getActiveSheet()->setCellValue("F".$end, $submission_date);
            }

            $spreadSheet->getActiveSheet()->getColumnDimension("A")->setWidth(8.43);
            $spreadSheet->getActiveSheet()->getColumnDimension("B")->setWidth(90);

            // Footer Style
            $end++;
            $footerStyle = [
                'font' => [ "bold" => true ],
                'fill' => [
                    'fillType' => "solid",
                    'startColor' => [
                        'argb' => "FFC000"
                    ]
                ]
            ];
            $endSum = $end-1;
            $spreadSheet->getActiveSheet()->setCellValue("B".$end, "TOTAL");
            $spreadSheet->getActiveSheet()->setCellValue("D".$end, "=SUM(D11:D".$endSum.")");
            $spreadSheet->getActiveSheet()->setCellValue("F5", "=SUM(D11:D".$endSum.")");
            
            $spreadSheet->getActiveSheet()->getStyle("B$end:F$end")->applyFromArray($footerStyle);

            $spreadSheet->getActiveSheet()->getStyle("B".$start.":F".$end)->getBorders()->getAllBorders()->setBorderStyle("thin");
            $spreadSheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
            $spreadSheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);
            $Excel_writer = new Xlsx($spreadSheet);

            $filename = "ProposalPaymentReport-".$data_report["rf_period_name"].".xlsx";

            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=$filename");
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
            return;
        } catch (Exception $e) {
            return;
        }
    }

    public function GenerateAutoPay($id)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        $res = GatewayController::lead_to_be("POST", "claim-processing/report/autopay-claim", [ "rf_period_id" => $id ]);
        if ($res['result'] != "SUCCESS") {
            return $res;
        }
        $data_report = $res['data'];
        try {
            $spreadSheet = new Spreadsheet();
            $sheet = $spreadSheet->getActiveSheet();
            $sheet->getRowDimension(1)->setRowHeight(58.5);
            $sheet->setTitle("nama worksheet")->getDefaultColumnDimension()->setWidth(20);
            $sheet->getDefaultRowDimension()->setRowHeight(12.75);
            $sheet->getColumnDimension("A")->setWidth(5.57);
            $sheet->getColumnDimension("B")->setWidth(56.43);
            $sheet->freezePane('F2');
            $headerStyle = [
                'font' => [
                    'name' => "Arial Narrow",
                    'bold' => true,
                    'size' => 9
                ],
                'alignment' => [
                    'horizontal' => "center",
                    'vertical' => "center",
                    'wrapText' => true
                ],
                'fill' => [
                    'fillType' => "solid",
                    'startColor' => [
                        'argb' => "c6e0b4"
                    ]
                ]
            ];
            $sheet->getStyle("A1:BG1")->applyFromArray($headerStyle);
            $sheet->setAutoFilter('A1:BG1');

            $sheet->fromArray([ "NO", "EMPLOYEE NAME", "AMOUNT", "PON", "CASH TEMPORARY" ]);
            $sheet->fromArray($data_report["autopay_column"], null, "F1");

            $no = 1;
            foreach ($data_report["autopay_data"] as $value) {
                $sheet->setCellValue("A".$no+1, $no);
                $sheet->setCellValue("B".$no+1, $value["employee"]);
                $sheet->setCellValue("C".$no+1, $value["amount"]);
                // $sheet->setCellValue("D".$no+1, $value["pon_number"]);
                $sheet->getCell("D".$no+1)->setValueExplicit($value["pon_number"], "str");
                $sheet->setCellValue("E".$no+1, 0);
                $sheet->fromArray($value["amount_"], null, "F".$no+1);

                $no++;
            }
            $sheet->setCellValue("A".$no+1, $no);
            $sheet->setCellValue("C".$no+1, "=SUM(C2:C$no)");

            $start = "E";
            for ($i=0; $i < 55; $i++) { 
                $sheet->setCellValue($start.$no+1, "=SUM(".$start."2:$start$no)");
                $start++;
            }
            
            $sheet->getStyle("A2:A".$no+1)->getFont()->setSize(9)->setBold(TRUE);
            $sheet->getStyle("A2:A".$no+1)->getAlignment()->setHorizontal("center")->setVertical('center');
            $sheet->getStyle("B2:C".$no+1)->getFont()->setSize(10);
            $sheet->getStyle("D2:BG".$no+1)->getFont()->setSize(8);
            $sheet->getStyle("A1".":BG".$no+1)->getBorders()->getAllBorders()->setBorderStyle("thin");

            $last = $no+1;

            $sheet->getStyle("B$last:BG$last")->getFill()->setFillType("solid")->getStartColor()->setARGB("ffff00");

            $sheet->getStyle("C2:C".$no+1)->getNumberFormat()->setFormatCode('_(""* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)');
            $sheet->getStyle("E2:BG".$no+1)->getNumberFormat()->setFormatCode('_(* #,##0_);_(* (#,##0);_(* "-"??_);_(@_)');

            $Excel_writer = new Xlsx($spreadSheet);

            $filename = "AutoPay-".$data_report["rf_period_name"].".xlsx";

            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=$filename");
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
            return;
        } catch (\Throwable $th) {
            return ;
        }
    }

    public function DownloadZip($id)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        
        $filePath = "file/RF Period $id";
        $fileName = "$id.zip";
        $zip = new \ZipArchive();
    
        if ($zip->open("$filePath/$fileName", \ZipArchive::CREATE) !== true) {
            throw new \RuntimeException('Cannot open ' . "$filePath/$fileName");
        }
    
        $this->addContent($zip, realpath($filePath));
        $zip->close();

        return Response::download("$filePath/$fileName")->deleteFileAfterSend(true);
    }

    private function addContent(\ZipArchive $zip, string $path)
    {
        /** @var SplFileInfo[] $files */
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $path,
                \FilesystemIterator::FOLLOW_SYMLINKS
            ),
            \RecursiveIteratorIterator::SELF_FIRST
        );
    
        while ($iterator->valid()) {
            if (!$iterator->isDot()) {
                $filePath = $iterator->getPathName();
                $relativePath = substr($filePath, strlen($path) + 1);
    
                if (!$iterator->isDir()) {
                    $zip->addFile($filePath, $relativePath);
                } else {
                    if ($relativePath !== false) {
                        $zip->addEmptyDir($relativePath);
                    }
                }
            }
            $iterator->next();
        }
    }
}
