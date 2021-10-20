<?php

namespace App\Imports;
use App\Models\General\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportVisitors implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    //  protected $fillable = ['user_id', 'target', 'access_target', 'year', 'month'];
    public $occasion_id;


    public function __construct($occasion_id)
    {
        $this->occasion_id  = $occasion_id;

    }


    public function model(array $row)
    {

            Visitor::updateOrCreate([
                'occasion_id'    => $this->occasion_id,
                'phone'     => $row['phone'],
            ], [
                //'name','phone','email','company','qr_code'
                'name' => $row['name'],

                'email'     => $row['email'],
                'company'     => $row['company'],


            ]);

    }

    public function headingRow(): int
    {
        return 1;
    }
}
