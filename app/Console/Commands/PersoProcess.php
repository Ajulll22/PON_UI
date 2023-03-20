<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\PersoFile;
use Session;
use PHPExcel; 
use PHPExcel_IOFactory;
use mPDF;
use Validator;
use Illuminate\Support\Facades\Crypt;

class PersoProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perso:daily_generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and send perso file to pre-defined email.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date_log = date('d F Y');
		$date_time = date('Y-m-d H:i:s');
		$log = PHP_EOL .'=== INITIATING AUTOMATIC PERSO PROCESS ==='. PHP_EOL;
		
		/* BEGIN FOREACH HERE */
		$client = new \GuzzleHttp\Client();
			
		$log .= '['.$date_time.'] SUCCESS : The account has been authenticated successfully'. PHP_EOL;
		
		$get_perso_data = $client->request('GET', config('constants.api_server').'card/generate-perso');
		$get_perso_data = json_decode($get_perso_data->getBody()->getContents(), true);
					
		if($get_perso_data['result'] == 'SUCCESS'){
			$objPHPExcel = new PHPExcel();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setDelimiter('~')->setEnclosure('');

			$objSheet = $objPHPExcel->getActiveSheet();
			$objSheet->getCell('A1')->setValue($get_perso_data['perso_title']);
	
			$record = 2;
			for($i=0;$i<count($get_perso_data['result']);$i++){
				$objSheet->getCell('A'.$record)->setValue($get_perso_data['result'][$i]);
				$record++;
			}
			$objSheet->getCell('A'.$record)->setValue($get_perso_data['perso_title']);
			
			$date_format_for_file_name = date('DMjHis');
			$file_name = 'PERSO'.substr($get_perso_data['perso_title'], 0, 14).'ICT.csv';
			
			$objWriter->save(public_path().'/storage/perso/'.$file_name);
			
		}
		else{
			
			$log .= '['.$date_time.'] FAILED : No Data In The Database.'. PHP_EOL;
			$response['success'] = false;
			$response['result'] = 'false,No Data In The Database';
			
		}
		
		$log .= '=== EXITING AUTOMATIC PERSO PROCESS ===';
		
		if(Storage::exists('public/perso/log/perso_'.$date_log.'.txt')){
			Storage::append('public/perso/log/perso_'.$date_log.'.txt', $log);
		}
		else{
			Storage::put('public/perso/log/perso_'.$date_log.'.txt', $log);
		}
		
		$this->info($response['result']);
    }
}
