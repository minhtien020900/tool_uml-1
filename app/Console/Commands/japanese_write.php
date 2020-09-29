<?php

namespace App\Console\Commands;

use App\Http\Controllers\Japanese\JapaneseService;
use App\Http\Controllers\Japanese\ServiceGoogle;
use Google_Service_Sheets_ValueRange;
use Illuminate\Console\Command;

class japanese_write extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'japanese_write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $s = new ServiceGoogle;
        $service = $s->getService();
        $spreadsheetId = '1PFurLYDNoZY70nbQhUmDbbtPGnSn8RWY1Bgz7GtlZdg';
        $range         = 'Sentence!A22:A22';
        $values=['13'];
        $requestBody = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $response      = $service->spreadsheets_values->batchUpdate($spreadsheetId, $range,$requestBody);
        var_dump($response);
    }
}
