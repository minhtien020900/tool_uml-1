<?php

namespace Tests\Unit;

use App\Http\Controllers\Japanese\ServiceGoogle;
use App\Services\APIRedmineService;
use Google_Service_Sheets_ValueRange;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function testDoGetDB(){
        $a = [50345,50351,50341,50402,50346,50366,50380,50344,50492,50383,50343,50430,51136,50349,50476,50367,50404,50357,50335,50368,50336,51160];
        foreach ($a as $mmmm){
            $m = Redis::keys('*'.$mmmm.'*');
            foreach ($m as $m2){

                $v = (json_decode(Redis::get($m2),true));
                var_dump($v['postid']);
                echo $v['pagetext'].PHP_EOL;
                if($v['parentid']==50328){
                }
                // if(preg_match('//',$v['title'])){
                //     var_dump($v['title']);
                // }
            }
        }

    }
public function testDoSaveFileToRedis(){
    // Redis::set("m",3);
    // echo Redis::get("m");
    $files = Storage::disk('local')->allFiles();
    Redis::flushall();
    foreach ($files as $file){
        Redis::set($file,(Storage::disk('local')->get($file)));
        // dd(json_decode(Storage::disk('local')->get($file))) ;
        // die;
    }
    dd();
}
    public function testCreateTask() {
        APIRedmineService::createPackageTicket();
    }

    public function testName() {
        $files = Storage::disk('s3')->allFiles();
        foreach ($files as $f){
            Storage::disk('s3')->delete($f);
        }
        // return;
        for($i=0;$i<5;$i++){
            echo $i.PHP_EOL;
            $filePath = rand(0,10000).'/file_'.rand(0,1000000);
            Storage::disk('s3')->put($filePath,'sss','public');
            echo Storage::disk('s3')->get($filePath).PHP_EOL;

        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->markTestSkipped();
        return;
        $s = new ServiceGoogle;
        $service = $s->getService();
        $spreadsheetId = '1PFurLYDNoZY70nbQhUmDbbtPGnSn8RWY1Bgz7GtlZdg';
        $range         = 'Sentence!A22';
        $values=['1,2,3'];
        $requestBody = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $response      = $service->spreadsheets_values->update($spreadsheetId, $range,$requestBody);

    }
}
