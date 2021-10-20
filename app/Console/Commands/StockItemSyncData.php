<?php

namespace App\Console\Commands;

use App\Models\Stocks\Stock;
use App\Models\Stocks\StockItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StockItemSyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync_data:stock-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update stock items data';

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
        \App\Nova\Actions\SyncData\StockItemSyncData::synscData();
        $this->info('update stock items data everyone.');
    }
}
