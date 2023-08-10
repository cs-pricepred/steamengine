<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Weapon;
use SteamApi\Configs\Apps;
use SteamApi\SteamApi;

class FetchWeaponList extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-weapon-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches Weapons from the API';

    /**
     * Execute the console command.
     * uses the https://steamcommunity.com/market/appfilters/%s Endpoint
     */
    public function handle(): void {
        $api = new SteamApi();
        $res = $api->getAppFilters(Apps::CSGO_ID);

        $weapons = ($res['facets'][Apps::CSGO_ID.'_Weapon']['tags']);

        foreach($weapons as $w) {
            dump($w);
            $wModel = Weapon::create(['name' => $w['localized_name']]);
        }
    }
}
