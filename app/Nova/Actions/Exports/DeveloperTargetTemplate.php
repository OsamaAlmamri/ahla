<?php

namespace App\Nova\Actions\Exports;

use App\Exports\DeveloperTargetExport;
use App\Exports\PosDetails;
use App\Exports\UserInfoPrintDetails;

class DeveloperTargetTemplate extends DatchedWithExcelExport
{
    /**
     * Get the displayable name of the action.
     *
     * @return string
     */


    public $showOnIndex = true;
    public $col;

    public function __construct($col = "target")
    {
        $this->col = $col;
    }

    public function name()
    {
        $text = "export Visitors ";

        return  $text ;
    }

    public function get_exported_data()
    {
        // TODO: Implement get_exported_data() method.
        $data = new DeveloperTargetExport($this->col);

        return $data;
    }

}
