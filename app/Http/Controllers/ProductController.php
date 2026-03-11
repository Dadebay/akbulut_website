<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category_id = null;
        $item_query = null;

        if ($request->has('category_id')) {
            $category_id = $request->get('category_id');
        }

        if ($request->has('item_query')) {
            $item_query = $request->get('item_query');
        }

        $products = Product::when($item_query, function ($query, $item_query) {

            return $query->where(function ($q) use ($item_query) {
                return $q->where('name_tk', 'LIKE', "%{$item_query}%")
                    ->orWhere('name_ru','LIKE',"%{$item_query}%")->orWhere('name_en','LIKE',"%{$item_query}%");
            }
            );
        })->when($category_id, function ($query, $category) {

            return $query->where('category_id', $category);

        })->paginate(10);

        return view('admin.products.index')->with('products', $products)->with('category_id', $category_id)->with('item_query', $item_query);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        app()->setLocale('en');
        // $children_categories = Category::whereParentId(!null)->get();
        $children_categories = Category::doesnthave('children')->get();

        return view('admin.products.create', compact('children_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name_ru'=> $request->get('name_ru'),
            'name_en'=> $request->get('name_en'),
            'name_tk'=> $request->get('name_tk'),
            'general_info_ru'=> $request->get('general_info_ru'),
            'general_info_en'=> $request->get('general_info_en'),
            'general_info_tk'=> $request->get('general_info_tk'),

            'description_ru'=> $request->get('description_ru'),
            'description_en'=> $request->get('description_en'),
            'description_tk'=> $request->get('description_tk'),

            'category_id'=> $request->get('category_id'),

        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $key => $value) {

                $product->addMedia($request->file('images')[$key])
                    ->toMediaCollection('products');
            }
        }

        if ($request->hasFile('product_sliders')) {

            foreach ($request->file('product_sliders') as $key => $value) {

                $product->addMedia($request->file('product_sliders')[$key])
                    ->toMediaCollection('product_sliders');
            }
        }

        return redirect()->route('products.index')->with('success','product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        app()->setLocale('en');
        $children_categories = Category::doesnthave('children')->get();
        return view('admin.products.edit', compact('product','children_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->getMedia('products')->pluck('id')->diff($request->old_photos)->map(function($id) use ($product){
            $product->deleteMedia($id);
        });

        $product->getMedia('product_sliders')->pluck('id')->diff($request->old_photos_slider)->map(function($id) use ($product){
            $product->deleteMedia($id);
        });

        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach ($images as $key => $value) {
                $product->addMedia($images[$key])
                    ->toMediaCollection('products');
            }
        }

        if($request->hasFile('product_sliders')){
            $product_sliders = $request->file('product_sliders');
            foreach ($product_sliders as $key => $value) {
                $product->addMedia($product_sliders[$key])
                    ->toMediaCollection('product_sliders');
            }
        }

        $product->update([
            'category_id'=> $request->get('category_id'),

            'name_en'=>$request->get('name_en'),
            'name_tk'=>$request->get('name_tk'),
            'name_ru'=>$request->get('name_ru'),

            'general_info_en'=>$request->get('general_info_en'),
            'general_info_tk'=>$request->get('general_info_tk'),
            'general_info_ru'=>$request->get('general_info_ru'),

            'description_en'=>$request->get('description_en'),
            'description_tk'=>$request->get('description_tk'),
            'description_ru'=>$request->get('description_ru'),
        ]);
        return redirect()->route('products.index')->with('success','product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('warning','product deleted successfully');
    }

    public function upload(Request $request)
    {
        $Product = new Product();
        $Product->id = 0;
        $Product->exists = true;
        $image = $Product->addMediaFromRequest('upload')->toMediaCollection('products');
        return response()->json([
            'url'=>$image->getUrl()
        ]);
    }
}
