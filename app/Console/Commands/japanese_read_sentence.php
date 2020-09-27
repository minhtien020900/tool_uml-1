<?php
// php artisan japanese:read_centence
namespace App\Console\Commands;

use App\Http\Controllers\Japanese\JapaneseService;
use Illuminate\Console\Command;

class japanese_read_sentence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'japanese:read_centence';

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
