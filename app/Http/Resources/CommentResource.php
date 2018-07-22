<?php

namespace App\Http\Resources;

use App\Traits\ResourceFieldsFilter;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    use ResourceFieldsFilter;
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
            'author' => $this->author,
            'content' => $this->content,
            'created' => $this->created_at
        ]);
    }
}
