<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        // log($validatedData);
        // app('log')->info("Request Captured", $request->all());

        // return var_dump($request);
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('upload/category/', $filename);
            $category->image = $filename;
        }
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
        $category->status = $request->status == "0" ? '0' : '1';
        // $category->status = $request->status == true ? '1' : '0';
        $category->save();

        return redirect()->route('get.category')->with('message', 'Category Added Successfully');
        // return 'ye';
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
}
