<?php

namespace App\Console\Commands;

use App\Models\Stocks\Stock;
use App\Models\Stocks\StockItem;
use App\Nova\Actions\SyncData\StockItemSyncData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StocksSyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync_data:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update stocks data';

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
     * @return int
     */
    public function handle()
    {
        \App\Nova\Actions\SyncData\StocksSyncData::synscData();
        $this->info('Successfully update stocks data.');
    }
}
