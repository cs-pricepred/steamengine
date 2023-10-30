<?php

namespace App\Console;

use App\Console\Commands\FetchCaseSaleHistory;
use App\Console\Commands\FetchItemSaleHistory;
use App\Console\Commands\FetchSaleHistory;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        /* $schedule->command(FetchCaseSaleHistory::class)->everyFourHours(); */
        /* $schedule->command(FetchSaleHistory::class)->dailyAt('06:00'); */
        $schedule->command(FetchItemSaleHistory::class)->everyFourHours();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
