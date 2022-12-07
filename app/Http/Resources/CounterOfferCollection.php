<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CounterOfferCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'post' => new PostCollection($this->post),
            'user' => new UserCollection($this->user),
            'created_at' => $this->created_at
        ];
    }
}
