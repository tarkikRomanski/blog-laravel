<?php

namespace App\Classes;


use App\Category;
use App\Post;
use App\Session;

class Helper
{
    /**
     * Returns array of categories by string with id's
     * @param null|string $categories
     * @param string $delimiter
     * @return array
     */
    public function toCategories($categories = null, $delimiter = ',')
    {
        if (is_null($categories)) {
            return [];
        }

        $categoriesIdList = explode($delimiter, $categories);
        $categoriesList = [];
        foreach ($categoriesIdList as $categoryId) {
            $category = Category::find((int)$categoryId);
            if (!is_null($category)) {
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
    public function toPost($postId = null)
    {
        if (!is_null($postId)) {
            $post = Post::find((int)$postId);
            if (!is_null($post)) {
                return $post;
            }
        }
        return false;
    }

    /**
     * Returns quantity of browsers
     * @return array
     */
    public function getBrowsersQuantity()
    {
        return [
            'chrome' => Session::where('user_agent', 'LIKE', '%Chrome/%')
                ->where('user_agent', 'NOT LIKE', '%Chromium/%')
                ->count(),
            'firefox' => Session::where('user_agent', 'LIKE', '%Firefox/%')
                ->where('user_agent', 'NOT LIKE', '%Seamonkey/%')
                ->count(),
            'seamonkey' => Session::where('user_agent', 'LIKE', '%Seamonkey/%')
                ->count(),
            'chromium' => Session::where('user_agent', 'LIKE', '%Chromium/%')
                ->count(),
            'safari' => Session::where('user_agent', 'LIKE', '%Safari/%')
                ->where('user_agent', 'NOT LIKE', '%Chromium/%')
                ->where('user_agent', 'NOT LIKE', '%Chrome/%')
                ->count(),
            'opera' => Session::where('user_agent', 'LIKE', '%Opera/%')
                ->orWhere('user_agent', 'LIKE', '%OPR/%')
                ->count(),
            'ie' => Session::where('user_agent', 'LIKE', '%; MSIE %')
                ->count(),
        ];
    }
}