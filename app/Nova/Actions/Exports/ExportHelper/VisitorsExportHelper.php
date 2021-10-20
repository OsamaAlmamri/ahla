<?php


namespace App\Nova\Actions\Exports\ExportHelper;

use App\Http\Resources\VisitorsResource;

use App\Models\Visitor;
use Illuminate\Support\Facades\Cookie;

class VisitorsExportHelper
{

    public static function data($limt = 2000)
    {
        $params = array(
            "occasion_id" => Cookie::get('occasion_id', 'all'),
        );

        $data = Visitor::where('id', '>', 0);


        if ($params["occasion_id"] != "all")
            $data = $data->where('occasion_id', $params["occasion_id"]);

        $data = $data->take(2000)->get();


        $pos    = VisitorsResource::collection($data);

        return ["exportable" =>( $pos->toJson()), "params" => $params, 'getCollomns' => self::getCollomns()];

    }


    public static function getCollomns()
    {
        $default_style = "word-wrap: break-word; background: #00AEEF; ";
        $default_width = " width:10px ";

//    "id"                   => $this->id,
//            "name"             => $this->name,
//            "occasion_id"             => $this->occasion_id,
//            "phone"                => $this->phone,
//            "email"          => $this->email,
//            "company"                => $this->company,
//            "qr_code"          => $this->qr_code,
//            "is_login"    => $this->is_login,
//            "have_food"       => $this->have_food,
//            "food_time"          => $this->food_time,
//            "login_time"          => $this->login_time,
//            "is_send"          => $this->is_send,
        return array(

            'name'         => ['name' => "name", "style" => "$default_style", 'width' => "width:25px"],
            'company'        => ['name' => "company", "style" => "$default_style", 'width' => "width:25px"],
            'phone'          => ['name' => " phone", "style" => "$default_style", 'width' => ""],
            'email'        => ['name' => "email ", "style" => "$default_style", 'width' => ""],
            'qr_code'        => ['name' => "qr_code ", "style" => "$default_style", 'width' => ""],

        );

    }



}
