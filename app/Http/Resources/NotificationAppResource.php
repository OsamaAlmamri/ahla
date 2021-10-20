<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationAppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        Carbon::setLocale('ar');
        return [
            'data' => $this->data,
            'is_read' => ! empty($this->read_at) ? 1 : 0,
            "created_at"     => Carbon::createFromTimestamp(strtotime($this->created_at))->diffForHumans(),

        ];
    }
}
