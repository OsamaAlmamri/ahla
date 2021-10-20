<?php

namespace Database\Seeders;

use App\Models\General\GeneralSettings;
use App\Models\General\User;
use App\Models\POS\ProblemCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SettingTablesSeeder extends Seeder
{

    public function run()
    {
        GeneralSettings::updateOrCreate(['id' => '1',],[

                'logo' => '/uploads/generalSettings/kprmjQvyiknXmjULP3j0VsYczHIaFA9BU2vZ0sgM1sZbg0olMp.png',
                'favicon' => '/uploads/generalSettings/a7DECvKW83PbijiBEAIIopWJskXChaDCEEwMJalIpHGM2RkKvs.png',
                'site_ar' => 'أهلاً','site_en' => 'Ahla',
                'created_at' => '2020-10-18 09:30:20','updated_at' => '2021-10-15 19:03:58','deleted_at' => NULL
        ]);

    }
}
