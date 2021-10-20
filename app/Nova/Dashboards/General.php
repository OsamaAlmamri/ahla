<?php

namespace App\Nova\Dashboards;

use App\Models\General\User;
use App\Models\POS\PosCallProblem;
use App\Models\POS\Problem211;
use App\Nova\Metrics\allAdmins;
use App\Nova\Metrics\allCompanies;
use App\Nova\Metrics\allDevelopers;
use App\Nova\Metrics\allMarheters;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\TotalUsers;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Laravel\Nova\Dashboard;

class General extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */



    public function cards()
    {

        return [
            (new NewUsers)->help('This is calculated using all users that are active and not banned.'),
            (new TotalUsers)->help(view('Metrics.users')->render()),
            //            (new allAdmins)->help('This is calculated using all users that are active and not banned.'),
            //            (new allCompanies)->help('This is calculated using all users that are active and not banned.'),
            //            (new allMarheters)->help('This is calculated using all users that are active and not banned.'),
            //            (new allDevelopers)->help('This is calculated using all users that are active and not banned.'),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return __('General');
    }

    public static function uriKey()
    {
        return 'general';
    }
}
