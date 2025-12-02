<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        app()->setLocale('en');
        $parent_categories = Category::where('parent_id',null)->get();
        return view('admin.categories.create', compact('parent_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name_ru'=>$request->get('name_ru'),
            'name_tk'=>$request->get('name_tk'),
            'name_en'=>$request->get('name_en'),
            'parent_id'=>$request->get('parent_id')
        ]);

        if ($request->hasFile('category_image') && $request->file('category_image')->isValid()) {
            $category->addMediaFromRequest('category_image')
                // ->withManipulations([
                //     '*' => ['width' => 800,'height'=> 560],
                //  ])
                ->toMediaCollection('categories');
        }

        return redirect()->route('categories.index')->with('success','taze category goshuldy');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        app()->setLocale('en');
        $parent_categories = Category::whereParentId(null)->get();
        return view('admin.categories.edit', compact('category','parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'name_en'=>$request->get('name_en'),
            'name_tk'=>$request->get('name_tk'),
            'name_ru'=>$request->get('name_ru'),

            'parent_id'=>$request->get('parent_id')]);

        if($request->hasFile('category_image') && $request->file('category_image')->isValid())
        {
            $category->addMediaFromRequest('category_image')->toMediaCollection('categories');
        }

        return redirect()->route('categories.index')->with('success','Kategoriya üýtgedildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->children->count() > 0){
            return redirect()->route('categories.index')->with('warning','category has children');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('warning','category deleted successfully');
    }
}
