<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id']=$this->id;
        $data['name']=$this->name;
        $data['description']=$this->description;
        $data['price']=$this->price;
        $data['image']=$this->image;
        $data['category_id']=$this->category_id;
        return $data;
    }
}
