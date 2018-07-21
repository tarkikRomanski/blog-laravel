<?php

namespace App\Http\Resources;

use App\Traits\HideJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'author' => $this->author,
            'content' => $this->content,
            'post' => new PostResource($this->post),
            'created' => $this->create_at
        ]);
    }
}
