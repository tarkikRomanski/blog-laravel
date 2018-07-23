<?php

namespace App\Http\Resources;

use App\Traits\ResourceFieldsFilter;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    use ResourceFieldsFilter;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filterFields([
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'shortContent' => substr(strip_tags($this->content), 0, 40) . '...',
            'link' => route('posts.get', $this->id),
            'file' => url('/storage/' . $this->file),
            'fileType' => $this->file_type,
            'categories' => CategoryResource::collection($this->categories),
            'comments' => CommentResource::hide(['post'])::collection($this->comments),
            'created' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
        ]);
    }
}
