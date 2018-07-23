<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    /**
     * Displays categories list page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Displays create category form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Displays update category form
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($categoryId)
    {
        return view('categories.update', ['categoryId' => $categoryId]);
    }

    /**
     * Displays one category page
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get($categoryId)
    {
        return view('categories.get', ['categoryId' => $categoryId]);
    }
}
