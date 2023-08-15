<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WeaponCase;
use SteamApi\Configs\Apps;
use SteamApi\SteamApi;

class SearchCases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:search-cases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private SteamApi $api;
    private int $start;
    private int $count;
    private int $total_count;

    public function __construct() {
        parent::__construct();
        $this->api = new SteamApi();
        $this->start = 0;
        $this->count = 10;
    }
    /**
     * Execute the console command.
     */
    public function handle(): void {
        $this->info('searching cases');

        // initial search (gets total_count)
        $this->search();

        $bar = $this->output->createProgressBar($this->total_count);
        $bar->advance($this->count);

        while($this->total_count > $this->start) {
            $this->search();
            $this->start = $this->start + $this->count;
            $bar->advance($this->count);
        }

        $bar->finish();
    }

    private function search(): bool {
        $options = [
            'query' => 'Case',
            'exact' => true,
            'start' => $this->start,
            'count' => $this->count,
            'filter' => [
                'category_730_Type' => ['tag_CSGO_Type_WeaponCase'],
            ]
        ];

        $res = $this->api->searchItems(Apps::CSGO_ID, $options);

        if (!is_array($res)) return false;

        $this->total_count = $res['searchdata']['total_count'];
        $items = $res['results'];

        if (!is_array($items)) return false;

        foreach($items as $c) {
            dump($c['name']);
            $weaponCase = WeaponCase::firstOrCreate(['name' => $c['name']], ['name' => $c['name']]);
        }

        return true;
    }
}
