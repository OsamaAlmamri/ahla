<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VisitorsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        Carbon::setLocale('ar');

        return [
            //'name','phone','email','company','qr_code','is_login','have_food','food_time'
            //        ,'login_time','is_send','occasion_id'
            "id"                   => $this->id,
            "name"             => $this->name,
            "occasion_id"             => $this->occasion_id,
            "phone"                => $this->phone,
            "email"          => $this->email,
            "company"                => $this->company,
            "qr_code"          => $this->qr_code,
            "is_login"    => $this->is_login,
            "have_food"       => $this->have_food,
            "is_send"          => $this->is_send,
            "login_time"                 =>empty( $this->login_time)?"": $this->login_time->format('Y-m-d H:i'),
            "food_time"                 =>empty( $this->food_time)?"": $this->food_time->format('Y-m-d H:i'),
            "created_at"                 =>$this->login_time?? $this->created_at->format('Y-m-d H:i'),


        ];

    }
}
