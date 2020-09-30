<?php

namespace App\Console\Commands;

use App\Http\Controllers\Japanese\JapaneseService;
use App\Http\Controllers\Japanese\ServiceGoogle;
use Google_Service_Sheets_ValueRange;
use Illuminate\Console\Command;

class japanese_sentence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'japanese_sentence';

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
        JapaneseService::read_sentence();
    }
}
