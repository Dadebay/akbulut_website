<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as ResourcesCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::whereParentId(null)->get();
        return ResourcesCategory::collection($categories);
    }

    public function app_categories()
    {
        $categories = Category::whereHas('products')->get();
        return ResourcesCategory::collection($categories);
    }


    public function show(Category $category)
    {
        // return response()->json($category->children);
        $category_children = $category->children->count() > 0 ? $category->children : [];

        return new ResourcesCategory($category);
    }
}
