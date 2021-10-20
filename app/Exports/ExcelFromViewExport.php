<?php

namespace App\Exports;

use App\Http\Resources\PosDetailResourse;
use App\Http\Resources\UserResource;
use App\Models\General\PosDetail;
use App\Models\General\User;
use App\Models\General\ViewDevloperTarget;
use App\Models\Stocks\SoldSim;
use App\Models\Stocks\ViewPosStock;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelFromViewExport extends BaseReportsExports implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $view;
    public $params;

    public function __construct($view = "", $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function view(): View
    {
        return view(   $this->view, $this->data);



    }

}
