<?php

namespace App\Http\Resources;

use App\Traits\HideJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    use HideJsonResource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filterFields([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'posts' => PostResource::hide(['categories', 'comments'])::collection($this->posts),
            'created' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
        ]);
    }
}
