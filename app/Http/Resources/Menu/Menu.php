<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class Menu extends JsonResource
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
        $detail['child_menu'] = $this->child_menu;
        $detail = array_merge($data,$detail);
        return $detail;
    }
}
