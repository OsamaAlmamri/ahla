<?php

namespace App\Exports;

use App\Models\General\User;
use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DeveloperTargetExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths

{
    public $col;

    public function __construct($col = 'target')
    {
        $this->col=$col;
    }

    public function collection()
    {
//        return User::supervisorDevelopers()->get();
        return Visitor::where('id', '>',"0")->get();
    }

    public function columnWidths(): array
    {
        return [

            'A' => 45,
            'B' => 30,
            'C' => 20,
            'D' => 20,
        ];
    }

    public function styles(Worksheet $spreadsheet)
    {
//        $spreadsheet->getStyle('B2')->getFont()->setBold(true);
        $spreadsheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $spreadsheet->getPageSetup()->setFitToWidth(1);
        $spreadsheet->getPageSetup()->setFitToHeight(0);
//        $spreadsheet->getColumnDimension('B')->setAutoSize(true);;
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->company,
            $user->phone,
            $user->email

        ];
    }


    public function headings(): array
    {
        return [
            'name',
            'company',
            'phone',
            'email',


        ];
    }
}
