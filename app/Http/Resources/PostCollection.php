<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if($this->gas_type == 0){
            $gas_type = 'Diesel';
        }elseif($this->gas_type == 1){
            $gas_type = 'Jayyid';
        }elseif($this->gas_type == 2){
            $gas_type = 'Mumtaz';
        }elseif($this->gas_type == 3){
            $gas_type = 'Super';
        }else{
            $gas_type = null;
        }

        if($this->condition == 0){
            $condition = 'New';
        }elseif($this->condition == 1){
            $condition = 'Used';
        }elseif($this->condition == 2){
            $condition = 'Scrap';
        }else{
            $condition = null;
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user' => new UserCollection($this->user),
            'price' => $this->price,
            'is_ask_price' => $this->is_ask_price == 1?true:false,
            'type_post' => $this->type_post == 1 ? 'Sale' : 'Request',
            'maker' => $this->maker,
            'model' => $this->model,
            'colour' => $this->colour,
            'years' => $this->years,
            'body_type' => new BodyTypeCollection($this->body_type),
            'transmission_type' => $this->transmission_type == 1 ? 'Automatic' : 'Manual',
            'kilometrage' =>  $this->kilometrage,
            'gas_type' => $gas_type,
            'doors' => $this->doors,
            'engine_cylinders' => $this->engine_cylinders,
            'condition' => $condition,
            'number_of_owners' => $this->number_of_owners,
            'number_of_accidents' => $this->number_of_accidents,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
