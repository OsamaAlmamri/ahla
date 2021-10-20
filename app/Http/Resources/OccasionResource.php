<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OccasionResource extends JsonResource
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
            "visitors"             => $this->all_visitors->count(),
            "visitors_login"             => $this->all_visitors->where('is_login',1)->count(),
            "visitors_have_food"             => $this->all_visitors->where('have_food',1)->count(),
            "visitors_is_send"             => $this->all_visitors->where('is_send',1)->count(),
            "date"                 => $this->date->format('d M,Y H:i'),
            "created_at"                 => $this->created_at->format('d M,Y H:i'),
        ];

    }
}
