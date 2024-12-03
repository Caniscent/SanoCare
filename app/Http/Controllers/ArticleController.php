<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::all();
        return view('admin.pages.article.index', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.article.form',[
            'article' => new Article(),
            'page_meta' => [
                'url' => route('admin.article.store'),
                'title' => 'Tambah Artikel',
                // 'desctiption' => 'lorem Ipsum',
                'submit_text' => 'Kirim',
                'method' => 'post',
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
       
            $filePath = $request->file('image')->store('article', 'public');
        } else {
            $filePath = null;
        }
   
        $articleData = [
            'image' => $filePath,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'slug' => $slug,
        ];

        if ($request->status == 'published') {
            $articleData['published_at'] = Carbon::now();  
        }

        Article::create($articleData);

        return redirect()->route('admin.article.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.pages.article.form', [
            'article' => $article,
            'page_meta' => [
                'url' => route('admin.article.update', $article->id),
                'title' => 'Edit Artikel',
                'sub_title' => 'Edit Data',
                'description' => ' article details.',
                'submit_text' => 'Simpan',
                'method' => 'put', 
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            if ($article->image && file_exists(storage_path('app/public/' . $article->image))) {
                unlink(storage_path('app/public/' . $article->image));
            }
            $article->image = $request->file('image')->store('article', 'public');
        }

        $articleData = [
            // 'image' => $filePath,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'slug' => $slug,
        ];

        if ($request->status == 'published') {
            $articleData['published_at'] = Carbon::now();  
        } else {
            $articleData['published_at'] = null; 
        }

        $article->update($articleData);
        return redirect()->route('admin.article.index')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $imagePath = storage_path('app/public/' . $article->image);

        if (file_exists($imagePath)) {
            unlink($imagePath);
            // dd($imagePath);
        }
        $article->delete(); 
        return redirect()->route('admin.article.index')->with('success', 'Data berhasil dihapus.');
    }
}
