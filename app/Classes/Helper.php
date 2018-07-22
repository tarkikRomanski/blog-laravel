<?php

namespace App\Classes;


use App\Category;
use App\Post;

class Helper
{
    /**
     * Returns array of categories by string with id's
     * @param null|string $categories
     * @param string $delimiter
     * @return array
     */
    public function toCategories($categories = null, $delimiter = ',') {
        if (is_null($categories)) {
            return [];
        }

        $categoriesIdList = explode($delimiter, $categories);
        $categoriesList = [];
        foreach ($categoriesIdList as $categoryId) {
            $category = Category::find((int)$categoryId);
            if(!is_null($category)) {
                $categoriesList[] = $category;
            }
        }

        return $categoriesList;
    }

    /**
     * Returns post by id.
     * @param null|string $postId
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