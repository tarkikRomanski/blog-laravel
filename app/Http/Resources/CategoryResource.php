<?php

namespace App\Http\Resources;

use App\Traits\ResourceFieldsFilter;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'description' => $this->description,
            'link' => route('categories.get', ['id' => $this->id]),
            'editLink' => route('categories.update', ['id' => $this->id]),
            'comments' => CommentResource::hide(['post'])::collection($this->comments),
            'postsQuantity' => $this->posts()->count(),
            'created' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
        ]);
    }

    /**
     * Hides all fields except name and id.
     * @return self
     */
    public static function showOnlyMain()
    {
        self::$withoutFields = [
            'description',
            'link',
            'editLink',
            'postsQuantity',
            'created',
            'updated'
        ];

        return self::class;
    }
}
