<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display categories list page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('categories.index');
    }

    public function create() {
        return view('categories.create');
    }

    public function update($categoryId) {
        return view('categories.update', ['categoryId' => $categoryId]);
    }
}
