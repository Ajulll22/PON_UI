<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Exception;
use Session;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Redis;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\Converter\StandardConverter;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\JWSSerializerManager;

use Jose\Component\Checker\ClaimCheckerManager;
use Jose\Component\Checker\ExpirationTimeChecker;
use Jose\Component\Checker\IssuedAtChecker;
use Jose\Component\Checker\NotBeforeChecker;
use Jose\Component\Core\Util\JsonConverter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UtilityController extends Controller
{

    public static function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = config('constants.secret_key');
        $secret_iv = config('constants.secret_iv');

        // key - must be exact 32 chars (256 bit) 
        $key = $secret_key;
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning 
        $iv = strtoupper(substr(hash('sha256', $secret_iv), 0, 16));
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
        }
        return $output;
    }

    public static function send_user_register($username, $fullname, $password, $email, $result_data)
    {
        $data       = array('username' => $username, 'fullname' => $fullname, 'password' => $password, 'email' => $email);
        $emailTo    = $email;

        Log::debug($data);
        Log::debug($emailTo);
        Log::debug(config('constants.mailusername'));
        Log::debug(config('constants.sender'));
        Log::debug(config('constants.app_name'));
        try {
            Mail::send('Mail.user-register', $data, function ($message) use ($emailTo) {
                $message->from(config('constants.mailusername'), config('constants.sender'));
                $message->subject('Welcome to ' . config('constants.app_name'));
                $message->to($emailTo);
            });

            return $result_data;
        } catch (\Exception $e) {
            $result_data[config('constants.result')]  = "FAILED";
            $result_data['message'] = "EMAIL NOT SENT";
            $result_data['error']   = "error message: " . $e->getMessage();

            return $result_data;
        }
    }

    public static function check_token($result_data)
    {
        if ($result_data[config('constants.response_code')] == 'B220000') {
            return redirect()->route('logout');
        }

        return $result_data;
    }

    public static function createJWS($json)
    {
        $json = str_replace('&quot;', '"', json_encode($json));
        $key = config('constants.jwk');

        // The algorithm manager with the HS256 algorithm.
        $algorithmManager = new AlgorithmManager([
            new HS256(),
        ]);

        // Our key.
        $jwk = new JWK([
            'kty' => 'oct',
            'k' => $key,
        ]);

        // Instantiate JWS Builder.
        $jwsBuilder = new JWSBuilder($algorithmManager);

        // The payload we want to sign. The payload MUST be a string hence we use our JSON Converter.
        // $payload = json_encode($json);

        $payload = JsonConverter::encode($json);

        $jws = $jwsBuilder
            ->create()                               // We want to create a new JWS
            ->withPayload($payload)                  // We set the payload
            // ->addSignature($jwk, ['alg' => 'HS256']) // We add a signature with a simple protected header
            ->addSignature($jwk, ['alg' => 'HS256', 'typ' => 'JWT']) // We add a signature with a simple protected header
            ->build();                               // We build it

        $serializer = new CompactSerializer(); // The serializer

        $token = $serializer->serialize($jws, 0); // We serialize the signature at index 0 (we only have one signature).
        // return (array)$token;

        // create detached payload JWS compact
        $data = explode(".", $token);
        unset($data[1]);
        $token = implode("..", $data);
        return $token;
    }

    public function UploadToTemp(Request $request)
    {
        try {
            $rules = [
                'upload_document' => 'required|mimes:jpg,png,jpeg,pdf|max:5000'
            ];
            $data = $request->all();
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return [
                    'result' => 'error_validate',
                    'message' => $validator->errors()
                ];
            }
            $file = $request->file('upload_document');
            $fileName = 'UploadTmp-' . time() . '.' . $file->extension();

            $file->move(public_path('tmp'), $fileName);

            return [
                "result" => "SUCCESS",
                "message" => "Uploaded",
                "file_name" => $fileName
            ];
        } catch (\Throwable $th) {
            return [
                "result" => "FAILED",
                "message" => "Error Upload File"
            ];
        }
    }

    public function DeleteFromTemp(Request $request)
    {
        $file_name = $request->input('delete_document');
        if (file_exists(public_path('tmp/' . $file_name))) {
            unlink(public_path('tmp/' . $file_name));
        }
        return;
    }

    public function generate(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        $data_report = [
            [
                "deskripsi" => "Anjass (Bensin, Parkir)",
                "account" => "412313131",
                "amount" => 120000
            ],
            [
                "deskripsi" => "Bagass (Bensin, Parkir)",
                "account" => "812313134",
                "amount" => 200000
            ]
        ];
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
            $spreadSheet->getActiveSheet()->setCellValue("F1", "23 Maret 2023");
            $spreadSheet->getActiveSheet()->setCellValue("F2", "Mandiri");
            $spreadSheet->getActiveSheet()->setCellValue("F3", "1230001919010");
            $spreadSheet->getActiveSheet()->setCellValue("F4", "1220004043553");

            $spreadSheet->getActiveSheet()->getStyle("B7:F10")->getFont()->setBold( true );
            $spreadSheet->getActiveSheet()->getStyle("B8:F10")->getFill()->setFillType('solid');
            $spreadSheet->getActiveSheet()->getStyle("B8:F9")->getFill()->getStartColor()->setARGB("92d050");
            $spreadSheet->getActiveSheet()->getStyle("B9:F10")->getFont()->setSize(22);

            $spreadSheet->getActiveSheet()->getStyle("B10:F10")->getFill()->getStartColor()->setARGB("ffff00");
            $spreadSheet->getActiveSheet()->setCellValue("B7", "RF Name");
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
            foreach ($data_report as $key => $value) {
                $end = $key+11;
                $spreadSheet->getActiveSheet()->setCellValue("B".$end, $value['deskripsi']);
                $spreadSheet->getActiveSheet()->setCellValue("C".$end, $value['account']);
                $spreadSheet->getActiveSheet()->setCellValue("D".$end, $value['amount']);
                $spreadSheet->getActiveSheet()->setCellValue("E".$end, "Twice a month");
                $spreadSheet->getActiveSheet()->setCellValue("F".$end, "23 Maret 2023");
            }

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
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="ProposalPaymentReport.xlsx"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
            return;
        } catch (Exception $e) {
            return;
        }
    }

    public function GenerateCSV()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $data_report = [
                "date" => "20230324",
                "rek_sumber" => "1050005478221",
                "total_amount" => 40000,
                "detail" => [
                    [
                        "no_rek" => "12321343412",
                        "nama_penerima" => "Anjayyy",
                        "currency" => "IDR",
                        "amount" => 20000,
                        "service" => "IBU",
                        "bank_code" => "1234",
                        "bank_name" => "MANDIRI",
                        "bank_address" => "Jakarta",
                        "send_email" => "Y",
                        "email" => "asdada@gmail.com",
                        "charger_inst" => "OUR",
                        "tipe_beneficiary" => 1
                    ],
                    [
                        "no_rek" => "55421343412",
                        "nama_penerima" => "Binjayyy",
                        "currency" => "IDR",
                        "amount" => 20000,
                        "service" => "IBU",
                        "bank_code" => "1234",
                        "bank_name" => "MANDIRI",
                        "bank_address" => "Jakarta",
                        "send_email" => "N",
                        "email" => "hjmhmjh@gmail.com",
                        "charger_inst" => "BEN",
                        "tipe_beneficiary" => 1
                    ]
                ]
            ];

            $spreadSheet = new Spreadsheet();
            $sheet = $spreadSheet->getActiveSheet();
            $sheet->setCellValue("A1", "P");
            $sheet->setCellValue("B1", $data_report['date']);
            $sheet->setCellValue("C1", $data_report['rek_sumber']);
            $sheet->setCellValue("D1", count($data_report['detail']));
            $sheet->setCellValue("E1", $data_report['total_amount']);

            foreach ($data_report['detail'] as $key => $value) {
                $nomor = $key+2;
                $sheet->setCellValue("A$nomor", $value['no_rek']);
                $sheet->setCellValue("B$nomor", $value['nama_penerima']);
                $sheet->setCellValue("F$nomor", $value['currency']);
                $sheet->setCellValue("G$nomor", $value['amount']);
                $sheet->setCellValue("J$nomor", $value['service']);
                $sheet->setCellValue("K$nomor", $value['bank_code']);
                $sheet->setCellValue("L$nomor", $value['bank_name']);
                $sheet->setCellValue("M$nomor", $value['bank_address']);
                $sheet->setCellValue("Q$nomor", $value['send_email']);
                $sheet->setCellValue("R$nomor", $value['email']);
                $sheet->setCellValue("AM$nomor", $value['charger_inst']);
                $sheet->setCellValue("AN$nomor", $value['tipe_beneficiary']);
            }

            $csv_writer = new Csv($spreadSheet);
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment;filename="CsvReport.csv"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $csv_writer->save('php://output');
            exit();
            return;

        } catch (\Throwable $th) {
            return;
        }
        
    }

    public function GenerateAutoPay()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
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
            $sheet->getStyle("A1:J1")->applyFromArray($headerStyle);
            $sheet->setAutoFilter('A1:J1');

            $sheet->fromArray([
                "NO", "EMPLOYEE NAME", "AMOUNT", "PON", "CASH TEMPORARY", "TAXICAB", 
                "PHONE FAX MOBILE PHONE COMMUNICATION", "MARKETING EXPENSES B2B - ENTERTAIN & DONATION",
                "MARKETING EXP - EVENT, PUBLICITY", "OTHER OCCUPANCY COST - LICENSE & FEES",

            ]);

            $Excel_writer = new Xlsx($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="AutoPay.xlsx"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
            return;
        } catch (\Throwable $th) {
            return ;
        }
    }
}
