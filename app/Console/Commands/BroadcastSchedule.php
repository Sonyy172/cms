<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use App\Broadcasts;


class BroadcastSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send broadcast with schedule';

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
        //
        try {
            $client = new GuzzleHttpClient();
            $time = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
            //$time = "2017-11-21 16:18";
            $response = $client->request('GET', 'http://cb.saostar.vn:3000/broadcast/get_broadcsast_by_time/'.$time);
            $broadcasts = json_decode($response->getBody()->getContents());
            $broadcasts = each($broadcasts)['value'];
            if(!empty($broadcasts))
            {
                foreach ($broadcasts as $key => $broadcast) {
                    $response2 = $client->request('POST', 'http://cb.saostar.vn:3000/broadcast/broadcast', [
                        'form_params' => [  'username' => 'phuc',
                                            'password' => '1',
                                            'message' => $broadcast->content,
                    ],
                    ]);
                }
                   
            }
        }
        catch (RequestException $re) {
                  //For handling exception
                  
        }

    }
}
