<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Masterdata extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $detail['children'] = $this->detail;
        $detail = array_merge($data,$detail);
        return $detail;
    }
}
