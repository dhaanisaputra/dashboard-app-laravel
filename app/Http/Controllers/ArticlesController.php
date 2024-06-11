<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticlesFormRequest;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('admin.article.index');
    }

    public function create()
    {
        // $category = Category::pluck('name', 'name')->all();
        $category = Category::where('status', 0)->pluck('name', 'name')->all();
        return view('admin.article.create', [
            'category' => $category
        ]);
    }

    public function store(ArticlesFormRequest $request)
    {
        $validatedData = $request->validated();
        // return var_dump($request);
        $article = new Articles();
        $article->name = $validatedData['name'];
        $article->slug = Str::slug($validatedData['slug']);
        $article->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('upload/articles/', $filename);
            $article->image = $filename;
        }
        $article->category = $request->category;
        $article->status = $request->status == "0" ? '0' : '1';
        // $category->status = $request->status == true ? '1' : '0';
        $article->save();

        return redirect()->route('get.article')->with('message', 'Article Post Successfully');
    }

    public function edit(Articles $article)
    {
        return view('admin.article.edit', compact('article'));
    }

    public function update(ArticlesFormRequest $request, $article)
    {
        $validatedData = $request->validated();
        $article = Articles::findOrFail($article);

        $article->name = $validatedData['name'];
        $article->slug = Str::slug($validatedData['slug']);
        $article->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            $path = 'upload/category/' . $article->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('upload/category/', $filename);
            $article->image = $filename;
        }
        $article->category = $request->category;
        $article->status = $request->status == "0" ? '0' : '1';
        // $category->status = $request->status == true ? '1' : '0';
        $article->update();

        return redirect()->route('get.article')->with('message', 'Article Updated Successfully');
    }
}
