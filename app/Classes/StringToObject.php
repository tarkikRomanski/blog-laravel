<?php

namespace App\Classes;


use App\Category;
use App\Post;

class StringToObject
{
    /**
     * Returns array of categories by string with id's
     * @param null|string $categories
     * @return array
     */
    public function toCategories($categories = null) {
        if (is_null($categories)) {
            return [];
        }

        $categoriesIdList = explode(',', $categories);
        $categoriesList = [];
        foreach ($categoriesIdList as $categoryId) {
            $category = Category::find((int)$categoryId);
            if(!is_null($category)) {
                $categoriesList[] = $category;
            }
        }

        return $categoriesList;
    }

    /** Returns post by id.
     * @param null $postId
     * @return bool|Post
     */
    public function toPost($postId = null) {
        if(!is_null($postId)) {
            $post = Post::find((int)$postId);
            if (!is_null($post)) {
                return $post;
            }
        }
        return false;
    }
}