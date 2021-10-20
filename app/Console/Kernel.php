<?php

namespace App\Console;

use App\Console\Commands\CombineNovaTools;
use App\Console\Commands\SolidSimsSyncData;
use App\Console\Commands\StockItemSyncData;
use App\Console\Commands\StocksSyncData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\DatabaseBackUp',
        CombineNovaTools::class,
        StocksSyncData::class,
        SolidSimsSyncData::class,
        StockItemSyncData::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('database:backup')->daily();
        $schedule->command('sync_data:stock-items')->daily()->at('01:00');
        $schedule->command('sync_data:sold-sims')->daily()->at('01:10');
        $schedule->command('sync_data:stock')->daily()->at('01:20');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
//        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
