<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SteamApi\Configs\Apps;
use SteamApi\SteamApi;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(): void {
        $api = new SteamApi();
        $options = [
            /* 'market_hash_name' => 'AK-47 | Jaguar (Factory New)', */
            'query' => 'Case',
            'exact' => true,
            'count' => 10,
            'filter' => [
                'category_730_Type' => ['tag_CSGO_Type_WeaponCase'],
            ]
        ];
        $res = $api->searchItems(Apps::CSGO_ID, $options);

        /* $options = [ */
        /*     'market_hash_name' => "Recoil Case", */
        /*     'item_name_id' => 176321160, */
        /* ]; */
        /* $res = $api->getItemOrdersHistogram(Apps::CSGO_ID, $options); */
        dd($res);
    }
}
