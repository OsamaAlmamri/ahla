<?php

namespace App\Console\Commands;

use App\Models\General\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Nova;

class CombineNovaTools extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Combines all nova tools scripts and styles in nova-tools.[js|css] in public/[js/css]';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'combine:nova-tools';

    /**
     * Create a new command instance.
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
        Auth::login(User::find(1)); // change to a user with full access to nova

        app()->handle(Request::create('/')); // or wthaever your nova root route is

        $this->info('combining nova tools js and css');

        $this->combineTools();
    }

    private function combineTools(): void
    {
        foreach (['allScripts' => 'js', 'allStyles' => 'css'] as $method => $type) {
            $content = '';

            foreach (Nova::{$method}() as $file) {
                $this->info($file);
                $content .= \file_get_contents($file);
            }

            \file_put_contents(public_path($type . '/nova-tools.' . $type), $content);
        }
    }
}
