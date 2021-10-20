<?php

namespace App\Http\Resources;

use App\Models\General\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = User::class;
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'data' => $this->collection,

        ];
    }
}
