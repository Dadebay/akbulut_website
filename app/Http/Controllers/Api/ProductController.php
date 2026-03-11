<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index(Request $request)
    {
        $category_id = null;
        $categoryIds = collect();

        if ($request->has('category_id')) {

            $category_id = $request->get('category_id');

            $categoryIds->push($category_id);

            if (Category::find($category_id)->children->count()) {
                foreach (Category::find($category_id)->children as $ch) {
                    $categoryIds->push($ch->id);
                    if (Category::find($ch->id)->children->count()) {
                        foreach (Category::find($ch->id)->children as $childrush) {
                            $categoryIds->push($childrush->id);
                        }
                    }
                }
            }
        }

        // return response()->json(count($categoryIds));
        if (count($categoryIds) > 0) {
            $products = Product::whereIn('category_id', $categoryIds)->paginate(10);
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(10);
        }

        return count($products) ? ProductResource::collection($products) : [];
    }

    public function show($id)
    {
        try {

            $dwdwd = Product::whereId($id)->firstOrFail();
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Product not found'], 400);
        }

        return new ProductResource($dwdwd);
    }

}
