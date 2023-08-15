<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Skin;
use App\Models\HistoricSale;
use SteamApi\Configs\Apps;
use SteamApi\SteamApi;

class FetchSaleHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-sale-history {item_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch sale history for all skins, or item_id';

    private SteamApi $api;

    public function __construct() {
        parent::__construct();
        $this->api = new SteamApi();
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(): void {

        if ($item_id = $this->argument('item_id')) {
            $this->info('starting to fetch single');
            $this->fetchSingleWithId($item_id);
        } else {
            $this->info('starting to fetch all');
            $skins = Skin::all();
            $bar = $this->output->createProgressBar(count($skins));

            foreach($skins as $skin) {
                $this->fetchSingle($skin);
                $bar->advance();
            }

            $bar->finish();
        }
    }

    /**
     * @return bool
     */
    private function fetchSingle(Skin $skin): bool {

        $market_hash_name = $skin->weapon->name . ' | ' . $skin->name . ' (' . $skin->wear . ')';

        $historicSales = $this->api->getSaleHistory(Apps::CSGO_ID, ['market_hash_name' => $market_hash_name]);

        if (!is_array($historicSales)) return false;

        foreach($historicSales as $s) {
            $historicSale = HistoricSale::firstOrCreate(['item_id' => $skin->id, 'time' => $s['time']], [...$s, 'item_id' => $skin->id]);
        }

        return true;
    }

    /**
     * @return bool
     */
    private function fetchSingleWithId(string $item_id) : bool {
        $skin = Skin::find($item_id);
        return $this->fetchSingle($skin);
    }
}
