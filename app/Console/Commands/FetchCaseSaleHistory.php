<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WeaponCase;
use App\Models\HistoricSale;
use Illuminate\Support\Facades\Log;
use SteamApi\Configs\Apps;
use SteamApi\SteamApi;

class FetchCaseSaleHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-case-sale-history {item_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch sale history for all cases, or item_id';

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
        Log::info('Command: FetchCaseSaleHistory');

        if ($item_id = $this->argument('item_id')) {
            $this->info('starting to fetch single');
            $this->fetchSingleWithId($item_id);
        } else {
            $this->info('starting to fetch all');
            Log::info('starting to fetch all');
            $items = WeaponCase::all();
            $bar = $this->output->createProgressBar(count($items));

            foreach($items as $item) {
                $this->fetchSingle($item);
                $bar->advance();
            }

            $bar->finish();
        }
    }

    /**
     * @return bool
     */
    private function fetchSingle(WeaponCase $item): bool {
        Log::info('fetching '. $item->name);
        $historicSales = $this->api->getSaleHistory(Apps::CSGO_ID, ['market_hash_name' => $item->name]);

        if (!is_array($historicSales)) {
            dump($historicSales);
            Log::error('failed to fetch'. $item->name);
            return false;
        }

        foreach($historicSales as $s) {
            $historicSale = HistoricSale::firstOrCreate(['item_id' => $item->id, 'time' => $s['time']], [...$s, 'item_id' => $item->id]);
        }

        return true;
    }

    /**
     * @return bool
     */
    private function fetchSingleWithId(string $item_id) : bool {
        $item = WeaponCase::find($item_id);
        return $this->fetchSingle($item);
    }
}
