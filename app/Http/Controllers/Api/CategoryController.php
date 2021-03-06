<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Return a paginated list of categories or all categories.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $categories = Category::latest();
        if ($request->has('wholeList')) {
            $categories = $categories->get();
            return CategoryResource::showOnlyMain()::collection($categories);
        }
        $categories = $categories->paginate(20);
        return CategoryResource::clearHide()::collection($categories);
    }

    /**
     * Fetch and return the category.
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Validate and save a new category to the database.
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->only(['name', 'description']));
        return response(new CategoryResource($category), Response::HTTP_CREATED);
    }

    /**
     * Validate and update a category to the database.
     * @param Request $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return response(new CategoryResource($category), Response::HTTP_CREATED);
    }

    /**
     * Destroy category in database
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response(['error' => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}
