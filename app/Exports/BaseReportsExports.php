<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class BaseReportsExports implements WithEvents, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */


    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getDelegate()->setRightToLeft(true);
              $event->sheet->autoSize();

            }
        ];
    }

    public function styles(Worksheet $spreadsheet)
    {
        $spreadsheet->getStyle('B2')->getFont()->setBold(true);
        $spreadsheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $spreadsheet->getPageSetup()->setFitToWidth(1);
        $spreadsheet->getPageSetup()->setFitToHeight(0);
        $spreadsheet->getColumnDimension('B')->setAutoSize(true);;
    }

}
